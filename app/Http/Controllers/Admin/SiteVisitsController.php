<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Input;
use Auth;
use Cookie;
use Session;
use DB;
use Image;
use File;
use Exception;
use App\Models\User;
use App\Models\Lead;

use App\Models\LeadComment;
use App\Models\SiteComment;

use App\Models\Customer;
use App\Models\AdminPermission;

use App\DataTables\SiteVisitDataTable;

use App\Models\SiteVisits;
use App\Helpers\AdminHelper;

class SiteVisitsController extends Controller
{
    //=================================================================

	public function index(SiteVisitDataTable $dataTable, Request $request)
	{
		        
		$data = [
            'from' => $request->from,
            'to' => $request->to,
            'customer' => $request->customer,
			'status' => $request->status,
            'user_id' => $request->user_id,
			'customer_id' => $request->customer_id,
		];
	
		return $dataTable->with('data',$data)->render('admin/site_visits/index');

		//return $dataTable->render('admin/leads/index');
	}
	//=================================================================

	public function add()
	{
		$data = array();
		$data['users'] = User::where('user_type','user')->get();
		$data['customers'] = Customer::where('status','1')->get();

		return view('admin/site_visits/add',$data);
	}

	//=================================================================


	public function save(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'customer_id' 	=> 'required',
				'user_id' 		=> 'required',
				
			]);
			if ($validator->fails()) { 
	            return redirect('admin/site_visits/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
				$customer = Customer::where('id',$request->customer_id)->first();

		        $data = new SiteVisits;
		        //=========================================================
		        $data->location 		= $request->location;
		        $data->customer_id 	= $request->customer_id;
		        $data->user_id 		= $request->user_id;
				$data->date 		= $request->date;
				$data->contact 		= $request->contact;
				$data->telephone 	= $request->telephone;
				$data->phone 		= $request->phone;
				$data->lead_source 		= $request->lead_source;
				$data->email 		= $request->email;
				$data->category 	= $request->category;
				$data->model 		= $request->model;
				$data->notes 		= $request->notes;
		        $data->save();
				session()->flash('message', 'SIte Visits added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/site_visits/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Lead');
            Session::flash('alert-type', 'error');
           	return redirect('admin/site_visits/add');
        }
	}

	//=================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = SiteVisits::find($id);
		$data['users'] = User::where('user_type','user')->get();
		$data['customers'] = Customer::where('status','1')->get();

		return view('admin/site_visits/edit',$data);
	}

	//=================================================================

	public function update(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'customer_id' 	=> 'required',
				'user_id' 		=> 'required',
			]);
			if ($validator->fails()) { 
	            return redirect('admin/leads/edit'.'/'.$request->id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
				$customer = Customer::where('id',$request->customer_id)->first();

		        $data = SiteVisits::find($request->id);
				$data->location 		= $request->location;
		        $data->customer_id 	= $request->customer_id;
		        $data->user_id 		= $request->user_id;
				$data->date 		= $request->date;
				$data->contact 		= $request->contact;
				$data->telephone 	= $request->telephone;
				$data->lead_source 	= $request->lead_source;
				$data->phone 		= $request->phone;
				$data->email 		= $request->email;
				$data->category 	= $request->category;
				$data->model 		= $request->model;
				$data->notes 		= $request->notes;
		        $data->save();

				session()->flash('message', 'Site Visits updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/site_visits/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during update Site Visits');
            Session::flash('alert-type', 'error');
           	return redirect('admin/site_visits/edit'.'/'.$request->id);
        }
	}

	//=================================================================

	public function delete($id){
		
		try {
			SiteVisits::where('id',$id)->delete();
		
			session()->flash('message', 'Site Visits deleted successfully');
	        Session::flash('alert-type', 'success');

	        return redirect('admin/site_visits/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');

          	return redirect('admin/site_visits/index');
        }
    }

    //===================================================

    public function view($id)
    {
    	$data['result'] = SiteVisits::find($id);
    	$data['comments'] = SiteComment::where('site_visits_id',$id)->get();
    	$data['user'] = User::find($data['result']->user_id);

		
	  
    	$readComment = SiteComment::where('site_visits_id',$id)->update(['is_read'=>'1']);

    	return view('admin.site_visits.view',$data);
    }

    //===================================================

    public function comment(Request $request)
    {
    	if (!empty($request->comment)) {
    		$data = new SiteComment;
	        //=========================================================
	        $data->site_visits_id = $request->site_visits_id;
	        $data->comment_by = Auth::user()->id;
	        $data->comment = $request->comment;
	        
	        if($data->save()){
	        	session()->flash('message', 'Comment added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/site_visits/view/'.$request->site_visits_id);
	        }else{
	        	session()->flash('message', 'Some error occured!');
				Session::flash('alert-type', 'error'); 
				return redirect('admin/site_visits/view/'.$request->site_visits_id);
	        }
    	}else{
    		session()->flash('message', 'Please enter something!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/leads/site_visits/'.$request->site_visits_id);
    	}
    }

    //===================================================

}

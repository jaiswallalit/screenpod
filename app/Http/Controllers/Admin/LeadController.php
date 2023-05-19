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
use App\Models\Customer;
use App\Models\AdminPermission;
use App\DataTables\LeadDataTable;
use App\Helpers\AdminHelper;

class LeadController extends Controller
{
    //=================================================================

	public function index(LeadDataTable $dataTable, Request $request)
	{
	    
	   //  $user = User::find($request->user_id);
		  //     // $device_id = $user->device_id;
		  //     // print_r($device_id);
		  //     // die;
		  //      $device_id = 'deQUPPs9Qx6XDTQMtfpY4V:APA91bEJU4rtGz_9PcqynRhPoIeY77FDxfa2hVHGspfCaQXhBHupkT3ckZuJyO41fQwlSUrC6NLcMq4QFXyrysEbTW6YfvLmnno6HqJha5WftrkU1nRfwkD2lc3poJIF8pUlx99eS0dN';
		  //      $message = "Admin assigned a new lead";
		  //  	AdminHelper::push_notification($device_id,$message);
		  //     print_r($device_id);
		  //      die;
		        
		$data = [
            'from' => $request->from,
            'to' => $request->to,
            'customer' => $request->customer,
			'status' => $request->status,
            'user_id' => $request->user_id,
		];
		return $dataTable->with('data',$data)->render('admin/leads/index');

		//return $dataTable->render('admin/leads/index');
	}
	//=================================================================

	public function add()
	{
		$data = array();
		$data['users'] = User::where('user_type','user')->get();
		$data['customers'] = Customer::where('status','1')->get();

		return view('admin/leads/add',$data);
	}

	//=================================================================

	public function save(Request $request)
	{
	   // $device_id='dd0dgYUnKUYzrca2K5bG5V:APA91bFzYoTUFM28goTAbW6-YNGWVht1fc8jYSaHT2bAl_iku5q4L-dpI9lu656Ahtc6A3MfHg0dVPCKORx2ueCc5VUnqgZPYL0DkVy46hvzhlpiZ5Mdy8-qvn48aAptFAkCr9UcZoMm';
	    //$device_id='cqkAJ7e5-0U9q8_Crb4XM-:APA91bEPgLbXG1obuj3UkAU2UsUlK5J4RLoK6UkuYPO1-1EMTec4M-RmHoId9ucSYnC_r-PXHBbKDYaCc3s4CAhVIu4-VUPocgG8CVTmvX8QDK1r2yfueAna49H_B2jc4a27Mfx0fh0Z';
	    //$message = "Admin assigned a new lead";
		       
	//	AdminHelper::push_notification($device_id,$message);
	//	die;
		try {
			$validator = Validator::make($request->all(), [
				'customer_id' 	=> 'required',
				'user_id' 		=> 'required',
				'status' 		=> 'required',
			]);
			if ($validator->fails()) { 
	            return redirect('admin/leads/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
				$customer = Customer::where('id',$request->customer_id)->first();

		        $data = new Lead;
		        //=========================================================
		        $data->title 		= $request->title;
				$data->lead_source 		= $request->lead_source;
		        $data->customer_id 	= $request->customer_id;
		        $data->name 	 	= $customer->name;
		        $data->vat_number 	= $customer->vat_number;
		        $data->email 		= $customer->email;
		        $data->phone 		= $customer->phone;
		        $data->address 		= $customer->address;
		        $data->message 		= $request->message;
		        $data->user_id 		= $request->user_id;
		        $data->status 		= $request->status;
		        $data->date 		= date('Y-m-d');
		        $data->save();

		        /*Sending notification to sales rep(user)*/
		        $user = User::find($request->user_id);
		        $device_id = $user->fcm_token;
		       
		       //$device_id = 'deQUPPs9Qx6XDTQMtfpY4V:APA91bEJU4rtGz_9PcqynRhPoIeY77FDxfa2hVHGspfCaQXhBHupkT3ckZuJyO41fQwlSUrC6NLcMq4QFXyrysEbTW6YfvLmnno6HqJha5WftrkU1nRfwkD2lc3poJIF8pUlx99eS0dN';
		        $message = "Admin assigned a new lead";
		       
		        AdminHelper::push_notification($device_id,$message);

				session()->flash('message', 'Lead added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/leads/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Lead');
            Session::flash('alert-type', 'error');
           	return redirect('admin/leads/add');
        }
	}

	//=================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Lead::find($id);
		$data['users'] = User::where('user_type','user')->get();
		$data['customers'] = Customer::where('status','1')->get();

		return view('admin/leads/edit',$data);
	}

	//=================================================================

	public function update(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'customer_id' 	=> 'required',
				'user_id' 		=> 'required',
				'status' 		=> 'required',
			]);
			if ($validator->fails()) { 
	            return redirect('admin/leads/edit'.'/'.$request->id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
				$customer = Customer::where('id',$request->customer_id)->first();

		        $data = Lead::find($request->id);
		        $data->title 		= $request->title;
				$data->lead_source 		= $request->lead_source;
				$data->customer_id 	= $request->customer_id;
		        $data->name 		= $customer->name;
		        $data->vat_number 	= $customer->vat_number;
		        $data->email 		= $customer->email;
		        $data->phone 		= $customer->phone;
		        $data->address 		= $customer->address;
		        $data->message 		= $request->message;
		        $data->user_id 		= $request->user_id;
		        $data->status 		= $request->status;
		        $data->date 		= date('Y-m-d');
		        $data->save();

				session()->flash('message', 'Lead updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/leads/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during update Lead');
            Session::flash('alert-type', 'error');
           	return redirect('admin/leads/edit'.'/'.$request->id);
        }
	}

	//=================================================================

	public function delete($id){
		
		try {
			Lead::where('id',$id)->delete();
		
			session()->flash('message', 'Lead deleted successfully');
	        Session::flash('alert-type', 'success');

	        return redirect('admin/leads/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');

          	return redirect('admin/leads/index');
        }
    }

    //===================================================

    public function view($id)
    {
    	$data['result'] = Lead::find($id);
    	$data['comments'] = LeadComment::where('lead_id',$id)->get();
    	$data['user'] = User::find($data['result']->user_id);

    	$readComment = LeadComment::where('lead_id',$id)->update(['is_read'=>'1']);

    	return view('admin.leads.view',$data);
    }

    //===================================================

    public function comment(Request $request)
    {
    	if (!empty($request->comment)) {
    		$data = new LeadComment;
	        //=========================================================
	        $data->lead_id = $request->lead_id;
	        $data->comment_by = Auth::user()->id;
	        $data->comment = $request->comment;
	        
	        if($data->save()){
	        	session()->flash('message', 'Comment added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/leads/view/'.$request->lead_id);
	        }else{
	        	session()->flash('message', 'Some error occured!');
				Session::flash('alert-type', 'error'); 
				return redirect('admin/leads/view/'.$request->lead_id);
	        }
    	}else{
    		session()->flash('message', 'Please enter something!');
			Session::flash('alert-type', 'error'); 
			return redirect('admin/leads/view/'.$request->lead_id);
    	}
    }

    //===================================================

}

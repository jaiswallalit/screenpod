<?php
namespace App\Http\Controllers\Api;

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
use Mail;
//use App\User;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\Customer;
use App\Models\User;
use App\Helpers\AdminHelper;
use Carbon;
use App\Models\SiteVisits;
use App\Models\SiteComment;


class SiteVisitsController extends Controller
{
    /*User Leads(Sales Calls)*/
    public function salesCalls(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $leads = SiteVisits::where('user_id',$request->user_id)
               
                        ->orderBy('id','DESC')
                        ->get();
        
                        
        $data = [];
        foreach ($leads as $key => $lead) {
            $customer = Customer::select('customers.*', 'customers.name as customer_name') 
            ->where('id', $lead->customer_id)
           
                            ->first();
           $user = User::select('users.*', 'users.name as user_name') 
                            ->where('id', $lead->user_id)
                           
                                            ->first();  
                                                 
            $data[] = [
                'id' => $lead->id,
                'user_id' => $lead->user_id,
                'customer_id' => $lead->customer_id,
                'customer_name' =>$customer->name,
                'user_name' =>$user->name,
                'location' => $lead->location,
                'date' => $lead->date,
                'email' => $lead->email,
                'contact' => $lead->contact,
                'telephone' => $lead->telephone,
                'phone' => $lead->phone,
                'lead_source' => $lead->lead_source,
                'category' => $lead->category,
                'model' => $lead->model,
                'notes' => $lead->notes,
				'updated_at' => $lead->updated_at,
                'created_at' => $lead->created_at,
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }

    /*Leads Details*/
    public function siteVisitDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = SiteVisits::where('id',$request->id)->first();
        $customer = Customer::select('customers.*', 'customers.name as customer_name') 
        ->where('id', $lead->customer_id)
       
                        ->first();
       $user = User::select('users.*', 'users.name as user_name') 
                        ->where('id', $lead->user_id)
                       
                                        ->first(); 
        $data = [];
        $data[] = [
                 'id' => $lead->id,
                'user_id' => $lead->user_id,
                'customer_id' => $lead->customer_id,
                'customer_name' =>$customer->name,
                'user_name' =>$user->name,
                'location' => $lead->location,
                'date' => $lead->date,
                'email' => $lead->email,
                'contact' => $lead->contact,
                'telephone' => $lead->telephone,
                'phone' => $lead->phone,
                'lead_source' => $lead->lead_source,
                'category' => $lead->category,
                'model' => $lead->model,
                'notes' => $lead->notes,
            'comments' => $this->getSiteComments($lead->id),
        ];

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }
    // Get Comments on Site Visit
    public function getSiteComments($lead_id)
    {
        $data = SiteComment::join('users','site_comments.comment_by','=','users.id')
                                ->where('site_visits_id',$lead_id)
                                ->select('site_comments.*','users.name')
                                ->get();

        if (count($data)>0) {
            return $data;
        }else{
            return [];
        }
    }
    
    public function commentsList(Request $request)
    {
        $data = SiteComment::join('users','site_comments.comment_by','=','users.id')
                                ->where('lead_id',$request->lead_id)
                                ->select('site_comments.*','users.name')
                                ->get();

        if (count($data)>0) {
            return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Data found.',
                                        'data' => $data,
                                    ),200);
        }else{
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>'No Data Found'
                                    ),200);
        }
    }


/*Create  sitevisits*/

public function createSiteVisits(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'customer_id' 	=> 'required',
				'user_id' 		=> 'required',
				'category' 		=> 'required',
				'location' 		=> 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {

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
		       
                 if ($data->save()) {
             
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Customer created successfully.',
                                            'data' => $data,
                                        ),200);
            }else{
                return response()->json(array(
                                            'status' => 400,
                                            'message'=> 'Error',
                                            'error_message'=>'Something went wrong!'
                                        ),200);
            }
        }
    }
/*closed  sitevisits*/


    /*Update Lead Status*/
    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = Lead::find($request->lead_id);
        $lead->status = $request->status;

        if ($lead->save()) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Status updated successfully.',
                        'data' => $lead,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'Something went wrong!'
                    ),200);
        }
    }
    
    /*Comment on leads*/
    public function commentOnSite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_visits_id' => 'required',
            'comment_by' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = new SiteComment;
        $lead->site_visits_id = $request->site_visits_id;
        $lead->comment_by = $request->comment_by;
        $lead->comment = $request->comment;

        if ($lead->save()) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Comment posted successfully.',
                        'data' => $lead,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'Something went wrong!'
                    ),200);
        }
    }
    
    /*Get Customers*/
    public function getCustomers(Request $request)
    {
     
		
		 $data = Customer::select('customers.*') 
        ->get();
        if(count($data)>0){
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }
    public function detailSiteVisit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'site_visits_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $lead = SiteVisits::where('user_id',$request->user_id)->where('id',$request->site_visits_id)
                        ->orderBy('id','DESC')
                        ->first();
                        $customer = Customer::select('customers.*', 'customers.name as customer_name') 
                        ->where('id', $lead->customer_id)
                       
                                        ->first();
                       $user = User::select('users.*', 'users.name as user_name') 
                                        ->where('id', $lead->user_id)
                                       
                                                        ->first();  
            $data[] = [
                'id' => $lead->id,
                'user_id' => $lead->user_id,
                'customer_id' => $lead->customer_id,
                'customer_name' =>$customer->name,
                'user_name' =>$user->name,
                'location' => $lead->location,
                'date' => $lead->date,
                'email' => $lead->email,
                'contact' => $lead->contact,
                'telephone' => $lead->telephone,
                'phone' => $lead->phone,
                'lead_source' => $lead->lead_source,
                'category' => $lead->category,
                'model' => $lead->model,
                'notes' => $lead->notes,
            ];

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data,
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }
    public function completeSalesCall(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'sales_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }
        $lead = Lead::find($request->sales_id);

        $lead->status = 'Closed';
        $lead->save();

        return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Lead Completed.',
                        'data' => $lead,
                    ),200);

    }


    public function searchSiteVisite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'location' => 'required',
            //'search' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
        $query = SiteVisits::select('site_visits.*', 'customers.name as customer_name','users.name as user_name')
        ->leftjoin('users','site_visits.user_id','=','users.id')  
        ->leftjoin('customers','site_visits.customer_id','=','customers.id')
        ->where('site_visits.model','LIKE','%'.$request->search.'%')
        ->where('site_visits.category', $request->category)
        ->where('site_visits.location', $request->location)
        ->get();
   
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Site Visits Data.',
                                        'data' => $query,
                                    ),200);
                                    
                                        
    }
      /*Get Category*/

      public function getCategory(Request $request)
      {
          $data = SiteVisits::select('category')
                          
                          ->get();
  
          if(count($data)>0){
              return response()->json($data,200);
          }else{
              return response()->json(array(
                          'status' => 400,
                          'message'=> 'Error',
                          'error_message'=>'No data found!'
                      ),200);
          }
      }
      /*Get Locaton*/

      public function getLocaton(Request $request)
      {
          $data = SiteVisits::select('location')
                          
                          ->get();
  
          if(count($data)>0){
              return response()->json($data,200);
          }else{
              return response()->json(array(
                          'status' => 400,
                          'message'=> 'Error',
                          'error_message'=>'No data found!'
                      ),200);
          }
      }
      
}

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
use Mail;
use Image;
use File;
use Exception;
use App\Models\User;
use App\Models\AdditionalSpecSheet;
use App\Models\SpecSheet;

use App\Models\Action;
use App\Models\Role;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\ExtraProductInfo;
use App\Models\Dealer;
use App\Models\TradeIn;
use App\Models\Production;
use App\Models\AdminPermission;
use App\DataTables\SalesOrderDataTable;
use App\Helpers\AdminHelper;

class ProductionController extends Controller
{
    //=================================================================

	
	public function index(Request $request)
	{
        $data = [];
        //==============================================
        $status_action = Action::where('action_slug','status')->first();
        $data['checkStatusAction'] = Role::where('name_slug','sales_order')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','sales_order')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================
        $data['customers'] = Customer::where('status','1')->get();
        $data['users'] = User::where('status','1')->get();
        $data['dealers'] = Dealer::where('status','1')->get();
		$data['products'] = Product::get();
        $data['spec'] = SpecSheet::get();
// print_r($data['spec']);
// die();
        if (!empty($request->from) || !empty($request->to) || !empty($request->serial_number) || !empty($request->customer) || !empty($request->user) || !empty($request->status) || $request->delivered == '0' || $request->delivered == '1' || !empty($request->dealer_id) || !empty($request->model)) {
            $query = Production::join('products','productions.product_id','=','products.id')
                                ->orderBy('id','DESC')
                                ->select('productions.*','products.dealer_id','products.model');

            if (!empty($request->from)) {
                $query = $query->where('date','>=',$request->from);
            }
            if (!empty($request->to)) {
                $query = $query->where('date','<=',$request->to);
            }
                      if (!empty($request->serial_number)) {
                $query = $query->where('serial_number',$request->serial_number);
            }
            if (!empty($request->customer)) {
                $query = $query->where('customer_id',$request->customer);
            }
             if (!empty($request->user)) {
                $query = $query->where('user_id',$request->user);
            }
            
            if (!empty($request->model)) {
                $query = $query->where('product_id',$request->model);
            }

            if (!empty($request->status)) {
                if ($request->status == 'Closed') {
                    $query = $query->where('PDI_status','1')
                                    ->where('payment_confirm','1')
                                    ->where('delivered','1');
                }else{
                    $query = $query->where('PDI_status','0')
                                    ->orWhere('payment_confirm','0')
                                    ->orWhere('delivered','0');
                }
            }
            if ($request->delivered == '0' || $request->delivered == '1') {
                $query = $query->where('delivered',$request->delivered);
            }
            if (!empty($request->dealer_id)) {
                $query = $query->where('dealer_id',$request->dealer_id);
            }
           
            $data['results'] = $query->paginate(1000);
        }else{
            $data['results'] = Production::orderBy('id','DESC')->paginate(1000);
        }
        
		return view('admin/productions/index',$data);
	}
    

            /*Create productions*/
     public function add() {
        $data = array();
        $data['users'] = User::where('user_type','user')->orderBy('name')->get();
        $data['customers'] = Customer::where('status','1')->orderBy('name')->get();
        $data['dealers'] = Dealer::where('status','1')->get();

        return view('admin/productions/add',$data);
                   
    }

        //==========================All machines save=======================================
        public function save(Request $request)
        {
            try {
                $validator = Validator::make($request->all(), [
                    'customer_id' 	=> 'required',
                    'serial_number' => 'required|unique:hire_orders,serial_number',
                ]);
                if ($validator->fails()) { 
                    return redirect('admin/productions/add')
                                ->withErrors($validator)
                                ->withInput();
                } else {
                    // $order_number = DB::table('hire_orders')->count() +1; 
                    // $chrList = $order_number;
                    // $chrRepeatMin = 'CB0'; 
                    // $chrRepeatMax = $request->product_id;
                    // $chrRandomLength = 'VB';
                    // $agreement_no= $chrRepeatMin.''.$chrList.''.$chrRepeatMax.''.$chrRandomLength;
					// $ordernum = '#ON0'; 
					// $order_number= $ordernum.''.$chrList.''.$chrRepeatMax;
                    $data = new Production;
                    //=========================================================
                    $data->customer_id = $request->customer_id;
                    $data->customer_order = $request->customer_order;
                    $data->machine_order_number =  $request->machine_order_number;
                    $data->make =  $request->make;
                    $data->product_id = $request->product_id;
                    $data->serial_number = $request->serial_number;
                    $data->purchased_sheet = $request->purchased_sheet;
                    $data->steel_parts_due = $request->steel_parts_due;
                    $data->parts_due = $request->parts_due;
                    $data->build_start_week = $request->build_start_week;
                    $data->build_shed = $request->build_shed;
                    $data->electrics_start_week = $request->electrics_start_week;
                    $data->PDI_status = $request->PDI_status;
                    $data->build_finish_week = $request->build_finish_week;
                    $data->ready_for_dispatch = $request->ready_for_dispatch;
                    $data->machine_dispatched = $request->machine_dispatched;
                    $data->dispatched_week = $request->dispatched_week;
                    $data->dispatch_date = $request->dispatch_date;
                    $data->notes = $request->notes;                   
                    $data->save();

                    session()->flash('message', 'productions added successfully');
                    Session::flash('alert-type', 'success'); 
                    return redirect('admin/production/index');
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                session()->flash('message', 'Some error occured during save Lead');
                Session::flash('alert-type', 'error');
                   return redirect('admin/production/add');
            }
        }
    //===================================================
//====================================================================
public function createProduction1($sales_orders_id)
{
	try {
		$customer_id = DB::select('select * from sales_orders where id=?', [$sales_orders_id]);
       
        $sales = DB::table('sales_orders')->where('id',$sales_orders_id)->get();
		//$products_details = DB::select('select * from sales_orders where order_number=?', [$sales->order_number]);
        $products_details = DB::table('sales_orders')->where('order_number',$sales[0]->order_number)->get();
            
		foreach ($products_details as $productData) {
           
			//$product_exist = DB::select('select * from productions where machine_order_number = ? and customer_id = ? and product_id = ?', [$productData->machine_order_number, $customer_id[0]->customer_id,$productData->product_id]);
            $product_exist = DB::table('productions')->where('machine_order_number',$productData->machine_order_number)->where('customer_id',$productData->customer_id)->where('product_id',$productData->product_id)->get();
           
            if (empty($product_exist)) {
                $products_stock = DB::table('products')->where('id',$productData->product_id)->get();    
				$data = array(
					'sales_orders_id'   => $productData->id,
					'customer_id'   => $customer_id[0]->customer_id,
					'user_id'   => $customer_id[0]->user_id,
					'product_id'   => $productData->product_id,
					'order_number'   => $productData->order_number,
					'machine_order_number'   => $productData->machine_order_number,
					'date'   => $customer_id[0]->date,
					'serial_number'   => $products_stock[0]->stock_number,
					);
                    
				$res = Production::insertGetId($data);
			}
       
			else{
                $products_stock = DB::table('products')->where('id',$productData->product_id)->first();

               
                DB::table('productions')
					->where('sales_orders_id', $productData->quote_id)
					->where('customer_id', $customer_id[0]->customer_id)
					->where('product_id', $productData->product_id)
					->update([
						'quote_id'   => $productData->quote_id,
						'customer_id'   => $customer_id[0]->customer_id,
						'user_id'   => $customer_id[0]->user_id,
						'product_id'   => $productData->product_id,
						'price'   => $productData->price,
						'date'   => $customer_id[0]->date,
						'serial_number'   => $products_stock->stock_number,
					]);
			}
		}

		session()->flash('message', 'Production added successfully');
		Session::flash('alert-type', 'success'); 
		return redirect('admin/production/index');
	} catch (\Exception $e) {
		Log::error($e->getMessage());
       
		session()->flash('message', 'Some error occured!');
		Session::flash('alert-type', 'error');
		return redirect('admin/sales_order/view'.'/'.$sales_orders_id);
		   // return redirect('admin/quotes/edit'.'/'.$request->quote_id);
	}
}
		//=======================ADD TRADE=============================================
        public function createProduction($sales_orders_id)
        {
            try {
                $customer_id = DB::select('select * from sales_orders where id=?', [$sales_orders_id]);
                //$products_details = DB::table('sales_orders')->where('order_number',$customer_id[0]->order_number)->get();
            
               $products_details = DB::select('select * from sales_orders where order_number=?', [$customer_id[0]->order_number]);
               // $user_id =   DB::select('select * from leads where id=?', [$customer_id[0]->lead_id]);
               
                foreach ($products_details as $productData) {
                    
                    $product_exist = DB::select('select * from productions where sales_orders_id = ?
                     and customer_id = ? and product_id = ?', 
                    [$customer_id[0]->id, 
                    $customer_id[0]->customer_id,$productData->product_id]);
                    // echo "<pre>";
                    // print_r($product_exist);die('hhh');
                    if (empty($product_exist)) {
                       
                        $products_stock = DB::select('select * from products where id=?', [$productData->product_id]);
                        
                      
        
                            $data = array(
                                'sales_orders_id'   => $productData->id,
                                'customer_id'   => $customer_id[0]->customer_id,
                                'user_id'   => $customer_id[0]->user_id,
                                'product_id'   => $productData->product_id,
                                'order_number'   => $productData->order_number,
                                'machine_order_number'   => $productData->machine_order_number,
                                'date'   => $customer_id[0]->date,
                                'serial_number'   => $products_stock[0]->stock_number,
                                'PDI_status'   => $productData->PDI_status,
                                'PDI_message'   => $productData->PDI_message,
                                'payment_confirm'   => $productData->payment_confirm,
                                'notes'   => $productData->machines_notes,

                         		);
                               
                        $res = Production::insertGetId($data);
                    }
                    else{
                      
                        $products_stock = DB::select('select * from products where id=?', [$productData->product_id]);
                        //   echo "<pre>";
                        //          print_r($products_stock);die('hhh');
                        DB::table('productions')
                            ->where('sales_orders_id', $customer_id[0]->id)
                            ->where('customer_id', $customer_id[0]->customer_id)
                            ->where('product_id', $productData->product_id)
                            ->update([
                              
                                'order_number'   => $productData->order_number,
                                'machine_order_number'   => $productData->machine_order_number,
                                'date'   => $customer_id[0]->date,
                                'serial_number'   => $products_stock[0]->stock_number,
                            ]);
                    }
                }
        
                session()->flash('message', 'production added successfully');
                Session::flash('alert-type', 'success'); 
                return redirect('admin/production/index');
            } catch (\Exception $e) {
                Log::error($e->getMessage());
               
                session()->flash('message', 'Some error occured!');
                Session::flash('alert-type', 'error');
                return redirect('admin/sales_order/view'.'/'.$sales_orders_id);
            }
        }

         //===================================================

    public function view($id)
    {
   
		
		 $sales_order = DB::table('productions')->where('id',$id)->first(); 
      
        
            
            $data['result'] = Production::select('productions.*','customers.name as lead_name','customers.address as customers_address',
            'users.name as user_name','users.id as user_id','users.email as email','users.mobile as phone')
           ->leftjoin('users','users.id','=','productions.user_id')
           ->leftjoin('customers','customers.id','=','productions.customer_id')
           ->leftjoin('products','products.id','=','productions.product_id')
            ->where('productions.id',$id)
            ->first();
      
    //   print_r($data['result']);
    //   die();
        $products = array();
		$product_data = Product::join('product_images','products.id','=','product_images.product_id')
                            ->where('products.id',$data['result']->product_id)
                            ->select('products.id as product_id','products.category_id','products.dealer_id','products.title','products.price as product_price','products.type','products.status as product_status','product_images.image','products.attachment as product_attachment')
                            ->first();
            
        if (!empty($product_data)) {
            $products[] = [
                'id' => $product_data->product_id,
                'title' => $product_data->title,
                'price' => $data['result']->price,
                //'order_price' => $data['costs'],
                'quantity' => $data['result']->qty,
                'total_price' => $data['result']->total_price,
                'product_attachment' => $product_data->product_attachment,
                'image' => $product_data->image,
            ];
        }
		$data['products'] = $products;
        $quote_product = QuoteProduct::where('quote_id',$data['result']->quote_id)
                                            ->where('product_id',$data['result']->product_id)
                                            ->first();
        $data['extra_info'] = ExtraProductInfo::where('quote_id',$data['result']->quote_id)
                                            ->where('product_id',$data['result']->product_id)
                                            ->first();
                                          
                             
    	$data['comments'] = LeadComment::where('lead_id',$id)->get();
    	$data['user'] = User::find($data['result']->user_id);
    	$data['icons'] = [
					        'pdf' => 'pdf',
					        'doc' => 'word',
					        'docx' => 'word',
					        'xls' => 'excel',
					        'xlsx' => 'excel',
					        'ppt' => 'powerpoint',
					        'pptx' => 'powerpoint',
					        'txt' => 'alt',
                            'csv' => 'csv',
                            'png' => 'image',
					    ];
        $data['dealers'] = Dealer::where('status','1')->get();
        $data['serial_number'] = Product::where('title',$product_data->title)->get();

    	return view('admin.productions.view',$data);
    }

    //===================================================


    /*Update Serial Number */
    public function update(Request $request)
    {
    	$data = Production::find($request->id);
        $quote = Quote::where('id',$data->quote_id)->first();
		
        if ($request->type != 'all') {
            if ($request->type == 'payment_confirm') {
                $data->payment_confirm = $request->payment_confirm;
            }
            if ($request->type == 'PDI_status') {
                $data->PDI_status = $request->PDI_status;
            }
            if ($request->type == 'delivered') {
                $data->delivered = $request->delivered;
                $data->delivery_date = $request->delivered != '0' ? date('Y-m-d') : '';
            }
        }else{
            
            if (!empty($request->depot) || !empty($request->hitch) || !empty($request->buckets) || !empty($request->extra)) {
                ExtraProductInfo::where('quote_id',$data->quote_id)
                                ->where('product_id',$data->product_id)
                                ->update([
                                    'depot' => $request->depot,
                                    'hitch' => $request->hitch,
                                    'buckets' => $request->buckets,
                                    'extra' => $request->extra,
                                ]);
            }
            //=====================================================
             if(empty($request->serial_number)) {
                $data->serial_number = $data->serial_number;
            }
            else{
                $serialnum = $request->serial_number;
                $multiload = implode(',', $serialnum);
                $data->serial_number = $multiload;
            }
            $data->make = $request->make;
            $data->PDI_status = $request->PDI_status;
            $data->purchased_sheet = $request->purchased_sheet;
            $data->steel_parts_due = $request->steel_parts_due != '0' ? date('Y-m-d') : '';
            
            $data->parts_due = $request->parts_due;
            $data->build_start_week = $request->build_start_week;
			$data->notes = $request->notes;
			
            $data->build_shed = $request->build_shed;
            $data->electrics_start_week = $request->electrics_start_week;
            $data->build_finish_week = $request->build_finish_week;
            $data->ready_for_dispatch = $request->ready_for_dispatch;
            $data->machine_dispatched = $request->machine_dispatched;
            $data->dispatched_week = $request->dispatched_week;
            $data->dispatch_date = $request->dispatch_date;
            
            
        }
        
    	if ($data->save()) {
            $checkOrderStatus = SalesOrder::where('id',$request->id)
                                        ->where('PDI_status','1')
                                        ->where('payment_confirm','1')
                                        ->where('delivered','1')
                                        ->first();

            if (!empty($checkOrderStatus)) {
                $lead_update = Lead::find($quote->lead_id);
                $lead_update->status = 'Closed';
                $lead_update->save();
            }

    		return response()->json([
    			'status' => 'success'
    		]);
    	}else{
    		return response()->json([
    			'status' => 'error'
    		]);
    	}
    }

    //===================================================

}
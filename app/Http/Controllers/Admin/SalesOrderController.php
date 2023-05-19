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

use App\Models\AdminPermission;
use App\DataTables\SalesOrderDataTable;
use App\Helpers\AdminHelper;

class SalesOrderController extends Controller
{
    //=================================================================

	public function index(Request $request)
	{
        SalesOrder::where('is_read','0')->update(['is_read'=>'1']);

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
            $query = SalesOrder::join('products','sales_orders.product_id','=','products.id')
                                ->orderBy('id','DESC')
                                ->select('sales_orders.*','products.dealer_id','products.model');

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
            $data['results'] = SalesOrder::orderBy('id','DESC')->paginate(1000);
        }

		return view('admin/sales_order/index',$data);
	}
    public function completesales(Request $request)
	{
        SalesOrder::where('is_read','0')->update(['is_read'=>'1']);

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

        if (!empty($request->from) || !empty($request->to) || !empty($request->serial_number) || !empty($request->customer) || !empty($request->user) || !empty($request->status) || $request->delivered == '0' || $request->delivered == '1' || !empty($request->dealer_id) || !empty($request->model)) {
            $query = SalesOrder::join('products','sales_orders.product_id','=','products.id')
                                ->orderBy('id','DESC')
                                ->select('sales_orders.*','products.dealer_id','products.model');

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
            $data['results'] = SalesOrder::orderBy('id','DESC')->where('delivered',1)->paginate(1000);
        }

		return view('admin/sales_order/complete_sales',$data);
	}


            /*Create sale order*/
     public function createSalesOrder($id)
            {
            
            $data = array();
            $data['users'] = User::where('user_type','user')->orderBy('name')->get();
            $data['customers'] = Customer::where('status','1')->orderBy('name')->get();
            $data['dealers'] = Dealer::where('status','1')->get();
            $data['result'] = DB::table('sales_orders')->where('order_number',$id)->get();
                //  echo "<pre>";
                //      print_r($data['result']);die;
            $data['order_number'] = $id;

                
            return view('admin/sales_order/add',$data);
    }

        //==========================All machines save=======================================

public function save(Request $request)
  {
      try {
          $validator = Validator::make($request->all(), [
              'customer_id' 	=> 'required',
              //'user_id' 		=> 'required',
          ]);
          if ($validator->fails()) { 
              return redirect('admin/sales_order/add')
                          ->withErrors($validator)
                          ->withInput();
          } else {
            DB::table('sales_orders')->where('order_number',$request->order_number)
            ->update(array(
                'delivery_arrangements' => $request->delivery_arrangements,
                'notes' => $request->notes,
                'order_date' => $request->order_date,
                'order_status' => 'Waitlist',
                'machines_submit' => 1,
            )); 
           
              session()->flash('message', 'Order added successfully');
              Session::flash('alert-type', 'success'); 
              //return redirect()->back();
              return redirect('admin/sales_order/index');

          }
      } catch (\Exception $e) {
          Log::error($e->getMessage());
          session()->flash('message', 'Some error occured during save order');
          Session::flash('alert-type', 'error');
          return redirect()->back();
      }
  }
    //===================================================

    //===================================================

    public function view($id)
    {
   
		
		 $sales_order = DB::table('sales_orders')->where('id',$id)->first();
         $data['machin'] = DB::table('sales_orders')->where('order_number',$sales_order->order_number)->get();
         $data['costs']  = SalesOrder::with('Sort')->where('order_number', $sales_order->order_number)->groupBy('order_number')->sum('sales_orders.price','price');

        if ($sales_order->quote_id != 0) {
            $data['result'] = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
            ->join('leads','leads.id','=','quotes.lead_id')
            ->join('users','users.id','=','leads.user_id')
            ->leftjoin('customers','customers.id','=','sales_orders.customer_id')
            ->select('sales_orders.*','quotes.lead_id','quotes.attachment','customers.address as customers_address',
            'leads.name as lead_name','leads.email','leads.phone','leads.message as lead_message',
            'leads.status','leads.title as lead_title','users.name as user_name','users.id as user_id')
            ->where('sales_orders.id',$id)
            ->first();
        }
        else{
            
            $data['result'] = SalesOrder::select('sales_orders.*','customers.name as lead_name','customers.address as customers_address',
            'users.name as user_name','users.id as user_id','users.email as email','users.mobile as phone')
           ->leftjoin('users','users.id','=','sales_orders.user_id')
           ->leftjoin('customers','customers.id','=','sales_orders.customer_id')
           ->leftjoin('products','products.id','=','sales_orders.product_id')
            ->where('sales_orders.id',$id)
            ->first();
      }
      
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
                'order_price' => $data['costs'],
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

    	return view('admin.sales_order.view',$data);
    }

    //===================================================


    /*Update Serial Number */
    public function update(Request $request)
    {
    	$data = SalesOrder::find($request->id);
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
            $data->payment_confirm = $request->payment_confirm;
            $data->PDI_status = $request->PDI_status;
            $data->delivered = $request->delivered;
            $data->delivery_date = $request->delivered != '0' ? date('Y-m-d') : '';
            //$data->serial_number = $request->serial_number;
            $data->PDI_message = $request->PDI_message;
            $data->qty = $request->qty;
			$data->notes = $request->notes;
			//$serialnum = $request->serial_number;
            //$multiload = implode(',', $serialnum);
            //$data->serial_number = $multiload;
            $data->price = $request->price;
            $data->machines_submit = 1;
            //new entry
            $data->depot = $request->depot;
            $data->warranty = $request->warranty;
            $data->payment_type = $request->payment_type;
            $data->transport = $request->transport;
            $data->transport_price = $request->transport_price;
            $data->all_machine_price = $request->all_machine_price;
            $data->delivery_price = $request->delivery_price;
            $data->sub_total_price = ($request->all_machine_price + $request->transport_price + $request->delivery_price) * $request->qty;
            
            //End new entry
            $data->tax = ($data->sub_total_price  * $data->qty) * 23 / 100;
            $data->total_price = $data->sub_total_price + $data->tax;
        }
        DB::table('sales_orders')->where('order_number',  $data->order_number)
        ->update(array(
            'all_machine_price' => $request->all_machine_price,
            'depot' => $request->depot,
            'machines_submit' => 1,
            'warranty' => $request->warranty,
            'payment_type' => $request->payment_type,
            'transport' => $request->transport,
            'transport_price' => $request->transport_price,
            'delivery_price' => $request->delivery_price,
            'notes' => $request->notes,
            'sub_total_price' => $data->sub_total_price,
            'tax' => $data->tax,
            'total_price' => $data->total_price,

        ));  
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

    //==========================================================

    public function status(Request $request, $id){
        
        try {
            
            $data = SalesOrder::find($id);
            
            if($data->order_status == '1')
            {
                $order_status = '0';
            } 
            else 
            {
                $order_status = '1';
            }
            $data->order_status = $order_status;
            $data->save();
            
        
            session()->flash('message', 'Status update successfully');
            Session::flash('alert-type', 'success');
            return redirect('admin/sales_order/index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/sales_order/index');
        }
    }

    //===================================================

    public function getMakes($id)
    {
        $models = Product::where("dealer_id",$id)
                        ->where("status",'In Stock')
                        ->get();

        $data = [];
        $data[] = '<option value="" >Select Model</option>';
        foreach ($models as $key => $value) {
            $data[] = '<option value="'.$value->id.'">'.$value->model.'</option>';
        }
        
        return response()->json($data);
    }

    //====================================================
    //=================================================================
    public function getProductMakes($id)
            {
                $models = Product::where("dealer_id",$id)
                ->where("status",'In Stock')
                                    ->get();
                $data = [];
                $data[] = '<option value="" >Select Product</option>';
                foreach ($models as $key => $value) {
                    $data[] = '<option value="'.$value->id.'">'.$value->model.'</option>';
                }
                
                return response()->json($data);
    }

    //====================================================


    public function getSerialNumbers($name)
    {
        $serial_numbers = Product::where("model",$name)
                                ->where("status",'In Stock')
                                ->get(["stock_number","id"]);

        $data = [];
        $data[] = '<option value="" >Select Serial Number</option>';
        foreach ($serial_numbers as $key => $value) {

            $data[] = '<option value="'.$value->id.'">'.$value->stock_number.'</option>';
        }

        return response()->json($data);
    }

    //=================================================================

    public function add_machine(Request $request)
    {
        try {                
            $data = SalesOrder::find($request->sales_order_id);
            //=========================================================
            $product = Product::find($request->serial_no);
            //=========================================================
            
            //===Update Quote Product Data======================================================
 
            DB::table('quote_products')->where('quote_id',  $data->quote_id)->where('product_id',  $data->product_id)->update(array('product_id' => $product->id));  
            //=========================================================

            $data->product_id = $product->id;
            $data->serial_number = $product->stock_number;
            $data->save();

            $product->status = 'Sold';
            $product->save();

            session()->flash('message', 'Machine added successfully');
            Session::flash('alert-type', 'success'); 
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');
            return redirect()->back();
        }
    }

    //=================================================================

    public function getModels($id,$selected='')
    {
        $makes = Product::where("dealer_id",$id)->get(["model","id"]);

        $data = [];
        $data[] = '<option value="" >Select</option>';
        foreach ($makes as $key => $value) {
            if ($value->model == $selected) {
                $checked = 'selected';
            }else{
                $checked = '';
            }

            $data[] = '<option value="'.$value->model.'" '.$checked.'>'.$value->model.'</option>';
        }
        
        return response()->json($data);
    }

    //=================================================================

 public function addExtra(Request $request)
{               
    //             print_r($request->all());
				// die('hello');
		try {
			if (empty($request->depot) && empty($request->hitch) && empty($request->buckets) && empty($request->extra) && empty($request->tyres) && empty($request->loader) && empty($request->warranty) && empty($request->cabtype) && empty($request->accessories)) {
				session()->flash('message', 'Please enter any one value!');
	            Session::flash('alert-type', 'error');
	           	return redirect('admin/sales_order/view'.'/'.$request->id);
			}
			if($request->quote_id == 0){
                                     $product_exist = ExtraProductInfo::where('sales_orders_id',$request->sales_orders_id)->where('product_id',$request->product_id)->first();
                                 }else{
                                     $product_exist = ExtraProductInfo::where('quote_id',$request->quote_id)->where('product_id',$request->product_id)->first();
                                 }
    //     $product_exist = ExtraProductInfo::where('quote_id',$request->quote_id)
				// ->where('product_id',$request->product_id)
				// ->first();
				// print_r($product_exist);
				// die('hello');
				
        if (!empty($product_exist)) {
        DB::table('product_extra_info')->where('quote_id', $request->quote_id)->where('product_id', $request->product_id)
        ->update(array( 
            'depot' =>  $request->depot,
            'hitch' => $request->hitch,
            'buckets' => $request->buckets,
                'loader' => $request->loader,
            'warranty' => $request->warranty,
            'cabtype' => $request->cabtype,
            'tyres' => $request->tyres,
            'accessories' => $request->accessories,
            'extra' => $request->extra
        ));
        } else {
            DB::table('product_extra_info')->insert(
                array(
                    'quote_id' =>  $request->quote_id,
                    'sales_orders_id' =>  $request->sales_orders_id,
                    'product_id' => $request->product_id,
                    'user_id' => $request->user_id,
                    'depot' =>  $request->depot,
                    'hitch' => $request->hitch,
                    'buckets' => $request->buckets,
                    'loader' => $request->loader,
                    'warranty' => $request->warranty,
                    'cabtype' => $request->cabtype,
                    'tyres' => $request->tyres,
                    'accessories' => $request->accessories,
                    'extra' => $request->extra
                )
        );
        }
                    session()->flash('message', 'Added successfully44');
                    Session::flash('alert-type', 'success'); 
                    return redirect()->back();
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                    session()->flash('message', 'Some error occured!');
                    Session::flash('alert-type', 'error');
                    return redirect()->back();
                }
            }
	
	   public function addTrd(Request $request)
	{
		try {
			if (empty($request->model) && empty($request->make) && empty($request->year) && empty($request->hours) && empty($request->price) && empty($request->image)) {
				session()->flash('message', 'Please enter any one value!');
	            Session::flash('alert-type', 'error');
	           	return redirect('admin/quotes/edit'.'/'.$request->quote_id);
			}
            $trade_exist = TradeIn::where('quote_id',$request->quote_id)
            ->where('old_product_id',$request->old_product_id)
            ->first();
           
			if (!empty($trade_exist)) {
                DB::table('trade_ins')->where('quote_id', $request->quote_id)->where('old_product_id', $request->old_product_id)
                ->update(array( 
                    'make' =>  $request->make,
                    'model' => $request->model,
                    'year' => $request->year,
                    'hours' => $request->hours,
                    'price' => $request->price
                ));
              } else {
                 DB::table('trade_ins')->insert(
                     array(
                         'quote_id' =>  $request->quote_id,
                          'sales_orders_id' =>  $request->sales_orders_id,
                         'old_product_id' => $request->old_product_id,
                         'make' =>  $request->make,
                         'model' => $request->model,
                         'year' => $request->year,
                         'hours' => $request->hours,
                         'price' => $request->price
                     )
                );
              }
	       
			session()->flash('message', 'Added successfully');
			Session::flash('alert-type', 'success'); 
			return redirect()->back();
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');
			return redirect()->back();
        }
	}
	
		//====================================================================

		public function delete($id){
			try {
				$data = SalesOrder::find($id)->delete();
			
				session()->flash('message', 'SalesOrder deleted successfully');
				Session::flash('alert-type', 'success');
	
				return redirect('admin/sales_order/index');
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				session()->flash('message', 'Some error occured');
				Session::flash('alert-type', 'error');
	
				  return redirect('admin/sales_order/index');
			}
		}
//==================================================
	 //======================Add new Machine in order===========================================

     public function addOrderMachine(Request $request)
     {
         try {
             $product = Product::where('id',$request->product_id)->first();
 
             $quote_product = new QuoteProduct;
             $quote_product->quote_id = $request->quote_id;
             $quote_product->product_id = $request->product_id;
             $quote_product->price = $product->price;
             $quote_product->quantity = $request->quantity;
             $quote_product->total_price = $product->price * $request->quantity;
             $quote_product->save();
 
             $final_price = QuoteProduct::where('quote_id',$request->quote_id)->sum('total_price');
 
             $data = Quote::find($request->quote_id);
             $data->price = $final_price;
             $data->save();
 
             session()->flash('message', 'Machine added successfully');
             Session::flash('alert-type', 'success'); 
             return redirect('admin/quotes/edit'.'/'.$request->quote_id);
         } catch (\Exception $e) {
             Log::error($e->getMessage());
             session()->flash('message', 'Some error occured!');
             Session::flash('alert-type', 'error');
                return redirect('admin/quotes/edit'.'/'.$request->quote_id);
         }
     }
 
     //====================================================================
 
     //=================================================================

     public function machinesave(Request $request)
     {
       
         try {
           
             $validator = Validator::make($request->all(), [
                 'customer_id' 	=> 'required',
                 'user_id' 		=> 'required',
                 'order_number' => 'required',
             ]);
             if ($validator->fails()) { 
                return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
             } else {
                $orderexist = SalesOrder::where('order_number',$request->order_number)->where('product_id',$request->product_id)->first();
            //   print_r($orderexist);
            //   die();
                if (!empty($orderexist)) {
                
                  DB::table('sales_orders')->where('order_number', $request->order_number)->where('product_id',$request->product_id)
                  ->update(array( 
                      'machines_notes' => $request->machines_notes,
                      'price' => $request->price,
                      'machines_submit'  => 0,
                  ));
                  session()->flash('message', 'Order Update successfully');
                 Session::flash('alert-type', 'success'); 
                 return redirect()->back();
             
                }
                else{
                    $data = new SalesOrder;
                    //=========================================================
                    $data->customer_id = $request->customer_id;
                    $data->user_id = $request->user_id;
                    $data->order_number = $request->order_number;
                    $data->machine_order_number = $request->machine_order_number;
                    $data->machines_notes = $request->machines_notes;
                    $data->product_id = $request->product_id;
                    $data->order_status = 'Waitlist';
                    $data->machines_submit = 0;
                    $data->qty = 1;
                    $data->price = $request->price;
                    $data->tax = ($request->price * $data->qty) * 23 / 100;
                    $data->total_price = ($request->price * $data->qty) + $data->tax;
                    $data->notes = $request->notes;
                    $data->date = date('Y-m-d');
                    $data->save();
                }
                 if(!empty($data->attachment)){
                     $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
                 }else{
                     $pathToFile = '';
                 }
                 $user = User::where('id',$data->user_id)->first();
                 $customer = Customer::where('id',$data->customer_id)->first();
                
                 $products = DB::table('products')->where('id',$data->product_id)->first();
                 $leadData = Customer::find($data->customer_id);
               
                if(!empty($leadData->email)) {
                 $customer_myemail = $leadData->email;
             }
             else{
                 $customer_myemail = 'lalit@dmcconsultancy.com';
             }
   
             $emailData = array(
                 'email' => $customer_myemail,
                 'title' => 'New Sales Order',
                 'quote' => $data,
                 'customer' => $customer,
                 'products' => $products,
                 'user_email' => $user->email,
                 'users' => $user,
             );
             
             if(!empty($pathToFile)){
                
                 Mail::send('api.emails.sales', $emailData, function ($message) use ($emailData) {
                     $message->from('lalit@dmcconsultancy.com', 'New Sales Order');
                     $message->to($emailData['email']);
                     $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
                     $message->subject('New Sales Order');
                     $message->attach($emailData['pathToFile']);
                 });   
             }else{
                 Mail::send('api.emails.sales', $emailData, function ($message) use ($emailData) {
                     $message->from('lalit@dmcconsultancy.com', 'New Sales Order');
                     $message->to($emailData['email']);
                     $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
                     $message->subject('New Sales Order');
                 });
             } session()->flash('message', 'Order added successfully');
                 Session::flash('alert-type', 'success'); 
                 return redirect()->back();
             }
         }
          catch (\Exception $e) {
             Log::error($e->getMessage());
             session()->flash('message', 'Some error occured during save order');
             Session::flash('alert-type', 'error');
             return redirect()->back();
         }
     }
     //===================================================
     public function machineview($machine_order_number)
     {
          $sales_order = DB::table('sales_orders')->where('machine_order_number',$machine_order_number)->first();
        //     echo "<pre>";
        //   print_r($sales_order);die;
          $data['machin'] = DB::table('sales_orders')->where('machine_order_number',$sales_order->machine_order_number)->get();
          $data['costs']  = SalesOrder::with('Sort')->where('order_number', $sales_order->order_number)->groupBy('order_number')->sum('sales_orders.price','price');
         
 
         if ($sales_order->quote_id != 0) {
             $data['result'] = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
             ->join('leads','leads.id','=','quotes.lead_id')
             ->join('users','users.id','=','leads.user_id')
             ->leftjoin('customers','customers.id','=','sales_orders.customer_id')
             ->select('sales_orders.*','quotes.lead_id','quotes.attachment','customers.address as customers_address',
             'leads.name as lead_name','leads.email','leads.phone','leads.message as lead_message',
             'leads.status','leads.title as lead_title','users.name as user_name','users.id as user_id')
             ->where('sales_orders.machine_order_number',$machine_order_number)
             ->first();
         }
         else{
             
             $data['result'] = SalesOrder::select('sales_orders.*','customers.name as lead_name','customers.address as customers_address',
             'users.name as user_name','users.id as user_id','users.email as email','users.mobile as phone')
            ->leftjoin('users','users.id','=','sales_orders.user_id')
            ->leftjoin('customers','customers.id','=','sales_orders.customer_id')
            ->leftjoin('products','products.id','=','sales_orders.product_id')
             ->where('sales_orders.machine_order_number',$machine_order_number)
             ->first();
       }
       
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
                 'order_price' => $data['costs'],
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
                                           
                              
         $data['comments'] = LeadComment::where('lead_id',$machine_order_number)->get();
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
 
         return view('admin.sales_order.machineview',$data);
     }
 

     public function machineedit($machine_order_number)
     {
       $specshit = SalesOrder::find($machine_order_number);
       print_r($specshit);
       die();
       return response()->json([
        'status' =>200,
        'specshit' => $specshit,
       ]);

     }
    
     //===================================================
     public function specview($machine_order_number)
     {
          $sales_order = DB::table('sales_orders')->where('machine_order_number',$machine_order_number)->first();
        //     echo "<pre>";
        //   print_r($sales_order);die;
          $data['machin'] = DB::table('sales_orders')->where('machine_order_number',$sales_order->machine_order_number)->get();
          $data['costs']  = SalesOrder::with('Sort')->where('order_number', $sales_order->order_number)->groupBy('order_number')->sum('sales_orders.price','price');
         
 
         if ($sales_order->quote_id != 0) {
             $data['result'] = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
             ->join('leads','leads.id','=','quotes.lead_id')
             ->join('users','users.id','=','leads.user_id')
             ->leftjoin('customers','customers.id','=','sales_orders.customer_id')
             ->select('sales_orders.*','quotes.lead_id','quotes.attachment','customers.address as customers_address',
             'leads.name as lead_name','leads.email','leads.phone','leads.message as lead_message',
             'leads.status','leads.title as lead_title','users.name as user_name','users.id as user_id')
             ->where('sales_orders.machine_order_number',$machine_order_number)
             ->first();
         }
         else{
             
             $data['result'] = SalesOrder::select('sales_orders.*','customers.name as lead_name','customers.address as customers_address',
             'users.name as user_name','users.id as user_id','users.email as email','users.mobile as phone')
            ->leftjoin('users','users.id','=','sales_orders.user_id')
            ->leftjoin('customers','customers.id','=','sales_orders.customer_id')
            ->leftjoin('products','products.id','=','sales_orders.product_id')
             ->where('sales_orders.machine_order_number',$machine_order_number)
             ->first();
       }
       
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
                 'order_price' => $data['costs'],
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
                                           
                              
         $data['comments'] = LeadComment::where('lead_id',$machine_order_number)->get();
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
 
         return view('admin.sales_order.specview',$data);
     }



     public function machinespecsheet(Request $request)
	{ 
		try {
			$validator = Validator::make($request->all(), [
				//'filters' => 'required',
			]);
			if ($validator->fails()) { 
	            return redirect()->back()
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
            $service_exist = SpecSheet::where('machine_order_number',$request->machine_order_number)->first();
        
            if (!empty($service_exist)) {

                if(empty($request->mandatory)){
                    $mandatory='';
                    }else{
                            $mandatory=implode('/',$request->mandatory);    
                        }
                    if(empty($request->optional_extras)){
                        $optional_extras='';
                    }else{
                     $optional_extras=implode('/',$request->optional_extras);
                     }
                     if(empty($request->additional_iteams)){
                        $additional_iteams='';
                     }else{
                    $additional_iteams=implode('/',$request->additional_iteams);   
                  }
                DB::table('spec_sheets')->where('machine_order_number', $request->machine_order_number)
                ->update(array( 
                    'mandatory' => $mandatory,
                    'optional_extras' => $optional_extras,
                    'additional_iteams' =>$additional_iteams,
                ));
              } else {
            
               if(empty($request->mandatory)){
                $mandatory='';
                }else{
                        $mandatory=implode('/',$request->mandatory);    
                    }
                if(empty($request->optional_extras)){
                    $optional_extras='';
                }else{
                 $optional_extras=implode('/',$request->optional_extras);
                 }
                 if(empty($request->additional_iteams)){
                    $additional_iteams='';
                 }else{
                $additional_iteams=implode('/',$request->additional_iteams);   
              }
                    $data = new SpecSheet;
                    //=========================================================
                    $data->machine_order_number = $request->machine_order_number;
                    $data->mandatory = $mandatory;
                    $data->optional_extras = $optional_extras;
                    $data->additional_iteams = $additional_iteams;
	                $data->save();
              }
              $additionalspec = AdditionalSpecSheet::where('machine_order_number',$request->machine_order_number)->first();
              if (!empty($additionalspec)) {
                DB::table('spec_additionals')->where('machine_order_number', $request->machine_order_number)
                ->update(array( 
                    'custom_paint' => $request->custom_paint,
                    'extra_vacuum_heads' => $request->extra_vacuum_heads,
                     'extra_clamps' =>$request->extra_clamps,
                     'extra_standard_hose' =>$request->extra_standard_hose,
                     'heavy_duty' =>$request->heavy_duty,
                     'impeller' =>$request->impeller,
                ));
              }
              else{
                    $data = new AdditionalSpecSheet;
                    //=========================================================
                    $data->machine_order_number = $request->machine_order_number;
                    $data->custom_paint = $request->custom_paint;
                    $data->extra_vacuum_heads = $request->extra_vacuum_heads;
                    $data->extra_clamps = $request->extra_clamps;
                    $data->extra_standard_hose = $request->extra_standard_hose;
                    $data->heavy_duty = $request->heavy_duty;
                    $data->impeller = $request->impeller;

	                $data->save();
              }
              $result =$request->order_number;
                    
                    session()->flash('message', 'Record added successfully');
				    Session::flash('alert-type', 'success'); 
				    return redirect()->back();
			}
        
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
            //    print_r($e);
            //    die();
	        session()->flash('message', 'Some error occured during save record');
            Session::flash('alert-type', 'error');
			return redirect()->back();
        }
	}

    
    //===================================================

    
    public function orderCompleted(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				//'filters' => 'required',
			]);
			if ($validator->fails()) { 
	            return redirect()->back()
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
           // $service_exist = SpecSheet::where('machine_order_number',$request->machine_order_number)->first();
          DB::table('sales_orders')->where('order_number', $request->order_number)
                ->update(array( 
                    'order_status' => 1,
                    'PDI_status' => 1,
                     'payment_confirm' =>1,
                     'delivered' =>1,
                     'delivery_date' => date('Y-m-d'),
                ));
                    session()->flash('message', 'Record added successfully');
				    Session::flash('alert-type', 'success'); 
				
				return redirect()->back();
			}
        
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
            //    print_r($e);
            //    die();
	        session()->flash('message', 'Some error occured during save record');
            Session::flash('alert-type', 'error');
			return redirect()->back();
        }
	}
    //---------------------------------------------------------------
       
}
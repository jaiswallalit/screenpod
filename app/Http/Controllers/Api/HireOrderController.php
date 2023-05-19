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
use App\Models\Lead;
use App\Models\Customer;
use App\Models\User;
use App\Models\LeadComment;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\Product;
use App\Models\ExtraProductInfo;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\SalesOrder;
use App\Helpers\AdminHelper;
use Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Response;
use App\Models\AdditionalSpecSheet;
use App\Models\SpecSheet;
use App\Models\Contract;
use App\Models\HireOrder;

class HireOrderController extends Controller
{
    /*Hire order list by user*/
    public function getHireOrders(Request $request)
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

        $data = HireOrder::join('quotes','hire_orders.quote_id','=','quotes.id')
                            ->join('leads','leads.id','=','quotes.lead_id')
                            ->join('customers','customers.id','=','hire_orders.customer_id')
                            ->join('products','products.id','=','hire_orders.product_id')
                            ->join('users','users.id','=','leads.user_id')
                            ->select('hire_orders.*','products.title','customers.name as customer_name','hire_orders.price','hire_orders.product_id','quotes.lead_id','quotes.attachment','leads.user_id','leads.name as lead_name','leads.email','leads.phone','leads.status','users.name as user_name')
                            ->where('leads.user_id',$request->user_id)
                            ->orderBy('hire_orders.id','DESC')
                            ->get();


        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }



    /*Create sale order*/
    
     /*Create sale order*/
    
     public function createHireOrder(Request $request)
    {
		 try {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
            $quote_products = json_decode($request->data);
            
            //$data = Quote::find($request->quote_id);
            foreach($quote_products as $key=>$quote_productdata)
			{
                $quote =  Quote::find($request->quote_id);
                $quote_products = QuoteProduct::where('quote_id',$request->quote_id)->where('sent',1)->get();
                   
                foreach ($quote_products as $key => $value) {
                    $serial_no = Product::where('id',$value->product_id)->first();
                    if ($serial_no->status == "In Stock") {
                        $serial_number = $serial_no->stock_number;
                    }else{
                        $serial_number = '';
                    }
                    $product_exist = DB::select('select * from hire_orders where quote_id=? and product_id=?', [$request->quote_id, $quote_productdata->product_id,]);

                  
                  // $order_number = DB::table('hire_orders')->count() +1;
                   //$macine_order_number = DB::table('hire_orders')->where('order_number',$order_number)->count() +1;
                  
                   $order_number = DB::table('hire_orders')->count() +1; 
                   $chrList = $order_number;
                   $chrRepeatMin = 'CB0'; 
                   $chrRepeatMax = $request->product_id;
                   $chrRandomLength = 'VB';
                   $agreement_no= $chrRepeatMin.''.$chrList.''.$chrRepeatMax.''.$chrRandomLength;
                   $ordernum = '#ON0'; 
                   $order_number= $ordernum.''.$chrList.''.$chrRepeatMax;



                    $data= [];	
                    if(empty($product_exist)) {
                        $data = new HireOrder;
                        //=========================================================
                        $data->quote_id = $request->quote_id;
                        $data->agreement_no = $agreement_no;
                        $data->order_number = $order_number;
                        $data->customer_id = $request->customer_id;
                        $data->user_id = $request->user_id;
                        $data->product_id = $quote_productdata->product_id;
                        $data->price = $quote_productdata->price;
                        $data->currency = $quote_productdata->currency;
                        $data->order_status = 'Waitlist';
                        $data->qty = $quote_productdata->qty;
                        $data->tax = ($quote_productdata->price * $quote_productdata->qty) * 23 / 100;
                        $data->total_price = ($quote_productdata->price * $quote_productdata->qty) + $data->tax;
                        //$data->message = $request->message;
                        $data->serial_number = '';
                        $data->date = date('Y-m-d');
                        // print_r($data);
                        // die();
                        $data->save();
                    }
                    else{
                         $tax= ($quote_productdata->price * $quote_productdata->qty) * 23 / 100;
                        DB::table('hire_orders')->where('quote_id', $request->quote_id)
                        ->where('product_id',$quote_productdata->product_id)
                        ->update(array(
                             'price'=>$quote_productdata->price,
                             'currency'=>$quote_productdata->currency,
                             'qty'=>$quote_productdata->qty,
                             'tax'=>($quote_productdata->price * $quote_productdata->qty) * 23 / 100,
                             'total_price'=> ($quote_productdata->price * $quote_productdata->qty) + $tax,
                             ));
                    }
                }
			}
            foreach ($quote_products as $key => $value) {
                if ($value->quantity == '1') {
                    $save_product = Product::find($value->product_id);
                    $save_product->status = 'Sold';
                    $save_product->save();
                }else{
                    $find_products = Product::where('id',$value->product_id)->first();
                    $duplicate_products = Product::where('title',$find_products->title)->limit($value->quantity)->orderBy('order_no')->get();

                    foreach ($duplicate_products as $other_products) {
                        $save_product1 = Product::find($other_products->id);
                        $save_product1->status = 'Sold';
                        $save_product1->save();
                    }
                }
            }

            return response()->json(array(
                'status' => 200,
                'message'=> 'Success',
                'success_message'=>'Hire order created successfully.',
                'data' => $data,
            ),200);
        }
		 }
			 catch (\Exception $e) {
        dd($e->getMessage());die;
    }
    }
    
		
		
		public function createHire(Request $request)
    {
        // print_r($request->all());
        // die();
		 try {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'customer_id' => 'required',
          //  'product_id' => 'required',

        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
            //$data = SalesOrder::find($request->product_id);
            $product = $request->data;
            $product1 = json_decode($product);
            foreach ($product1 as $file) {

              $product_existss = HireOrder::where('user_id',$request->user_id)
                ->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)
               ->first();
               

               $order_number = DB::table('hire_orders')->count() +1; 
               $chrList = $order_number;
               $chrRepeatMin = 'CB0'; 
               $chrRepeatMax = $request->product_id;
               $chrRandomLength = 'VB';
               $agreement_no= $chrRepeatMin.''.$chrList.''.$chrRepeatMax.''.$chrRandomLength;
               $ordernum = '#ON0'; 
               $order_number= $ordernum.''.$chrList.''.$chrRepeatMax;

               if (empty($product_existss)) {
                $data = new HireOrder;
                //=========================================================
                $data->agreement_no = $agreement_no;
                $data->order_number = $order_number;
                $data->user_id = $request->user_id;
                $data->customer_id = $request->customer_id;
                $data->product_id = $file->product_id;
                $data->price = $file->price;
                $data->serial_number = '';
                $data->order_status = 'Waitlist';
             
                $data->qty = $file->qty;
                $data->tax = ($file->price * $file->qty) * 23 / 100;
                $data->total_price = ($file->price * $file->qty) + $data->tax;
                //$data->message = $request->message;
                $data->date = date('Y-m-d');
                $data->save();
               }
               else{
                $tax = ($file->price * $file->qty) * 23 / 100;
                // print_r($tax);
                // die();
                DB::table('hire_orders')->where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->update([
                    'price' => $file->price,
                    'qty' => $file->qty,
                    'sendprivew' => '0',
                    'tax'=>$tax,
                    'total_price' =>($file->price * $file->qty) + $tax,
                ]);
               }
                
            }
			}
            $result = array(
                'products'=>$product1,
                'user_id' => $request->user_id,
                'customer_id' => $request->customer_id
            );
            return response()->json(array(
                'status' => 200,
                'message'=> 'Success',
                'success_message'=>'Hire order created successfully.',
                'data' => $result,
            ),200);
        }
		 
			 catch (\Exception $e) {
        dd($e->getMessage());die;
    }
    }
        /*13 march Send Privew SalesOrder sale order*/
            public function sendpriviewHireorder(Request $request)
            {
                // print_r($request->all());
                // die();
                 try {
                $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                    'customer_id' => 'required',
                  //  'product_id' => 'required',
        
                ]);
                if ($validator->fails()) { 
                    return response()->json(array(
                                                'status' => 400,
                                                'message'=> 'Error',
                                                'error_message'=>$validator->errors()
                                            ),200);
                } else {
                    $product = $request->data;
                    $product1 = json_decode($product);
                    foreach ($product1 as $file) {
                    $product_existss = HireOrder::where('user_id',$request->user_id)
                    ->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)
                       ->first();
                       $order_number = DB::table('hire_orders')->count() +1; 
                       $chrList = $order_number;
                       $chrRepeatMin = 'CB0'; 
                       $chrRepeatMax = $request->product_id;
                       $chrRandomLength = 'VB';
                       $agreement_no= $chrRepeatMin.''.$chrList.''.$chrRepeatMax.''.$chrRandomLength;
                       $ordernum = '#ON0'; 
                       $order_number= $ordernum.''.$chrList.''.$chrRepeatMax;
        
                       if (empty($product_existss)) {
                        $data = new HireOrder;
                        //=========================================================
                        $data->agreement_no = $agreement_no;
                        $data->order_number = $order_number;
                        $data->user_id = $request->user_id;
                        $data->customer_id = $request->customer_id;
                        $data->product_id = $file->product_id;
                        $data->price = $file->price;
                        $data->currency = $file->currency;
                        $data->serial_number = '';
                        $data->order_status = 'Waitlist';
                        $data->qty = $file->qty;
                        $data->tax = ($file->price * $file->qty) * 23 / 100;
                        $data->total_price = ($file->price * $file->qty) + $data->tax;
                        //$data->message = $request->message;
                        $data->date = date('Y-m-d');
                        $data->save();
                        
                       }
                       
                       else{
                        $data = HireOrder::where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->where('sendprivew',1)->get();

                        $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $chrRepeatMin = 1; // Minimum times to repeat the seed string
                        $chrRepeatMax = 10; // Maximum times to repeat the seed string
                        $chrRandomLength = 10;
                        $pdfname= substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))), 1, $chrRandomLength);
                        $user = User::where('id',$request->user_id)->first();
                        $customer = Customer::where('id',$request->customer_id)->first();      
                        $filepdf = "hireorder_$pdfname.pdf";
                        // $data->pdf_url = $filepdf;
                         $result = array(
                            'products'=>$product1,
                            'customer' => $customer,
                            'quote' => $data,
                            'user_email' => $user->email,
                            'users' => $user,
                        );
                        $pdf = PDF::loadView('admin.hire_order.hireorder',  $result);
                    Storage::disk('uploads')->put('hireorder_' . $pdfname . '.pdf', $pdf->output());
                   
                        $tax = ($file->price * $file->qty) * 23 / 100;
                        DB::table('hire_orders')->where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->update([
                            'price' => $file->price,
                            'qty' => $file->qty,
                            'currency' => $file->currency,
                            'tax'=>$tax,
                            'sendprivew' => '1',
                            'total_price' =>($file->price * $file->qty) + $tax,
                            'pdf_url' => $filepdf,

                        ]);
                       }

                    }
                    }
                 
                   
                    
                    return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Hire order created successfully.',
                        'data' => $result,
                    ),200);
                }
                 
                     catch (\Exception $e) {
                dd($e->getMessage());die;
            }
            }
  /*Privew Refresh Privew Quote */  

    public function refreshPrivewhireOrder(Request $request)
    {
       $validator = Validator::make($request->all(), [
           'hire_orders_id' => 'required',
       ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {

            DB::table('hire_orders')->where('id',$request->hire_orders_id)->update([
                'sendprivew' => '0',
            ]);
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Remove Hire preview Data.',
                                        ),200);
            }
        }
		    /*13 march privewSalesOrder  SalesOrder sale order*/
            public function privewHireOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hire_orders_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }
        else {
            $sales_order = DB::table('hire_orders')->where('id',$request->hire_orders_id)->where('sendprivew',1)->first();
                        if($sales_order->quote_id == 0) {
                            $sales = HireOrder::join('products','hire_orders.product_id','=','products.id')
                            ->leftjoin('customers','hire_orders.customer_id','=','customers.id')
                            ->leftjoin('dealers','products.dealer_id','=','dealers.id')
                            ->leftjoin('quotes','hire_orders.quote_id','=','quotes.id')
                            ->leftjoin('hire_info','hire_orders.id','=','hire_info.hire_orders_id')
                            //->leftjoin('trade_ins','hire_orders.id','=','trade_ins.hire_orders_id','hire_orders.product_id','=','product_extra_info.old_product_id')
                            //->leftjoin('users','users.id','=','sales_orders.user_id')
                            ->leftjoin('users','hire_orders.user_id','=','users.id')
                           ->select('hire_orders.*',
                           'products.title as product_title',
                           'description as description',
                           'products.model as model',
                           'products.attachment as attachment',
                           'products.type as product_type',
                           'products.status as product_status',
                           'dealers.name as dealer_name',
                           'users.name as user_name',
                           'users.email as user_email',
                           'users.mobile as user_mobile',
                           'customers.name as customer_name',
                           'customers.email as email',
                           'hire_info.min_hire_period as min_hire_period',
                           'hire_info.payment_terms as payment_terms',
                           'hire_info.purcharse_period as purcharse_period',
                           'hire_info.consumables as consumables',
                           'hire_info.transport_in as transport_in',
                           'hire_info.weekly_hire_price as weekly_hire_price',
                           'hire_info.fittings_price as transport_out_price',
                           'hire_info.delivery_location as delivery_location',
                           'hire_info.site_contact as site_contact',
                           'hire_info.hire_start as hire_start',
                           'hire_info.hire_end as hire_end'
                                   )
                            ->where('hire_orders.id',$request->hire_orders_id)
                            ->where('sendprivew',1)
                            ->first();
                        }
                        else{
                            $sales = HireOrder::join('products','hire_orders.product_id','=','products.id')
                        ->leftjoin('customers','hire_orders.customer_id','=','customers.id')
                        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
                        ->leftjoin('quotes','hire_orders.quote_id','=','quotes.id')
                       ->leftjoin('hire_info', function($q) {
                        $q->on('hire_orders.quote_id','=','hire_info.quote_id')
                           ->on('hire_orders.product_id','=','hire_info.product_id'); //second join condition
                    }) 

                    // ->leftjoin('trade_ins', function($q) {
                    //     $q->on('hire_orders.quote_id','=','trade_ins.quote_id')
                    //        ->on('hire_orders.product_id','=','trade_ins.old_product_id'); //second join condition
                    // }) 

                      // ->leftjoin('trade_ins','sales_orders.quote_id','=','trade_ins.quote_id','sales_orders.product_id','=','product_extra_info.old_product_id')
                       ->leftjoin('leads','leads.id','=','quotes.lead_id')
                       // ->leftjoin('users','users.id','=','sales_orders.user_id')
                       ->leftjoin('users','hire_orders.user_id','=','users.id')
                       ->select('hire_orders.*',
                       'products.title as product_title',
                       'description as description',
                       'products.model as model',
                       'products.attachment as attachment',
                       'products.type as product_type',
                       'products.status as product_status',
                       'dealers.name as dealer_name',
                       'users.name as user_name',
                       'users.email as user_email',
                       'users.mobile as user_mobile',
                       'customers.name as customer_name',
                       'customers.email as email',
                       'hire_info.min_hire_period as min_hire_period',
                       'hire_info.payment_terms as payment_terms',
                       'hire_info.purcharse_period as purcharse_period',
                       'hire_info.consumables as consumables',
                       'hire_info.transport_in as transport_in',
                       'hire_info.weekly_hire_price as weekly_hire_price',
                       'hire_info.fittings_price as transport_out_price',
                       'hire_info.delivery_location as delivery_location',
                       'hire_info.site_contact as site_contact',
                       'hire_info.hire_start as hire_start',
                       'hire_info.hire_end as hire_end'
                       
                               )
                        ->where('hire_orders.id',$request->hire_orders_id)
                        ->where('sendprivew',1)
                        ->first();
                        }       
        $data = [];
        $data[] = [
                'id' => $request->hire_orders_id,
                //'products' => $this->getProducts($quote->id),
                'quote_id' => $sales->quote_id,
                'product_id' => $sales->product_id,
                'product_title' => $sales->product_title,
                'description' => $sales->description,
                'model' => $sales->model,
                'attachment' => $sales->attachment,
                'product_type' => $sales->product_type,
                'product_status' => $sales->product_status,
                'dealer_name' => $sales->dealer_name,
                'user_id' => $sales->user_id,
                'user_name' => $sales->user_name,
                'user_email' => $sales->user_email,
                'user_mobile' => $sales->user_mobile,
                'customer_id' => $sales->customer_id,
                'customer_name' => $sales->customer_name,
                'email' => $sales->email,
                'price' => $sales->price,
                'currency' => $sales->currency,
                'qty' => $sales->qty,
                'tax' => $sales->tax,
                'message' => $sales->message,
                'PDI_status' => $sales->PDI_status,
                'PDI_message' => $sales->PDI_message,
                'payment_confirm' => $sales->payment_confirm,
                'delivered' => $sales->delivered,
                'delivery_date' => $sales->delivery_date,
                'is_read' => $sales->is_read,
                'order_status' => $sales->order_status,
                'serial_number' => $sales->serial_number,
                'pdf_url' => $sales->pdf_url,
                'date' => $sales->date,
                'total_price' => $sales->total_price,
                'min_hire_period' => $sales->min_hire_period,
                'payment_terms' => $sales->payment_terms,
                'purcharse_period' => $sales->purcharse_period,
                'consumables' => $sales->consumables,
                'transport_in' => $sales->transport_in,
                'weekly_hire_price' => $sales->weekly_hire_price,
                'fittings_price' => $sales->fittings_price,
                'transport_out_price' => $sales->transport_out_price,
                'site_contact' => $sales->site_contact,
                'hire_start' => $sales->hire_start,
                'hire_end' => $sales->hire_end,
                
            ];
        
        
        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'product_image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'quote_attachment_path' => url('/public/admin/clip-one/assets/quotes/'),
                        'privew_path' => url('/public/uploads/').'/'.$sales->pdf_url,
                        'data' => $data
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }
    }
		    /*filterHireOrder sale order*/

   public function filterHireOrder(Request $request)
    {
       $query = HireOrder::join('products','hire_orders.product_id','=','products.id')
                        ->leftjoin('customers','hire_orders.customer_id','=','customers.id')
                        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
                        ->leftjoin('quotes','hire_orders.quote_id','=','quotes.id')
                        ->leftjoin('leads','leads.id','=','quotes.lead_id')
                        ->leftjoin('users','users.id','=','hire_orders.user_id');

        if (!empty($request->search)) {
            $search = $request->search;
            $query = $query->where('products.title','LIKE','%'.$search.'%');
        }
        if (!empty($request->model)) {
            $model = $request->model;
            $query = $query->where('products.model','LIKE','%'.$model.'%');
        }
        if (!empty($request->type)) {
            $type = $request->type;
            $query = $query->where('products.type',$type);
        }
        if (!empty($request->status)) {
            $status = $request->status;
            $query = $query->where('products.status',$status);
        }
        if (!empty($request->date)) {
            $date = $request->date;
            $query = $query->where('hire_orders.date',$date);
        }
        if (!empty($request->customers)) {
            $customer = $request->customers;
            $query = $query->where('customers.name','LIKE','%'.$customer.'%');
        }
		if (!empty($request->make)) {
			$make = $request->make;
			$query = $query->where('dealers.name','LIKE','%'.$make.'%');
        }

        $data = $query->select('hire_orders.*','products.title as product_title','products.model as model','products.attachment as attachment','products.type as product_type',
				'products.status as product_status','dealers.name as dealer_name','customers.name as customer_name','customers.email as email')
                            //->where('leads.user_id',$request->user_id)
                            ->where('users.id',$request->user_id)
                            ->get();


         if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'data' => $data
                    ),200);
        }else{
            return response()->json(array(
                        'status' => 400,
                        'message'=> 'Error',
                        'error_message'=>'No data found!'
                    ),200);
        }
    }
   


    /* Spacsheet */
public function AdditionalSpec(Request $request)
{
    try {
            $validator = Validator::make($request->all(), [
            'machine_order_number' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'status' => 400,
                'message' => 'Error',
                'error_message' => $validator->errors()
            ), 200);
        } else {
            $specSheet_exist = SpecSheet::where('machine_order_number',$request->machine_order_number)->first();

            if (!empty($specSheet_exist)) {
               
                    if(empty($request->optional_extras)){
                        $optional_extras='';
                    }else{
                     $optional_extras=implode('/',$request->optional_extras);
                     }
                     
                    // $optional_extras = $request->optional_extras;
                    // $optional_extras1 = json_decode($optional_extras);
                    // $optional_extras2=implode('/',$optional_extras1);
                    //print_r($optional_extras2);die();
               
                  DB::table('spec_sheets')->where('machine_order_number', $request->machine_order_number)
                  ->update(array( 
                      'mandatory' => $request->mandatory,
                      'optional_extras' => $optional_extras,
                  ));
                
             } else {
            
                    //  if(empty($request->optional_extras)){
                    //      $optional_extras='';
                    //  }else{
                    //   $optional_extras=implode('/',$request->optional_extras);
                    //   }
                      
                         $data = new SpecSheet;
                         //=========================================================
                         $data->machine_order_number = $request->machine_order_number;
                         $data->mandatory = $request->mandatory;
                         $data->optional_extras = $request->optional_extras;
                         
                        //  print_r($data);
                        //  die();
                         
                         $data->save();
                   }

            $additionalspec = AdditionalSpecSheet::where('machine_order_number',$request->machine_order_number)->first();

            $data= [];
            if (empty($additionalspec)) {
                $data = new AdditionalSpecSheet;
                    //=========================================================
                    $data->machine_order_number = $request->machine_order_number;
                    $data->custom_paint = $request->custom_paint;
                    $data->extra_vacuum_heads = $request->extra_vacuum_heads;
                    $data->extra_clamps = $request->extra_clamps;
                    $data->extra_standard_hose = $request->extra_standard_hose;
                    $data->heavy_duty = $request->heavy_duty;
                    $data->impeller = $request->impeller;
	                //print_r($data);die();
                    $data->save();
                    
                return response()->json(array(
                    'status' => 200,
                    'message'=> 'Success',
                    'success_message'=>'Record added successfully.',
                    'data' => $data,
                ),200); 
            } 
            else {
                DB::table('spec_additionals')->where('machine_order_number', $request->machine_order_number)
                ->update(array( 
                     'custom_paint' => $request->custom_paint,
                     'extra_vacuum_heads' => $request->extra_vacuum_heads,
                     'extra_clamps' =>$request->extra_clamps,
                     'extra_standard_hose' =>$request->extra_standard_hose,
                     'heavy_duty' =>$request->heavy_duty,
                     'impeller' =>$request->impeller,
                ));
                   return response()->json(array(
                    'status' => 200,
                    'message'=> 'Success',
                    'success_message'=>'Record  Update successfully.',
                    'data' => $data,
                ),200);
            }
           

        }
          
    } 
    catch (\Exception $e) {
        return $e->getMessage();
    }
}
}
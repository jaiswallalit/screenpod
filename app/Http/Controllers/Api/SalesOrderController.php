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

class SalesOrderController extends Controller
{
    /*Sales order list by user*/
    public function getSalesOrders(Request $request)
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

        $data = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
                            ->join('leads','leads.id','=','quotes.lead_id')
                            ->join('customers','customers.id','=','sales_orders.customer_id')
                            ->join('products','products.id','=','sales_orders.product_id')
                            ->join('users','users.id','=','leads.user_id')
                            ->select('sales_orders.*','products.title','customers.name as customer_name','sales_orders.price','sales_orders.product_id','quotes.lead_id','quotes.attachment','leads.user_id','leads.name as lead_name','leads.email','leads.phone','leads.status','users.name as user_name')
                            ->where('leads.user_id',$request->user_id)
                            ->orderBy('sales_orders.id','DESC')
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
    
     public function createSalesOrder(Request $request)
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
                    $product_exist = DB::select('select * from sales_orders where quote_id=? and product_id=?', [$request->quote_id, $quote_productdata->product_id,]);
                //    $order = DB::table('sales_orders')->get();
                   
                //    $lastActivity = SalesOrder::latest()->first();
                   $order_number = DB::table('sales_orders')->count() +1;
                   $macine_order_number = DB::table('sales_orders')->where('order_number',$order_number)->count() +1;
                //    print_r($product_exist);
                //    die();
                    $data= [];	
                    if(empty($product_exist)) {
                        $data = new SalesOrder;
                        //=========================================================
                        $data->quote_id = $request->quote_id;
                        $data->order_number = '23_'.$order_number;
                        $data->machine_order_number = '23_'.$order_number.'_'.$macine_order_number;
                        $data->customer_id = $request->customer_id;
                        $data->user_id = $request->user_id;
                        $data->product_id = $quote_productdata->product_id;
                        $data->price = $quote_productdata->price;
                        $data->currency = $quote_productdata->currency;
                        $data->order_status = 'Waitlist';
                        $data->qty = $quote_productdata->qty;
                        $data->tax = ($quote_productdata->price * $quote_productdata->qty) * 23 / 100;
                        $data->total_price = ($quote_productdata->price * $quote_productdata->qty) + $data->tax;
                        $data->message = $request->message;
                        $data->serial_number = '';
                        $data->date = date('Y-m-d');
                        // print_r($data);
                        // die();
                        $data->save();
                    }
                    else{
                         $tax= ($quote_productdata->price * $quote_productdata->qty) * 23 / 100;
                        DB::table('sales_orders')->where('quote_id', $request->quote_id)
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
                'success_message'=>'Sales order created successfully.',
                'data' => $data,
            ),200);
        }
		 }
			 catch (\Exception $e) {
        dd($e->getMessage());die;
    }
    }
    
		
		
		public function createOrder(Request $request)
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

 $product_existss = SalesOrder::where('user_id',$request->user_id)
                ->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)
               ->first();
               
               if (empty($product_existss)) {
                $data = new SalesOrder;
                //=========================================================
                $data->user_id = $request->user_id;
                $data->customer_id = $request->customer_id;
                $data->product_id = $file->product_id;
                $data->price = $file->price;
                $data->serial_number = '';
                $data->order_status = 'Waitlist';
             
                $data->qty = $file->qty;
                $data->tax = ($file->price * $file->qty) * 23 / 100;
                $data->total_price = ($file->price * $file->qty) + $data->tax;
                $data->message = $request->message;
                $data->date = date('Y-m-d');
                $data->save();
               }
               else{
                $tax = ($file->price * $file->qty) * 23 / 100;
                // print_r($tax);
                // die();
                DB::table('sales_orders')->where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->update([
                    'price' => $file->price,
                    'qty' => $file->qty,
                    'sendprivew' => '0',
                    'tax'=>$tax,
                    'total_price' =>($file->price * $file->qty) + $tax,
                ]);
               }
                // $data = new SalesOrder;
                // //=========================================================
                // $data->user_id = $request->user_id;
                // $data->customer_id = $request->customer_id;
                // $data->product_id = $file->product_id;
                // $data->price = $file->price;
                // $data->serial_number = $file->serial_number;
                // $data->order_status = 'Waitlist';
                // $data->qty = $file->qty;
                // $data->tax = ($file->price * $file->qty) * 23 / 100;
                // $data->total_price = ($file->price * $file->qty) + $data->tax;
                // $data->message = $request->message;
                // $data->date = date('Y-m-d');
                // $data->save();
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
                'success_message'=>'Sales order created successfully.',
                'data' => $result,
            ),200);
        }
		 
			 catch (\Exception $e) {
        dd($e->getMessage());die;
    }
    }
        /*13 march Send Privew SalesOrder sale order*/
            public function sendprivieworder(Request $request)
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
        //    print_r($product1);
        //            die();
                    $product_existss = SalesOrder::where('user_id',$request->user_id)
                    ->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)
                       ->first();
//                        print_r($product_existss);
// die();
                       if (empty($product_existss)) {
                        $data = new SalesOrder;
                        //=========================================================
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
                        $data->message = $request->message;
                        $data->date = date('Y-m-d');
                        $data->save();
                        
                       }
                       
                       else{
                        $tax = ($file->price * $file->qty) * 23 / 100;
                        DB::table('sales_orders')->where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->update([
                            'price' => $file->price,
                            'qty' => $file->qty,
                            'currency' => $file->currency,
                            'tax'=>$tax,
                            'sendprivew' => '1',
                            'total_price' =>($file->price * $file->qty) + $tax,
                        ]);
                       }

                    }
                    }
                   $data = SalesOrder::where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->where('sendprivew',1)->get();
                   
                   
                   $contracts = Contract::where('quote_id',$data[0]->quote_id)->get();
                   $producthireinfo = DB::table('hire_info')->where('quote_id',$data[0]->quote_id)->where('product_id',$data[0]->product_id)->get();
// print_r($producthireinfo);
// die();
                    $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $chrRepeatMin = 1; // Minimum times to repeat the seed string
                    $chrRepeatMax = 10; // Maximum times to repeat the seed string
                    $chrRandomLength = 10;
                    $pdfname= substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))), 1, $chrRandomLength);
                    $user = User::where('id',$request->user_id)->first();
                    $customer = Customer::where('id',$request->customer_id)->first();      
                    $filepdf = "order_$pdfname.pdf";
                    // $data->pdf_url = $filepdf;
                     $result = array(
                        'products'=>$product1,
                        'customer' => $customer,
                        'quote' => $data,
                        'contracts' => $contracts,
                        'producthireinfo' => $producthireinfo,
                        'user_email' => $user->email,
                        'users' => $user,
                    );
                   
                    $pdf = PDF::loadView('admin.sales_order.salesorder',  $result);
                    Storage::disk('uploads')->put('order_' . $pdfname . '.pdf', $pdf->output());
                   
                    DB::table('sales_orders')->where('user_id',$request->user_id)->where('customer_id',$request->customer_id)->where('product_id',$file->product_id)->update([
                        'pdf_url' => $filepdf,
                    ]);
                    return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Sales order created successfully.',
                        'data' => $result,
                    ),200);
                }
                 
                     catch (\Exception $e) {
                dd($e->getMessage());die;
            }
            }
  /*Privew Refresh Privew Quote */  

    public function refreshPrivewOrder(Request $request)
    {
       $validator = Validator::make($request->all(), [
           'sales_orders_id' => 'required',
       ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {

            DB::table('sales_orders')->where('id',$request->sales_orders_id)->update([
                'sendprivew' => '0',
            ]);
         
                     
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Remove preview Data.',
                                        ),200);
            }
        }
		    /*13 march privewSalesOrder  SalesOrder sale order*/
            public function privewSalesOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sales_orders_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }
        else {
            $sales_order = DB::table('sales_orders')->where('id',$request->sales_orders_id)->where('sendprivew',1)->first();
                        if($sales_order->quote_id == 0) {
                            $sales = SalesOrder::join('products','sales_orders.product_id','=','products.id')
                            ->leftjoin('customers','sales_orders.customer_id','=','customers.id')
                            ->leftjoin('dealers','products.dealer_id','=','dealers.id')
                            ->leftjoin('quotes','sales_orders.quote_id','=','quotes.id')
                            ->leftjoin('product_extra_info','sales_orders.id','=','product_extra_info.sales_orders_id')
                            ->leftjoin('trade_ins','sales_orders.id','=','trade_ins.sales_orders_id','sales_orders.product_id','=','product_extra_info.old_product_id')
                            //->leftjoin('users','users.id','=','sales_orders.user_id')
                            ->leftjoin('users','sales_orders.user_id','=','users.id')
                           ->select('sales_orders.*',
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
                           'product_extra_info.depot as depot',
                           'product_extra_info.hitch as hitch',
                           'product_extra_info.buckets as buckets',
                           'product_extra_info.extra as extra',
                           'product_extra_info.loader as loader',
                           'product_extra_info.warranty as warranty',
                           'product_extra_info.cabtype as cabtype',
                           'product_extra_info.tyres as tyres',
                           'product_extra_info.accessories as accessories',
                           'trade_ins.make as make',
                           'trade_ins.model as trademodel',
                           'trade_ins.year as year',
                           'trade_ins.hours as hours',
                           'trade_ins.price as tradeprice'
                                   )
                            ->where('sales_orders.id',$request->sales_orders_id)
                            ->where('sendprivew',1)
                            ->first();
                        }
                        else{
                            $sales = SalesOrder::join('products','sales_orders.product_id','=','products.id')
                        ->leftjoin('customers','sales_orders.customer_id','=','customers.id')
                        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
                        ->leftjoin('quotes','sales_orders.quote_id','=','quotes.id')
                       ->leftjoin('product_extra_info', function($q) {
                        $q->on('sales_orders.quote_id','=','product_extra_info.quote_id')
                           ->on('sales_orders.product_id','=','product_extra_info.product_id'); //second join condition
                    }) 

                    ->leftjoin('trade_ins', function($q) {
                        $q->on('sales_orders.quote_id','=','trade_ins.quote_id')
                           ->on('sales_orders.product_id','=','trade_ins.old_product_id'); //second join condition
                    }) 

                      // ->leftjoin('trade_ins','sales_orders.quote_id','=','trade_ins.quote_id','sales_orders.product_id','=','product_extra_info.old_product_id')
                       ->leftjoin('leads','leads.id','=','quotes.lead_id')
                       // ->leftjoin('users','users.id','=','sales_orders.user_id')
                       ->leftjoin('users','sales_orders.user_id','=','users.id')
                       ->select('sales_orders.*',
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
                       'product_extra_info.depot as depot',
                       'product_extra_info.hitch as hitch',
                       'product_extra_info.buckets as buckets',
                       'product_extra_info.extra as extra',
                       'product_extra_info.loader as loader',
                       'product_extra_info.warranty as warranty',
                       'product_extra_info.cabtype as cabtype',
                       'product_extra_info.tyres as tyres',
                       'product_extra_info.accessories as accessories',
                       'trade_ins.make as make',
                       'trade_ins.model as trademodel',
                       'trade_ins.year as year',
                       'trade_ins.hours as hours',
                       'trade_ins.price as tradeprice'
                       
                               )
                        ->where('sales_orders.id',$request->sales_orders_id)
                        ->where('sendprivew',1)
                        ->first();
                        }       
        $data = [];
        $data[] = [
                'id' => $request->sales_orders_id,
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
                'depot' => $sales->depot,
                'hitch' => $sales->hitch,
                'buckets' => $sales->buckets,
                'extra' => $sales->extra,
                'loader' => $sales->loader,
                'warranty' => $sales->warranty,
                'cabtype' => $sales->cabtype,
                'tyres' => $sales->tyres,
                'accessories' => $sales->accessories,
                'make' => $sales->make,
                'trademodel' => $sales->trademodel,
                'year' => $sales->year,
                'hours' => $sales->hours,
                'tradeprice' => $sales->tradeprice,

            ];
        
        
        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'product_image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'quote_attachment_path' => url('/public/admin/clip-one/assets/quotes/'),
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
		    /*filterSalesOrder sale order*/

   public function filterSalesOrder(Request $request)
    {
       $query = SalesOrder::join('products','sales_orders.product_id','=','products.id')
                        ->leftjoin('customers','sales_orders.customer_id','=','customers.id')
                        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
                        ->leftjoin('quotes','sales_orders.quote_id','=','quotes.id')
                        ->leftjoin('leads','leads.id','=','quotes.lead_id')
                                               ->leftjoin('users','users.id','=','sales_orders.user_id');

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
            $query = $query->where('sales_orders.date',$date);
        }
        if (!empty($request->customers)) {
            $customer = $request->customers;
            $query = $query->where('customers.name','LIKE','%'.$customer.'%');
        }
		if (!empty($request->make)) {
			$make = $request->make;
			$query = $query->where('dealers.name','LIKE','%'.$make.'%');
        }

        $data = $query->select('sales_orders.*','products.title as product_title','products.model as model','products.attachment as attachment','products.type as product_type',
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
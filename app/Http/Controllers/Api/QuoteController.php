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
use App\Models\User;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\SalesOrder;
use App\Models\Product;
use App\Models\ExtraProductInfo;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\Customer;
use App\Models\TradeIn;
use App\Helpers\AdminHelper;
use DateTime;
use Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Response;

class QuoteController extends Controller
{
    /*Create New Quote with old lead*/
    public function createQuoteWithExistingLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'product_id' => 'required',
            //'quantity' => 'required',
           // 'lead_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
            $lead = Lead::where('id',$request->lead_id)->first();
            $data = new Quote;
            //=========================================================
            $data->lead_id = $request->lead_id;
            $data->price = $request->price;
            $data->customer_id = $request->customer_id;
            $data->date = date('Y-m-d');

            $newLead = new Lead;
            $newLead->title = $request->title;
            $newLead->customer_id = $request->customer_id;
            $newLead->email = $request->email;
            $newLead->name = $request->name;
            $newLead->phone = $request->phone;
            $newLead->address = $request->address;
            $newLead->date = date('Y-m-d');
            $newLead->status = 'In Progress';
            $newLead->message = $request->message;
            $newLead->user_id = $request->user_id;
            $newLead->save();

            if ($data->save()) {
                $newQtProduct = new QuoteProduct;
                
                $newQtProduct->quote_id = $data->id;
                $newQtProduct->product_id = $request->product_id;
                $newQtProduct->price = $request->price;
                $newQtProduct->quantity = $request->quantity;
                $newQtProduct->total_price = $request->quantity * $request->price;
                
                $newQtProduct->save();
            
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Quote created successfully.',
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

    /*Create New Quote with new lead*/
    public function createQuoteWithNewLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
         
            $lead_exist = Lead::where('user_id',$request->user_id)
            ->where('customer_id',$request->customer_id)
            ->first();
            if (empty($lead_exist)) {
                $newLead = new Lead;
                $newLead->title = $request->title;
                $newLead->customer_id = $request->customer_id;
                $newLead->email = $request->email;
                $newLead->name = $request->name;
                $newLead->phone = $request->phone;
                $newLead->address = $request->address;
                $newLead->date = date('Y-m-d');
                $newLead->status = 'In Progress';
                $newLead->message = $request->message;
                $newLead->user_id = $request->user_id;
                $newLead->save();
            }
            
            if (empty($lead_exist)) {
                $data = new Quote;
                $data->lead_id = $newLead->id;
                $data->customer_id = $request->customer_id;
                $data->date = date('Y-m-d');
                $data->status = 'Sales';
                $data->save();
                if ($data->save()) {

                    $product = $request->product_id;
                    $product1 = json_decode($product);
                    foreach ($product1 as $file) {
                        $total_price = $file->quantity * $file->price;

                        DB::table('quote_products')->insert([
                            'quote_id' => $data->id,
                            'product_id' => $file->product_id,
                            'price' => $file->price,
                            'machine_price' => $file->price,
                            'quantity' => $file->quantity,
                            'status' => 'Sales',
                            'total_price' => $total_price
                        ]);

                        $price1 = QuoteProduct::where('quote_id', $data->id)->sum('total_price');
                        DB::table('quotes')->where('id', $data->id)->update([
                            'price' => $price1
                        ]);
                    }
                    return response()->json(array(
                        'status' => 200,
                        'message' => 'Success',
                        'success_message' => 'Quote created successfully1.',
                        'data' => $data,
                    ), 200);
                }
            }
            else{

                $quote_id = Quote::where('lead_id',$lead_exist->id)
                ->where('customer_id',$request->customer_id)
                ->first();
                 if (empty($quote_id)) {
                      
                    $data = new Quote;
                    $data->lead_id = $lead_exist->id;
                    $data->customer_id = $request->customer_id;
                    $data->date = date('Y-m-d');
                    $data->status = 'Sales';
                    $data->save();
                    if ($data->save()) {
    
                        $product = $request->product_id;
                        $product1 = json_decode($product);
                        foreach ($product1 as $file) {
                            $total_price = $file->quantity * $file->price;
    
                            DB::table('quote_products')->insert([
                                'quote_id' => $data->id,
                                'product_id' => $file->product_id,
                                'price' => $file->price,
                                'machine_price' => $file->price,
                                'quantity' => $file->quantity,
                                'status' => 'Sales',
                                'total_price' => $total_price
                            ]);
    
                            $price1 = QuoteProduct::where('quote_id', $data->id)->sum('total_price');
                         
                            DB::table('quotes')->where('id', $data->id)->update([
                                'status' => 'Sales',
                                'price' => $price1
                            ]);
                        }
                       
                            DB::table('leads')->where('id', $lead_exist->id)->update([
                                'status' => 'In Progress',
                                'date' => date('Y-m-d')
                            ]);
                        return response()->json(array(
                            'status' => 200,
                            'message' => 'Success',
                            'success_message' => 'Quote Update successfully2.',
                            'data' => $data,
                        ), 200);
                    }
                   
                }
                $product = $request->product_id;
                $product1 = json_decode($product);
                foreach ($product1 as $file) {
                    $total_price = $file->quantity * $file->price;
                    
                     $product_existss = QuoteProduct::where('quote_id',$quote_id->id)
                    ->where('product_id',$file->product_id)
                   ->first();
                   
                   if (empty($product_existss)) {
                    DB::table('quote_products')->insert([
                        'quote_id' => $quote_id->id,
                        'product_id' => $file->product_id,
                        'price' => $file->price,
                        'machine_price' => $file->price,
                        'quantity' => $file->quantity,
                        'sent'=> 0,
                        'status' => 'Sales',
                        'total_price' => $total_price
                    ]);
                   }
                   else{

                    DB::table('quote_products')->where('quote_id', $quote_id->id)->where('product_id',$file->product_id)->update([
                        'price' => $file->price,
                        'sent'=> 0,
                        'quantity' => $file->quantity,
                        'status' => 'Sales',
                        'total_price' => $total_price
                      
                    ]);
                   }
                
                    $price1 = QuoteProduct::where('quote_id', $quote_id->id)->sum('total_price');
                    
                    DB::table('quotes')->where('id', $quote_id->id)->update([
                        'price' => $price1,
                        'sent_on' => date('Y-m-d'),
                        'status' => 'Sales',
                        'date' => date('Y-m-d')
                        
                    ]);
                     DB::table('leads')->where('id', $lead_exist->id)->update([
                        'status' => 'In Progress',
                        'date' => date('Y-m-d')
                    ]);
                }
                $data= array('lead_id'=>$lead_exist->id,
                             'id'=>$quote_id->id,
                             'customer_id'=>$request->customer_id,
                             'status'=>$quote_id->status,
                             'date'=>date('Y-m-d'));
        
                return response()->json(array(
                    'status' => 200,
                    'message' => 'Success',
                    'success_message' => 'Quote created successfully3.',
                    'data' => $data,
                ), 200);
            } 
        }
        // else end
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>'Something went wrong!'
                                    ),200);
        
    }
	   /*Add To Customer*/

    public function saveCustomers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
			'email' => 'required|unique:customers,email',
			'phone' => 'required|unique:customers,phone',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {

            $data = new Customer;
		        //=========================================================
		        $data->name = $request->name;
		        $data->vat_number = $request->vat_number;
		        $data->email = $request->email;
		        $data->phone = $request->phone;
		        $data->address = $request->address;
			    $data->company = $request->company;
		       
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

	
	/*Add To Dealers*/


public function saveDealers(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'image' => 'required',
        'image.*' => 'mimes:jpeg,jpg,png,gif',
    ]);
    if ($validator->fails()) { 
        return response()->json(array(
                                    'status' => 400,
                                    'message'=> 'Error',
                                    'error_message'=>$validator->errors()
                                ),200);
    } else {

        $data = new Dealer;
        //===========================================
        $image = $request->file('image');
        if(!empty($image)) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/admin/clip-one/assets/dealers/thumbnail');
            
            $img = Image::make($image->getRealPath());

            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$imagename);

            $destinationPath = public_path('/admin/clip-one/assets/dealers/original');
            $image->move($destinationPath, $imagename);

            $source_url = public_path().'/admin/clip-one/assets/dealers/original/'.$imagename;
            $destination_url = public_path().'/admin/clip-one/assets/dealers/original/'.$imagename;
            $quality = 40;

            AdminHelper::compress_image($source_url, $destination_url, $quality);

        } else {
            $imagename = '';
        }
        //===========================================
        $video_file = $request->file('video_file');
        //dd($product); die;
        if(!empty($video_file)) {
            $video_file_name = rand('1111','9999').'_'.time().'.'.$video_file->getClientOriginalExtension();

            $destinationPath = public_path('/admin/clip-one/assets/dealers/video_file');
            $video_file->move($destinationPath, $video_file_name);
        } else {
            $video_file_name = '';
        }
        //=========================================================
        if(!empty($request->video_url)) {
            $video_url = $request->video_url;
        } else {
            $video_url = '';
        }
        //=========================================================
        $data->name = $request->name;
        $data->image = $imagename;
        $data->type = $request->type;
        $data->video_url = $video_url;
        $data->video_file = $video_file_name;
        $data->save();
        $id= $data->id;
        

        DB::table('dealers')->where('id',$id)->update([
            'order_no'=>$id

        ]);

            // $product_image = new ProductImage;
            // $product_image->product_id = $data->id;
            // $product_image->image = $imagename;
            // $product_image->save();

            return response()->json(array(
                'status' => 200,
                'message'=> 'Success',
                'success_message'=>'Dealer uploaded successfuly.',
                'image_path' => url('/public/admin/clip-one/assets/dealers/thumbnail/'),
                //'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                'data' => $data,
            ),200);

        // if ($data->save()) {
         
        //     return response()->json(array(
        //                                 'status' => 200,
        //                                 'message'=> 'Success',
        //                                 'success_message'=>'Customer created successfully.',
        //                                 'data' => $data,
        //                             ),200);
        // }else{
        //     return response()->json(array(
        //                                 'status' => 400,
        //                                 'message'=> 'Error',
        //                                 'error_message'=>'Something went wrong!'
        //                             ),200);
        // }
    }
}

    /*Add To Quote*/
    public function addToQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
            $product_array = json_decode($request->product_id);
            $quantity_array = json_decode($request->quantity);

            foreach ($product_array as $key => $value) {
                $checkProductExist = QuoteProduct::where('quote_id',$request->quote_id)
                                        ->where('product_id',$value)
                                        ->first();
                $product1 = Product::where('id',$value)->first();

                if (!empty($checkProductExist)) {
                    $data->quote_id = $request->quote_id;
                    $data->price = $product1->price;
                    $data->total_price = $quantity_array[$key] * $product1->price;
                    $data->save();
                }else{
                    $data = new QuoteProduct;
                    $data->product_id = $value;
                    $data->price = $product1->price;
                    $data->save();
                }
            }
            $price = QuoteProduct::where('quote_id',$request->quote_id)->sum('total_price');

            $quote = Quote::find($request->quote_id);
            $quote->price = $price;
            if ($quote->save()) {
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Added to quote successfully.',
                                            'data' => $quote,
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

    /*Quote List of Users*/
    public function userQuotes(Request $request)
    {
        if (!empty($request->search)) {

            $query = Quote::join('leads','quotes.lead_id','=','leads.id');

            if (!empty($request->search)) {
                $search = $request->search;
                $query = $query->where('leads.name','LIKE','%'.$search.'%');
            }
                        
            $quotes = $query->select('quotes.*','leads.name','leads.email','leads.phone','leads.user_id','leads.date','leads.status')
                        ->orderBy('quotes.id','DESC')
                        ->get();
        }else{
            $quotes = Quote::join('leads','quotes.lead_id','=','leads.id')
                        ->select('quotes.*','leads.name','leads.email','leads.phone','leads.user_id','leads.date','leads.status')
                        ->orderBy('quotes.id','DESC')
                        ->get();
        }
        
        $data = [];
        foreach($quotes as $quote){
            $checkSalesOrder = SalesOrder::where('quote_id',$quote->id)->first();

            if (empty($checkSalesOrder)) {
                $data[] = [
                    'id' => $quote->id,
                    //'products' => $this->getProducts($quote->product_id),
                    'lead_id' => $quote->lead_id,
                    'attachment' => $quote->attachment,
                    'price' => $quote->price,
                    'user_id' => $quote->user_id,
                    'lead_date' => $quote->date,
                    'lead_status' => $quote->status,
                    'sent' => $quote->sent,
                    'sent_on' => $quote->sent_on,
                ];
            }
        }

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
    
    public function getProducts($id)
    {
        $products = QuoteProduct::where('quote_id',$id)->where('sendprivew',1)->where('status','Sales')->get();
        
        $data = [];
        foreach($products as $key => $product){
            $product_data = Product::join('product_images','products.id','=','product_images.product_id')
                                ->where('products.id',$product->product_id)
                                ->select('products.id as product_id','products.category_id','products.dealer_id','products.title','products.price as product_price','products.type',
                                'products.status as product_status','product_images.image','products.attachment as product_attachment','products.description as description')
                                ->first();

            $data[] = [
                'title' => $product_data->title,
                'product_price' => $product->price,
                 'product_currency' => $product->currency,
                'quantity' => $product->quantity,
                'total_price' => $product->total_price,
                'product_attachment' => $product_data->product_attachment,
                 'productextrainfo' => $this->getExtra($product->product_id,$id),
                'tradein' => $this->getTradeIn($product->product_id,$id),
                'description' => strip_tags($product_data->description)
            ];
        }
        
        return $data;
    }
     /*Tradein Details*/
  public function getTradeIn($product_id,$quote_id)
    {
        $products = TradeIn::where('old_product_id',$product_id)->where('quote_id',$quote_id)->get();
        $data = [];
        foreach($products as $key => $product){
            $productData = DB::table('trade_ins')->where('old_product_id',$product->old_product_id)->where('quote_id',$quote_id)->first();
              $data[] = [
                'make' => $productData->make,
                'model' => $productData->model,
                'year' => $productData->year,
                'hours' => $productData->hours,
                'price' => $productData->price,
              ]; 
        }
        
        return $data;
    }
     /*Extrainfo Details*/
         public function getExtra($product_id,$quote_id)
          {
              $products = ExtraProductInfo::where('product_id',$product_id)->where('quote_id',$quote_id)->get();
              $data = [];
              foreach($products as $key => $product){
                $productExtraData = DB::table('product_extra_info')->where('product_id',$product->product_id)->where('quote_id',$quote_id)->first();
                  $data[] = [
                     'Hitch' => $productExtraData->hitch,
                     'buckets' => $productExtraData->buckets,
                     'extra' => $productExtraData->extra,
                     'depot' => $productExtraData->depot,
                  ];
              }
              
              return $data;
          }
    /*Quote Details*/
    public function quoteDetails(Request $request)
    {
        $quote = Quote::join('leads','quotes.lead_id','=','leads.id')
                        ->select('quotes.*','leads.name','leads.email','leads.phone','leads.address','leads.user_id','leads.date','leads.status')
                        ->where('quotes.id',$request->quote_id)
                        ->first();
        
        $data = [];
        $data[] = [
                'id' => $quote->id,
                'products' => $this->getProducts($quote->id),
                'lead_id' => $quote->lead_id,
                'attachment' => $quote->attachment,
                'price' => $quote->price,
                'lead_name' => $quote->name,
                'lead_email' => $quote->email,
                'lead_phone' => $quote->phone,
                'lead_address' => $quote->address,
                'user_id' => $quote->user_id,
                'lead_date' => $quote->date,
                'lead_status' => $quote->status,
                'sent' => $quote->sent,
                'sent_on' => $quote->sent_on,
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

    /*Upload Quote attachment*/
    public function editQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
            'quote_product_id' => 'required',
            'product_price' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
            $data = Quote::find($request->quote_id);
            //=========================================================
            $attachment = $request->file('attachment');

            if(!empty($attachment)) {
                $attachment_name = $attachment->getClientOriginalName();
                $attach_name = str_replace(' ', '',$attachment_name);

                $destinationPath = public_path('/admin/clip-one/assets/quotes');
                $attachment->move($destinationPath, $attach_name);
            } else {
                $attach_name = $data->attachment;
            }
            $data->attachment = $attach_name;

            $product_price_array = json_decode($request->product_price);

            foreach ($product_array as $key => $value) {
                $quote_product->price = $product_price_array[$key];
                $quote_product->quantity = $quantity_array[$key];
                $quote_product->save();
            }
            $final_price = QuoteProduct::where('quote_id',$request->quote_id)->sum('total_price');

            $data->price = $final_price;
            
            if(!empty($attach_name) && $attach_name != ''){
                $pathToFile = url('/public/admin/clip-one/assets/quotes').'/'.$attach_name;
            }else{
                $pathToFile = '';
            }

            if ($data->save()) {
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Quote updated successfully.',
                                            'pathToFile'=>$pathToFile,
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

   /*Privew quote send Quotes   this are submite form */  

    public function sendPrivewQuote(Request $request)
    {
		$quote_products = json_decode($request->data);
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
			
            $data = Quote::find($request->quote_id);
           
			$total_price=0;
			
            foreach($quote_products as $key=>$quote_product)
            {

                if (empty($quote_product->product_total_price)) {
                    $price = $quote_product->price;
                } else {
                    $price = $quote_product->product_total_price;
                }
				  DB::table('quote_products')->where('quote_id', $request->quote_id)
					  ->where('product_id',$quote_product->product_id)
                	  ->update(array(
                   		'price'=>$price,
                   		'currency'=>$quote_product->currency,
                        'total_price'=> $price,
                        'sendprivew' => 1,
                        'machine_price'=>$quote_product->machine_price,
                   		)); 
				$total_price+=$price;
			}
			//$data->sent = '0';
			$data->price = $total_price;
			 $data->currency = $quote_product->currency;
            $data->sent_on = date('Y-m-d');
			
            if(!empty($data->attachment)){
                $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
            }else{
                $pathToFile = '';
            }

            $lead = Lead::where('id',$data->lead_id)->first();
            $user = User::where('id',$lead->user_id)->first();
            $customer = Customer::where('id',$data->customer_id)->first();
            $products = QuoteProduct::where('quote_id',$request->quote_id)->where('sendprivew',1)->get();
// print_r($user->email);
// die();
            if (!empty($data)) {
                $leadData = Lead::find($data->lead_id);
                $emailData = array(
                    //'email' => $leadData->email,
                    'title' => 'Screenpod Quotation',
                    'pathToFile' => $pathToFile,
                    'quote' => $data,
                    'customer' => $customer,
                    'products' => $products,
                    'user_email' => $user->email,
                    'users' => $user,
                );
                
               
                 $file = "quote_$request->quote_id.pdf";
                $data->save();
                $pdf = PDF::loadView('admin.quotes.quotepdf', $emailData);
                Storage::disk('uploads')->put('quote_' . $request->quote_id . '.pdf', $pdf->output());

                DB::table('quotes')->where('id', $request->quote_id)
                    ->update(array(
                        'pdf_url' => $file,
                    )); 
                
                //$data->save();
		
				// DB::update('update leads set status = ? where id = ?', ["In Progress", $data->lead_id]);
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Quote sent successfully.',
                                            'pathToFile' => $pathToFile,
                                             'quotation' => $file,
                                            'data' => $data,
                                        ),200);
            }else{
                return response()->json(array(
                                            'status' => 400,
                                            'message'=> 'Error',
                                            'error_message'=>'Something went wrong!!'
                                        ),200);
            }
        }
		
    }






//filter privew send quote screen//

    public function filterPrivewSentQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
 
		 $data = Quote::select('quotes.*', 'customers.name as name', 'customers.email as customer_email',
        'categories.name as category_name', 'quotes.id as quotes_id',
        'dealers.name as dealer_name','products.dealer_id as dealer_id',
        'products.title','products.id as product_id','quote_products.total_price as product_total_price','quote_products.quantity as quantity',
		'products.model','products.year as product_year',
        'dealers.name as dealer_name','leads.name as lead_name','leads.email as lead_email',
        'leads.phone','leads.user_id','leads.date as lead_date','leads.status','trade_ins.make as make', 'trade_ins.model as trade_model','trade_ins.year as year',
        'trade_ins.hours as hours','trade_images.image as trade_image', 'product_extra_info.depot as depot',
        'product_extra_info.hitch as hitch','product_extra_info.buckets as buckets')
			 
        ->leftjoin('quote_products','quote_products.quote_id','=','quotes.id')
        ->leftjoin('products','products.id','=','quote_products.product_id')
        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->leftjoin('customers','quotes.customer_id','=','customers.id')  
        ->leftjoin('leads','leads.id','=','quotes.lead_id')  
		->leftJoin("trade_ins", "trade_ins.quote_id", "=", "quotes.id")
	    ->leftJoin("trade_images", "trade_images.id", "=", "trade_images.trade_id")
        ->leftJoin("product_extra_info", "product_extra_info.quote_id", "=", "quotes.id")
        ->groupBy('quote_products.product_id')
	    ->where('leads.user_id',$request->user_id)
	    ->where('leads.customer_id',$request->customer_id)
        ->where('quotes.sent','1')
        ->where('quotes.status','Sales')

        ->get();
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $data,
                                    ),200);
                                    
                                        
    }


    /*Email Quotes   this are submite form */  
    public function sendQuote(Request $request)
    {
		//return(json_decode($request->data)); 
		$quote_products = json_decode($request->data);
		//return $array;
		//die;

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
			
            $data = Quote::find($request->quote_id);
        //    print_r($data);
        //    die();
			$total_price=0;
            foreach($quote_products as $key=>$quote_product)
// 			{
// 					//return $quote_product->product_id; die;
// 				  DB::table('quote_products')->where('quote_id', $request->quote_id)
// 					  						->where('product_id',$quote_product->product_id)
//                 							 ->update(array(
//                   							 'price'=>$quote_product->price,'total_price'=> $quote_product->price)); 
// 				$total_price+=$quote_product->price;
// 			}

	{

                if (empty($quote_product->product_total_price)) {
                    $price = $quote_product->price;
                } else {
                    $price = $quote_product->product_total_price;
                }


					//return $quote_product->product_id; die;
				  DB::table('quote_products')->where('quote_id', $request->quote_id)
					  ->where('product_id',$quote_product->product_id)
                	  ->update(array(
                   		'price'=>$price,'total_price'=> $price,
                        'machine_price'=>$quote_product->machine_price,
                        'currency'=>$quote_product->currency,
                   		'sent'=> 1, 
                   		)); 
				$total_price+=$price;
			}
			
			 $data->sent = '1';
			$data->price = $total_price;
			$data->currency = $quote_product->currency;
            $data->sent_on = date('Y-m-d');
			
            if(!empty($data->attachment)){
                $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
            }else{
                $pathToFile = '';
            }

            $lead = Lead::where('id',$data->lead_id)->first();
            $user = User::where('id',$lead->user_id)->first();
            $customer = Customer::where('id',$data->customer_id)->first();
           // $products = QuoteProduct::where('quote_id',$request->quote_id)->get();
            $products = DB::table('quote_products')->where('quote_id',$request->quote_id)->where('sent',1)->get();


// 			$idexist = DB::select('select * from product_extra_info where quote_id = ? ', [$request->quote_id]);

//             if (empty($idexist)) {
//                 $info = new ExtraProductInfo;
//                 $info->quote_id = $request->quote_id;
//                 $info->product_id = $request->product_id;
//                 $info->user_id = $request->user_id;
//                 $info->depot = $request->quote_depot;
//                 $info->hitch = $request->quote_hitch;
//                 $info->buckets = $request->quote_bucket;
//                 $info->extra = $request->quote_extra;
//                 $info->save();
//             } else {
//                 DB::table('product_extra_info')->where('quote_id', $request->quote_id)
//                 ->update(array(
//                     'depot' =>  $request->quote_depot,
//                     'hitch' => $request->quote_hitch,
//                     'buckets' => $request->quote_bucket,
//                     'extra' => $request->quote_extra
//                 ));  
//             }

			
            if (!empty($data)) {
                $leadData = Lead::find($data->lead_id);
                $emailData = array(
                    //'email' => $leadData->email,
                    'title' => 'Screenpod Quotation',
                    'pathToFile' => $pathToFile,
                    'quote' => $data,
                    'customer' => $customer,
                    'products' => $products,
                    'user_email' => $user->email,
                    'users' => $user,
                );
                
                if(!empty($data->attachment)){
                    Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                        $message->from('lalit@dmcconsultancy.com', 'Screenpod  Quotation');
                        $message->to($emailData['user_email']);
                        $message->cc(['lalit@dmcconsultancy.com']);
                        $message->subject('Screenpod  Quotation');
                        $message->attach($emailData['pathToFile']);
                    });   
                }else{
                    Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                        $message->from('lalit@dmcconsultancy.com', 'Screenpod  Quotation');
                        $message->to($emailData['user_email']);
                        $message->cc(['lalit@dmcconsultancy.com']);
                        $message->subject('Screenpod Quotation');
                    });
                }
                
                 $file = "quote_$request->quote_id.pdf";
   // print_r($file);die();
   $data->save();
                //  DB::table('quote_pdf')->insert([
                //     'quote_id'=>$request->quote_id,
                //     'attachment_url'=>$file
                //  ]);
		$pdf = PDF::loadView('admin.quotes.quotepdf', $emailData);
        Storage::disk('uploads')->put('quote_' . $request->quote_id . '.pdf', $pdf->output());

 DB::table('quotes')->where('id', $request->quote_id)
                 ->update(array(
                    'pdf_url'=>$file,                   
                 )); 
				
				//print_r($data->lead_id);
				//die();
				
				$sendproduct = DB::select('select * from quote_products where quote_id=? and sent=?', [$request->quote_id, 0]);
				
				if(empty($sendproduct)) {
				    DB::update('update leads set status = ? where id = ?', ["Quote Sent", $data->lead_id]);
				}
				 





                // if( count(Mail::failures()) > 0 ) {
                //     echo "There was one or more failures. They were: <br />";
                //     foreach(Mail::failures() as $email_address) {
                //       echo " - $email_address <br />";
                //     }die;
                // } else {
                //     Log::info('Working');
                //     echo "No errors, all sent successfully!";
                //     die;
                // }

                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Quote sent successfully.',
                                            'pathToFile' => $pathToFile,
                                             'quotation' => $file,
                                            'data' => $data,
                                        ),200);
            }else{
                return response()->json(array(
                                            'status' => 400,
                                            'message'=> 'Error',
                                            'error_message'=>'Something went wrong!!'
                                        ),200);
            }
        }
		
    }
    
    /*Download quote attachment*/
    public function downloadAttachment(Request $request)
    {
        $product = Product::find($request->product_id);
        $attachment = $product->attachment;
        $file = public_path().'/admin/clip-one/assets/products/attachment/'.$product->attachment;
        $headers = array('Content-Type: *');
        
        return Response::download($file, $attachment, $headers); 
    }

    /*Remove product from quote*/
    public function removeProductFromQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'quote_product_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } else {
            $product_array = json_decode($request->quote_product_id);

            $price = 0;
            foreach ($product_array as $key => $value) {
                ExtraProductInfo::where('quote_id',$request->id)->where('product_id',$quote_product->product_id)->delete();
                QuoteProduct::where('id',$value)->delete(); 
            }
            $final_price = QuoteProduct::where('quote_id',$request->id)->sum('total_price');

            $data->price = $final_price;

            if ($data->save()) {
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Product removed from quote.',
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

    /*Preview quote mail*/
  public function previewQuoteMail(Request $request)
    {
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
            $data = Quote::find($request->quote_id);
            $data->sent = '1';
            $data->sent_on = date('Y-m-d');
            if(!empty($data->attachment)){
                $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
            }else{
                $pathToFile = '';
            }
// print_r($data);die;
            $lead = Lead::where('id',$data->lead_id)->first();
            $user = User::where('id',$lead->user_id)->first();
            $customer = Customer::where('id',$data->customer_id)->first();
           // $products = QuoteProduct::where('quote_id',$request->quote_id)->get();
            $products = QuoteProduct::where('quote_id',$request->quote_id)->where('sendprivew',1)->get();

            if (!empty($data)) {
                $leadData = Lead::find($data->lead_id);
                 if(!empty($leadData->email)) {
                    $customer_myemail = $leadData->email;
                }
                else{
                    $customer_myemail = 'test@gmail.com';
                }
                $emailData = array(
                    'email' => $leadData->email,
                    'title' => 'Screenpod Quotation',
                    'pathToFile' => $pathToFile,
                    'quote' => $data,
                    'customer' => $customer,
                    'products' => $products,
                    'user_email' => $user->email,
                    'users' => $user,
                );

               
 if(!empty($data->attachment)){
                    Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                        $message->from('lalit@dmcconsultancy.com', 'Screenpod Prevew Quotation');
                        $message->to($emailData['user_email']);
                        $message->cc([$emailData['email'],'lalit@dmcconsultancy.com']);
                        $message->subject('Screenpod Email Quotation');
                        $message->attach($emailData['pathToFile']);
                    });   
                }else{
                    Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                        $message->from('lalit@dmcconsultancy.com');
                        $message->to($emailData['user_email']);
                        $message->cc([$emailData['email'],'lalit@dmcconsultancy.com']);
                        $message->subject('Screenpod Email Quotation');
                    });
                }





               
                // echo "<pre>";
                //  print_r($data);die;
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'email Quote sent successfully .',
                                            'pathToFile' => $pathToFile,
                                            'data' => $data,
                                        ),200);
            }else{
                return response()->json(array(
                                            'status' => 400,
                                            'message'=> 'Error',
                                            'error_message'=>'Something went wrong!!'
                                        ),200);
            }
        }
    }
   public function inProgressQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
    

        $data = Lead::select('customers.*','leads.title as lead_title','leads.name as lead_name','leads.id as lead_id','quotes.id as quotes_id','quotes.date as date')
        ->leftJoin("customers", "customers.id", "=", "leads.customer_id") 
	    ->leftJoin("quotes", "quotes.lead_id", "=", "leads.id")                           

        ->where('leads.user_id',$request->user_id)
        ->where('quotes.status','Sales')
        ->where('leads.status','In Progress')
        ->groupBy('leads.customer_id')
        ->get();
        //->first();

// print_r($data);
// die;

          return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get In Progress Quote.',
                                        'data' => $data,
                                    ),200);
    }
	
	public function sentQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
        
        
		 $data = Quote::select('quotes.*', 'customers.name as name', 'customers.email as customer_email',
        'categories.name as category_name',
        'dealers.name as dealer_name','products.dealer_id as dealer_id',
        'products.title','products.model','products.year as product_year',
        'dealers.name as dealer_name','leads.name as lead_name','leads.email as lead_email',
        'leads.phone','leads.user_id','leads.date as lead_date','leads.status',
        'leads.customer_id as customer_id','quotes.status as quote_status')
        ->leftjoin('quote_products','quote_products.quote_id','=','quotes.id')
        ->leftjoin('products','products.id','=','quote_products.product_id')
        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->leftjoin('customers','quotes.customer_id','=','customers.id')  
        ->leftjoin('leads','leads.id','=','quotes.lead_id')  
		->groupBy('leads.customer_id')
	    ->where('leads.user_id',$request->user_id)
        ->where('quotes.sent','1')
        ->where('quotes.status','Sales')
        ->get();
		
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $data,
                                    ),200);
                                    
                                        
    }
    public function filterSentQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
        
      //  $query = Quote::join('leads','quotes.lead_id','=','leads.id')
                       // ->join('quote_products','quote_products.quote_id','=','quotes.id')
                        //->join('products','products.id','=','quote_products.product_id')
                       // ->join('dealers','products.dealer_id','=','dealers.id')
                        //->join('categories','products.category_id','=','categories.id')
                        //->join('customers','quotes.customer_id','=','customers.id');                        
                        
       // $quotes = $query->select('quotes.*','quotes.id as quotes_id','customers.name as name','customers.email as customer_email','categories.name as category_name','dealers.name as dealer_name','products.dealer_id as dealer_id','products.title','products.model','products.year as product_year','products.hours as product_hours','products.weight as product_weight','products.price as product_price','dealers.name as dealer_name','leads.name','leads.email','leads.phone')
                    //    ->groupBy('leads.customer_id')
                      //  ->where('leads.user_id',$request->user_id)
                        //->where('leads.customer_id',$request->customer_id)
                        //->where('quotes.sent','1')
                        //->get();
		
		 $data = Quote::select('quotes.*', 'customers.name as name', 'customers.email as customer_email',
        'categories.name as category_name', 'quotes.id as quotes_id',
        'dealers.name as dealer_name','products.category_id as category_id','products.dealer_id as dealer_id','products.backorder_number as backorder_number','products.title','products.id as product_id','quote_products.total_price as product_total_price','quote_products.machine_price as machine_price','quote_products.currency as product_currency','quote_products.quantity as quantity',
		'products.model','products.year as product_year',
        'dealers.name as dealer_name','leads.name as lead_name','leads.email as lead_email',
        'leads.phone','leads.user_id','leads.date as lead_date','leads.status','trade_ins.make as make', 'trade_ins.model as trade_model','trade_ins.year as year',
        'trade_ins.hours as hours','trade_ins.price as trade_price','trade_images.image as trade_image', 'product_extra_info.depot as depot',
        'product_extra_info.hitch as hitch','product_extra_info.buckets as buckets')
			 
        ->leftjoin('quote_products','quote_products.quote_id','=','quotes.id')
        ->leftjoin('products','products.id','=','quote_products.product_id')
        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->leftjoin('customers','quotes.customer_id','=','customers.id')  
        ->leftjoin('leads','leads.id','=','quotes.lead_id')  
		//->leftJoin("trade_ins", "trade_ins.quote_id", "=", "quotes.id")
		->leftJoin("trade_ins", "trade_ins.old_product_id", "=", "quote_products.product_id")
	    ->leftJoin("trade_images", "trade_images.id", "=", "trade_images.trade_id")
        ->leftJoin("product_extra_info", "product_extra_info.quote_id", "=", "quotes.id")
        ->groupBy('quote_products.product_id')
	    ->where('leads.user_id',$request->user_id)
	    ->where('leads.customer_id',$request->customer_id)
        ->where('quotes.sent','1')
        ->where('quote_products.sent','1')
        ->get();
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $data,
                                    ),200);
                                    
                                        
    }
    public function searchSentQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'customer_id' => 'required',
            'search' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
        
        $query = Quote::join('leads','quotes.lead_id','=','leads.id')
                        ->join('quote_products','quote_products.quote_id','=','quotes.id')
                        ->join('products','products.id','=','quote_products.product_id')
                        ->join('categories','categories.id','=','products.category_id');

         if (!empty($request->search)) {
                $search = $request->search;
                $query = $query->where('products.model','LIKE','%'.$search.'%')->orWhere('categories.name','LIKE','%'.$search.'%');
            }
                        
        $query  =   $query->join('dealers','products.dealer_id','=','dealers.id')
                        ->join('customers','quotes.customer_id','=','customers.id');   

                        
        $quotes = $query->select('quotes.*','customers.name as customer_name','customers.email as customer_email','categories.name as category_name','dealers.name as dealer_name','products.dealer_id as dealer_id','products.title','products.model','products.year as product_year','products.hours as product_hours','products.weight as product_weight','products.price as product_price','dealers.name as dealer_name','leads.name','leads.email','leads.phone')
                        ->groupBy('leads.customer_id')
                        ->where('leads.user_id',$request->user_id)
                        ->where('leads.customer_id',$request->customer_id)
                        ->where('quotes.sent','1')
                        ->get();
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $quotes,
                                    ),200);
                                    
                                        
    }
    public function filterInProgressQuote(Request $request)
    {
		
		$validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 

        $data = Lead::select('customers.*','leads.title as lead_title','leads.name as lead_name','leads.id as lead_id',
         'quotes.lead_id as lead_idname', 'quote_products.quote_id as quotes_id','quotes.status as quotes_status','quote_products.id as quotes_productid','quote_products.currency as currency','quote_products.currency as product_currency','quote_products.created_at as product_date','quote_products.sendprivew as sendprivew','products.id as product_id','products.category_id as category_id','products.dealer_id as dealer_id','products.backorder_number as backorder_number', 'products.title as product','products.model as model','products.attachment as attachment','quote_products.quantity as quantity','quote_products.total_price as price','quote_products.machine_price as machine_price','trade_ins.make as make','trade_ins.price as trade_price')


        ->leftJoin("customers", "customers.id", "=", "leads.customer_id")  
        ->leftJoin("quotes", "quotes.lead_id", "=", "leads.id")                        
        ->leftJoin("quote_products", "quote_products.quote_id", "=", "quotes.id")                        
        ->leftJoin("products", "quote_products.product_id", "=", "products.id") 
		//->leftJoin("trade_ins", "trade_ins.id", "=", "trade_ins.quote_id")
				->leftJoin("trade_ins", "trade_ins.old_product_id", "=", "quote_products.product_id")
		->where('leads.user_id',$request->user_id)
        ->where('leads.customer_id',$request->customer_id)
        ->where('leads.status','In Progress')
        ->where('quote_products.sent','0')
        ->where('quote_products.status','Sales')
        ->groupBy('quote_products.product_id')
        ->get();
		
		
    //     $data = Lead::select('customers.*','leads.title as lead_title','leads.name as lead_name','leads.id as lead_id')
    //     ->leftJoin("customers", "customers.id", "=", "leads.customer_id")                        
    //     ->where('leads.customer_id',$request->customers_id)
    //     ->where('leads.status','In Progress')
    //    // ->where('customers.sent','1')
    //     //->groupBy('leads.customer_id')
    //     ->get();



        // $query = Quote::join('leads','quotes.lead_id','=','leads.id')
        //                 ->leftJoin('quote_products','quote_products.quote_id','=','quotes.id')
        //                 ->leftJoin('products','products.id','=','quote_products.product_id')
        //                 ->leftJoin('dealers','products.dealer_id','=','dealers.id')
        //                 ->leftJoin('categories','products.category_id','=','categories.id')
        //                 ->leftJoin('customers','quotes.customer_id','=','customers.id');                        
                        
        // $quotes = $query->select('quotes.*','customers.name as customer_name','customers.email as customer_email','categories.name as category_name','dealers.name as dealer_name','products.dealer_id as dealer_id','products.title','products.model','products.year as product_year','products.hours as product_hours','products.weight as product_weight','products.price as product_price','dealers.name as dealer_name','leads.name','leads.email','leads.phone')
        //                 ->groupBy('leads.customer_id')
        //                 ->where('leads.user_id',$request->user_id)
        //                 ->where('leads.customer_id',$request->customer_id)
        //                 ->where('quotes.sent','1')
        //                 ->get();
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $data,
                                    ),200);
                                    
                                        
    }
    public function searchInProgressQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'customer_id' => 'required',
            'search' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
         $query =  Quote::select('quotes.*','customers.name as customer_name','customers.email as customer_email','categories.name as category_name','dealers.name as dealer_name','products.dealer_id as dealer_id','products.title','products.model','products.year as product_year','products.hours as product_hours','products.weight as product_weight','products.price as product_price','dealers.name as dealer_name','leads.name','leads.email','leads.phone')
        -> leftjoin('leads','quotes.lead_id','=','leads.id')
        ->leftjoin('quote_products','quote_products.quote_id','=','quotes.id')
      ->leftjoin('products','products.id','=','quote_products.product_id')
      ->leftjoin('categories','categories.id','=','products.category_id')
      ->leftjoin('dealers','products.dealer_id','=','dealers.id')
      ->leftjoin('customers','quotes.customer_id','=','customers.id')
      ->groupBy('leads.customer_id')
      ->where('leads.user_id',$request->user_id)
      ->where('leads.customer_id',$request->customer_id)
      ->where('quotes.sent','1')
      ->get();
     
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $query,
                                    ),200);
                                    
                                        
    }
/* extrar product */
public function saveinfo(Request $request)
    {
        try {
                $validator = Validator::make($request->all(), [
                //'quote_id' => 'required',
                'product_id' => 'required',
                'user_id' => 'required',
               
				//'trade_image' =>  'required',
            ]);
            if ($validator->fails()) {
                return response()->json(array(
                    'status' => 400,
                    'message' => 'Error',
                    'error_message' => $validator->errors()
                ), 200);
            } else {
                 if ($request->quote_id == 0) {
                    
                    
				$idtrd = DB::table('product_extra_info')->where('sales_orders_id',$request->sales_orders_id)->where('product_id',$request->product_id)->first();

                $data= [];
                if (empty($idtrd)) {
                    $info = new ExtraProductInfo;
                    $info->sales_orders_id = $request->sales_orders_id;
                    $info->product_id = $request->product_id;
                    $info->user_id = $request->user_id;
                    $info->depot = $request->depot;
                    $info->hitch = $request->hitch;
                    $info->buckets = $request->buckets;
                    $info->extra = $request->extra;
                     $info->loader = $request->loader;
                    $info->warranty = $request->warranty;
                    $info->cabtype = $request->cabtype;
                    $info->tyres = $request->tyres;
                    $info->accessories = $request->accessories;
                    $info->save();
                   
                    return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'product_extra_info in Inserted successfully.',
                        'data' => $data,
                    ),200); 
                } 
                else {
                    DB::table('product_extra_info')->where('sales_orders_id', $request->sales_orders_id)->where('product_id', $request->product_id)
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
                    
                    return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'product_extra_info in Update successfully.',
                        'data' => $data,
                    ),200);
                }
                }
                else{
                    
                    $data = Quote::find($request->quote_id);
                  
                    $data->price = $request->price;
                   
                     DB::table('quotes')->where('id', $request->quote_id)
                     ->update(array(
                        'price'=>$request->price,                   
                     )); 

                     $idtrd = DB::table('product_extra_info')->where('quote_id',$request->quote_id)->where('product_id',$request->product_id)->first();

                $data= [];
                if (empty($idtrd)) {
                    $info = new ExtraProductInfo;
                    $info->quote_id = $request->quote_id;
                    $info->product_id = $request->product_id;
                    $info->user_id = $request->user_id;
                    $info->depot = $request->depot;
                    $info->hitch = $request->hitch;
                    $info->buckets = $request->buckets;
                    $info->extra = $request->extra;
                    $info->loader = $request->loader;
                    $info->warranty = $request->warranty;
                    $info->cabtype = $request->cabtype;
                    $info->tyres = $request->tyres;
                    $info->accessories = $request->accessories;
                    $info->save();
                    
                    return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'product_extra_info in Inserted successfully.',
                        'data' => $data,
                    ),200); 
                } 
                else {
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
                    
                    return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'product_extra_info in Update successfully.',
                        'data' => $data,
                    ),200);
                }
                }
            }  
        } 
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /*Privew*/

    public function prvquoteDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }
        else {
            $quote = Quote::join('leads','quotes.lead_id','=','leads.id')
                        ->leftJoin("customers", "customers.id", "=", "quotes.customer_id") 
                        ->leftJoin("users", "users.id", "=", "leads.user_id") 
                        ->select('quotes.*','leads.name','leads.email','leads.phone',
                        'leads.address','leads.user_id','leads.date','leads.status',
                        'users.name as user_name','users.email as user_email',
                        'users.mobile as user_mobile','customers.name as customer_name',
                        'customers.email as customer_email')
                        ->where('quotes.id',$request->quote_id)
                        ->first();
        
        $data = [];
        $data[] = [
                'id' => $quote->id,
                'products' => $this->getProducts($quote->id),
                'lead_id' => $quote->lead_id,
                'attachment' => $quote->attachment,
                'price' => $quote->price,
                'currency' => $quote->currency,
                'quotation' => $quote->pdf_url,
                'lead_name' => $quote->name,
                'lead_email' => $quote->email,
                'lead_phone' => $quote->phone,
                'lead_address' => $quote->address,
                 'user_id' => $quote->user_id,
                'user_name' => $quote->user_name,
                'user_mobile' => $quote->user_mobile,
                'user_email' => $quote->user_email,
                'customer_id' => $quote->customer_id,
                'customer_name' => $quote->customer_name,
                'customer_email' => $quote->customer_email,
                'lead_date' => $quote->date,
                'lead_status' => $quote->status,
                'sent' => $quote->sent,
                'sent_on' => $quote->sent_on,
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

 /*Privew Refresh Privew Quote */  

     public function refreshPrivewQuote(Request $request)
     {
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
        $products = QuoteProduct::where('quote_id',$request->quote_id)->get();
             foreach($products as $key=>$quote_product)
             {
                     //return $quote_product->product_id; die;
                   DB::table('quote_products')->where('quote_id', $request->quote_id)
                                               ->where('product_id',$quote_product->product_id)
                                              ->update(array(
                                              'sendprivew' => 0,
                                             ));
             }                
                 return response()->json(array(
                                             'status' => 200,
                                             'message'=> 'Success',
                                             'success_message'=>'Remove preview Data.',
                                         ),200);
             }
         }
    public function removeProduct(Request $request)
         {
            
            $productlist = json_decode($request->id);
            
            foreach ($productlist as $key => $value) {
             //print_r($value->id);
             //die();
             $result =  QuoteProduct::where('id',$value->id)->delete(); 
            }
           // print_r($value);
           // die();

            if ($result) {
                return response()->json(array(
                                            'status' => 200,
                                            'message'=> 'Success',
                                            'success_message'=>'Product removed from quote.',
                                            'data' => $result,
                                        ),200);
            }else{
                return response()->json(array(
                                            'status' => 400,
                                            'message'=> 'Error',
                                            'error_message'=>'Something went wrong!'
                                        ),200);
            }
            //   if ($request->isMethod('delete')) {
            //      $quoteProduct =  $request->all();
            //          echo "<pre>";
            //          print_r($quoteProduct);die;
            //      QuoteProduct::whereIn('id',$quoteProduct['ids'])->delete();
            //      return response()->json(array(
            //          'status' => 200,
            //          'message'=> 'Success',
            //          'success_message'=>'Product removed from quote.',
                   
            //      ),200);
            //   }
                 
             
         }
         public function HiresentQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        } 
        
        
		 $data = Quote::select('quotes.*', 'customers.name as name', 'customers.email as customer_email',
        'categories.name as category_name',
        'dealers.name as dealer_name','products.dealer_id as dealer_id',
        'products.title','products.model','products.year as product_year',
        'dealers.name as dealer_name','leads.name as lead_name','leads.email as lead_email',
        'leads.phone','leads.user_id','leads.date as lead_date','leads.status',
        'leads.customer_id as customer_id','quotes.status as quote_status')
        ->leftjoin('quote_products','quote_products.quote_id','=','quotes.id')
        ->leftjoin('products','products.id','=','quote_products.product_id')
        ->leftjoin('dealers','products.dealer_id','=','dealers.id')
        ->leftjoin('categories','products.category_id','=','categories.id')
        ->leftjoin('customers','quotes.customer_id','=','customers.id')  
        ->leftjoin('leads','leads.id','=','quotes.lead_id')  
		->groupBy('leads.customer_id')
	    ->where('leads.user_id',$request->user_id)
        ->where('quotes.sent','1')
        ->where('quotes.status','Hire')
        ->get();
		
        
        return response()->json(array(
                                        'status' => 200,
                                        'message'=> 'Success',
                                        'success_message'=>'Get Sent Quote.',
                                        'data' => $data,
                                    ),200);
                                    
                                        
    }
}
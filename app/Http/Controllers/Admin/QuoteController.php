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
use Mail;
use App\Models\User;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\HireInfo;
use App\Models\Quote;
use App\Models\QuoteProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ExtraProductInfo;
use App\Models\Dealer;
use App\Models\Customer;
use App\Models\AdminPermission;
use App\Models\SalesOrder;
use App\Models\HireOrder;
use App\Models\TradeIn;
use App\Models\TradeImage;
use App\DataTables\QuoteDataTable;
use App\DataTables\HireQuoteDataTable;
use App\DataTables\QuoteReportDataTable;
use App\Helpers\AdminHelper;

class QuoteController extends Controller
{
    //=================================================================

	public function index(QuoteDataTable $dataTable,Request $request)
	{
		Quote::where('is_read','0')->update(['is_read'=>'1']);

		$data = [
			'from' => $request->from,
			'to' => $request->to,
            'customer' => $request->customer,
			'user' => $request->user,
			'dealer' => $request->dealer,
			//'status' => 'Sales',
			'machine' => $request->machine
			
		];

		return $dataTable->with('data',$data)->render('admin/quotes/index');
	}
	
	public function hirequote(HireQuoteDataTable $dataTable,Request $request)
	{
		Quote::where('is_read','0')->update(['is_read'=>'1']);

		$data = [
			'from' => $request->from,
			'to' => $request->to,
            'customer' => $request->customer,
			'user' => $request->user,
			'dealer' => $request->dealer,
			'machine' => $request->machine
			//'status' => 'Hire',
		];

		return $dataTable->with('data',$data)->render('admin/hirequotes/index');
	}

    //===================================================
     //===================================================
    public function quotereport(QuoteReportDataTable $dataTable,Request $request)
	{
		$data = [
			'from' => $request->from,
			'to' => $request->to,
            'customer' => $request->customer,
			'user' => $request->user,
			'dealer' => $request->dealer ,
			'machine' => $request->machine,
			'sent' => 1
		];

		return $dataTable->with('data',$data)->render('admin/quotes/report');
	}

     //===================================================
     //===================================================

	public function createQuote()
	{
	  
	  $data = array();
	  $data['users'] = User::where('user_type','user')->orderBy('name')->get();
	  $data['customers'] = Customer::where('status','1')->orderBy('name')->get();
	  $data['dealers'] = Dealer::where('status','1')->get();

	  return view('admin/quotes/add',$data);
	}
    //===================================================

    //===================================================

	public function save(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'customer_id' 	=> 'required',
				'user_id' 		=> 'required',
			]);
			if ($validator->fails()) { 
	            return redirect('admin/sales_order/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
				$customer = Customer::where('id',$request->customer_id)->first();
				$newLead = new Lead;
				$newLead->title = $request->title;
				$newLead->customer_id = $request->customer_id;
				$newLead->email = $customer->email;
				$newLead->name = $customer->name;
				$newLead->phone = $customer->phone;
				$newLead->address = $customer->address;
				$newLead->date = date('Y-m-d');
				$newLead->status = 'Quote Sent';
				$newLead->message = $customer->message;
				$newLead->user_id = $request->user_id;
				$newLead->save();
				if ($newLead->save()) {
					$data = new Quote;
					$data->lead_id = $newLead->id;
					$data->customer_id = $request->customer_id;
					$data->status = 'Sales';
					$data->date = date('Y-m-d');
					$data->save();
					if ($data->save()) {
						DB::table('quote_products')->insert([
							'quote_id' => $data->id,
							'product_id' => $request->product_id,
							'price' => $request->price,
							'machine_price' =>  $request->price,
							'quantity' => 1,
							'status' => 'Sales',
							'total_price' => $request->price
						]);
						$price1 = QuoteProduct::where('quote_id', $data->id)->sum('total_price');
                     
                        DB::table('quotes')->where('id', $data->id)->update([
                            'price' => $price1
                        ]);
					}
			$data = Quote::find($data->id);
            $data->sent = '1';
            $data->sent_on = date('Y-m-d');
            if(!empty($data->attachment)){
                $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
            }else{
                $pathToFile = '';
            }

            $lead = Lead::where('id',$data->lead_id)->first();
            $user = User::where('id',$lead->user_id)->first();
            $customer = Customer::where('id',$data->customer_id)->first();
            $products = QuoteProduct::where('quote_id',$data->id)->get();
			$leadData = Lead::find($data->lead_id);
			// echo "<pre>";
			// print_r($products);die;
			$leadData = Lead::find($data->lead_id);

			if(!empty($leadData->email)) {
			   $customer_myemail = $leadData->email;
		   }
		   else{
			   $customer_myemail = 'test@gmail.com';
		   }
		    // echo "<pre>";
			//  print_r($customer_myemail);die;
            //$leadData = Lead::find($data->lead_id);
            $emailData = array(
                'email' => $customer_myemail,
                'title' => 'Screenpod Quotation',
                'pathToFile' => $pathToFile,
                'quote' => $data,
                'customer' => $customer,
                'products' => $products,
                'user_email' => $user->email,
                'users' => $user,
            );
           
			//  echo "<pre>";
            //     print_r($emailData);die;
            if(!empty($pathToFile)){
                Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                    $message->from('lalit@dmcconsultancy.com', 'Screenpod Quotation');
                    //$message->to('munender.singh@commediait.com');
                    //$message->bcc(['vikas.nagar@commediait.com','santosh.kumar@commediait.com']);
                    $message->to($emailData['email']);
                    $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
                    $message->subject('Screenpod Quotation');
                    $message->attach($emailData['pathToFile']);
                });   
            }else{
                Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                    $message->from('lalit@dmcconsultancy.com', 'Screenpod Quotation');
                    //$message->to('munender.singh@commediait.com');
                    //$message->bcc(['vikas.nagar@commediait.com','santosh.kumar@commediait.com']);
                    $message->to($emailData['email']);
                    $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
                    $message->subject('Screenpod Quotation');
                });
            }
				session()->flash('message', 'quotes added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/quotes/index');
			}
			}
		}
		catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Lead');
            Session::flash('alert-type', 'error');
           	return redirect('admin/sales_order/add');
        }
	}


    //===================================================

    public function view($id)
    {
    	$data['result'] = Quote::join('leads','leads.id','=','quotes.lead_id')
		                    ->join('users','users.id','=','leads.user_id')
		                    ->select('quotes.*','leads.name as lead_name','leads.email','leads.phone','leads.message','leads.status','users.name as user_name','leads.title as leads_title')
		                    ->where('quotes.id',$id)
		                    ->first();

		$product_ids = QuoteProduct::where('quote_id',$id)->get();

		$products = array();
		foreach ($product_ids as $key => $value) {
				$product_data = Product::join('product_images','products.id','=','product_images.product_id')
			                   // ->join('product_extra_info','quotes.id','=','product_extra_info.quote_id')
								->leftjoin('product_extra_info','products.id','=','product_extra_info.product_id')
																->leftjoin('trade_ins','products.id','=','trade_ins.old_product_id')
								->where('products.id',$value->product_id)
                                ->select('products.id as product_id','products.category_id','products.dealer_id','products.title','products.price as product_price','products.type','products.status as product_status','product_images.image','products.attachment as product_attachment',
								'product_extra_info.depot as depot','product_extra_info.hitch as hitch','product_extra_info.buckets as buckets','product_extra_info.extra as extra',
								'trade_ins.make as make','trade_ins.model as model','trade_ins.year as year','trade_ins.hours as hours','trade_ins.price as price'
								)
                                ->first();
		
            if (!empty($product_data)) {
            	$products[] = [
	                'id' => $product_data->product_id,
	                'quote_product_id' => $value->id,
	                'date' => $value->updated_at,
	                'title' => $product_data->title,
	                'price' => $value->price,
	                'currency' => $value->currency,
	                'quantity' => $value->quantity,
	                'total_price' => $value->total_price,
	                'product_attachment' => $product_data->product_attachment,
	                'image' => $product_data->image,
					'hitch' => $product_data->hitch,
					'buckets' => $product_data->buckets,
					'depot' => $product_data->depot,
					'extra' => $product_data->extra,
					'make' => $product_data->make,
					'model' => $product_data->model,
					'year' => $product_data->year,
					'hours' => $product_data->hours,
					'price' => $product_data->price,

	            ];
            }
		}
		$data['products'] = $products;

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

    	return view('admin.quotes.view',$data);
    }

    //=================================================================

	public function edit($id)
	{
		$data = array();
		$data['result'] = Quote::join('leads','leads.id','=','quotes.lead_id')
		                    ->join('users','users.id','=','leads.user_id')
		                    ->select('quotes.*','leads.name as lead_name','leads.email','leads.phone','leads.message','leads.status','users.name as user_name','leads.title as leads_title')
		                    ->where('quotes.id',$id)
		                    ->first();

		$product_ids = QuoteProduct::where('quote_id',$id)->get();

		$products = array();
		foreach ($product_ids as $key => $value) {
			$product_data = Product::join('product_images','products.id','=','product_images.product_id')
                                ->where('products.id',$value->product_id)
                                ->select('products.id as product_id','products.category_id','products.dealer_id','products.title','products.price as product_price','products.type','products.status as product_status','product_images.image','products.attachment as product_attachment')
                                ->first();

            if (!empty($product_data)) {
            	$products[] = [
	                'id' => $product_data->product_id,
	                'quote_product_id' => $value->id,
	                'title' => $product_data->title,
	                'price' => $value->price,
	                'quantity' => $value->quantity,
	                'total_price' => $value->total_price,
	                'product_attachment' => $product_data->product_attachment,
	                'image' => $product_data->image,
	            ];
            }
		}

		$data['products'] = $products;

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

		$data['dealers'] = Dealer::where('status','1')->orderBy('order_no')->get();

		return view('admin/quotes/edit',$data);
	}

	//====================================================================

		public function delete($id){
			try {
				$data = Quote::find($id)->delete();
			
				session()->flash('message', 'Quote deleted successfully');
				Session::flash('alert-type', 'success');
	
				return redirect('admin/quotes/index');
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				session()->flash('message', 'Some error occured');
				Session::flash('alert-type', 'error');
	
				  return redirect('admin/quotes/index');
			}
		}
//==================================================
	
	
	
	
	public function removeMachine(Request $request)
	{
		$quote_product = QuoteProduct::where('id',$request->quote_product_id)->first();
		
		ExtraProductInfo::where('quote_id',$quote_product->quote_id)->where('product_id',$quote_product->product_id)->delete();
		QuoteProduct::where('id',$request->quote_product_id)->delete();
		$final_price = QuoteProduct::where('quote_id',$request->id)->sum('total_price');

		$data = Quote::find($request->id);
        $data->price = $final_price;

        if ($data->save()) {
            return response()->json([
  				'msg'=>'success'
  			]);
        }else{
            return response()->json([
  				'msg'=>'error'
  			]);
        }
	}

	//=================================================================

	public function addExtra(Request $request)
	{
		try {
			if (empty($request->depot) && empty($request->hitch) && empty($request->buckets) && empty($request->extra)) {
				session()->flash('message', 'Please enter any one value!');
	            Session::flash('alert-type', 'error');
	           	return redirect('admin/quotes/edit'.'/'.$request->quote_id);
			}

			ExtraProductInfo::where('quote_id',$request->quote_id)
										->where('product_id',$request->product_id)
										->where('user_id',Auth::user()->id)
										->delete();

	        $data = new ExtraProductInfo;
			$data->quote_id = $request->quote_id;
			$data->product_id = $request->product_id;
	        $data->user_id = Auth::user()->id;
	        $data->depot = $request->depot;
	        $data->hitch = $request->hitch;
	        $data->buckets = $request->buckets;
	        $data->extra = $request->extra;
	        $data->save();

			session()->flash('message', 'Added successfully');
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

	public function getProducts($id,$type,$dealer_id)
    {
        $products = Product::where("type",$type)
    						->where('dealer_id',$dealer_id)
    						->where('status','!=','Sold')
    						->get(["title","id"]);

        $data = [];
        $data[] = '<option value="" >Select</option>';
    	foreach ($products as $key => $value) {
    		$data[] = '<option value="'.$value->id.'">'.$value->title.'</option>';
    	}

        return response()->json($data);
    }

    //=================================================================

	public function addMachine(Request $request)
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

	public function update(Request $request)
	{
		try {
			$quote_product = QuoteProduct::find($request->quote_product_id);
			$quote_product->price = $request->price;
			$quote_product->quantity = $request->quantity;
			$quote_product->total_price = $request->price * $request->quantity;
			$quote_product->save();

			$final_price = QuoteProduct::where('quote_id',$request->quote_id)->sum('total_price');

	        $quote = Quote::find($request->quote_id);
	        $quote->price = $final_price;
	        $quote->save();

			session()->flash('message', 'Updated successfully');
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

	public function resend($quote_id)
	{
		try {
	        $data = Quote::find($quote_id);
            $data->sent = '1';
            $data->sent_on = date('Y-m-d');
            
            if(!empty($data->attachment)){
                $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
            }else{
                $pathToFile = '';
            }

            $lead = Lead::where('id',$data->lead_id)->first();
            $user = User::where('id',$lead->user_id)->first();
            $customer = Customer::where('id',$data->customer_id)->first();
            $products = QuoteProduct::where('quote_id',$quote_id)->get();

            $leadData = Lead::find($data->lead_id);
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
            
            if(!empty($pathToFile)){
                Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                    $message->from('lalit@dmcconsultancy.com', 'Screenpod Quotation');
                    //$message->to('munender.singh@commediait.com');
                    //$message->bcc(['vikas.nagar@commediait.com','santosh.kumar@commediait.com']);
                    $message->to($emailData['email']);
                    $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
                    $message->subject('Screenpod Quotation');
                    $message->attach($emailData['pathToFile']);
                });   
            }else{
                Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
                    $message->from('lalit@dmcconsultancy.com', 'Screenpod Quotation');
                    //$message->to('munender.singh@commediait.com');
                    //$message->bcc(['vikas.nagar@commediait.com','santosh.kumar@commediait.com']);
                    $message->to($emailData['email']);
                    $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
                    $message->subject('Screenpod Quotation');
                });
            }
            
            $data->save();

			session()->flash('message', 'Quote sent successfully');
			Session::flash('alert-type', 'success'); 
			return redirect('admin/quotes/edit'.'/'.$quote_id);
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');
           	return redirect('admin/quotes/edit'.'/'.$quote_id);
        }
	}

	//====================================================================
public function sendorder($quote_id)
{
	try {
		$customer_id = DB::select('select * from quotes where id=?', [$quote_id]);
		$products_details = DB::select('select * from quote_products where quote_id=?', [$quote_id]);
		$user_id =   DB::select('select * from leads where id=?', [$customer_id[0]->lead_id]);

		foreach ($products_details as $productData) {
		
			$product_exist = DB::select('select * from sales_orders where quote_id = ? and customer_id = ? and product_id = ?', [$productData->quote_id, $customer_id[0]->customer_id,$productData->product_id]);
			if (empty($product_exist)) {
				$products_stock = DB::select('select * from products where id=?', [$productData->product_id]);
				    
				$order_number = DB::table('sales_orders')->count() +1; 
				//$salse_number = DB::table('sales_orders')->count();
				$macine_order = DB::table('sales_orders')->where('order_number',$order_number)->count() +1;

				    $chrList = $productData->quote_id;
                    $chrRepeatMin = 'CB0'; 
                    $chrRepeatMax = $productData->product_id;
                    $chrRandomLength = 'VB';
					$ordernum = '23_' . $order_number; 
					$machine_order_number= $ordernum.'_'.$macine_order;
//  print_r($machine_order_number);
//  die();
				
				$data = array(
					'quote_id'   => $productData->quote_id,
					'customer_id'   => $customer_id[0]->customer_id,
					'user_id'   => $user_id[0]->user_id,
					'product_id'   => $productData->product_id,
					'order_number'   => $ordernum,
					'machine_order_number'   => $machine_order_number,
					'price'   => $productData->price,
					'date'   => $customer_id[0]->date,
					'serial_number'   => $products_stock[0]->stock_number,
					'qty'   => $productData->quantity,
					 'tax'   => ($productData->price * $productData->quantity) * 23 / 100,
					'total_price'   => $productData->total_price + ($productData->price * $productData->quantity) * 23 / 100,					);
				$res = SalesOrder::insertGetId($data);
			}
			else{
				$products_stock = DB::select('select * from products where id=?', [$productData->product_id]);
				DB::table('sales_orders')
					->where('quote_id', $productData->quote_id)
					->where('customer_id', $customer_id[0]->customer_id)
					->where('product_id', $productData->product_id)
					->update([
						'quote_id'   => $productData->quote_id,
						'customer_id'   => $customer_id[0]->customer_id,
						'user_id'   => $user_id[0]->user_id,
						'product_id'   => $productData->product_id,
						'price'   => $productData->price,
						'date'   => $customer_id[0]->date,
						'serial_number'   => $products_stock[0]->stock_number,
						'qty'   => $productData->quantity,
						'tax'   => ($productData->price * $productData->quantity) * 23 / 100,
					   'total_price'   => $productData->total_price + ($productData->price * $productData->quantity) * 23 / 100,
					]);
			}
		}

		session()->flash('message', 'Sales order added successfully');
		Session::flash('alert-type', 'success'); 
		return redirect('admin/quotes/index');
	} catch (\Exception $e) {
		Log::error($e->getMessage());
		session()->flash('message', 'Some error occured!');
		Session::flash('alert-type', 'error');
		return redirect('admin/quotes/edit'.'/'.$quote_id);
		   // return redirect('admin/quotes/edit'.'/'.$request->quote_id);
	}
}
		//=======================ADD TRADE=============================================

    public function addtrade($id)
{   
	// $data['result'] = TradeIn::find($id);
	// print_r($data['result']);die;
    $data = Quote::find($id);
	return view('admin/quotes/addtrade',['data'=>$data]);
}
public function savetrade(Request $request)
{
	try {
			$idtrd = DB::select('select * from trade_ins where quote_id = ? ', [$request->quote_id]);
			$data= [];
			if (empty($idtrd)) {

				$data = new TradeIn;
				//=========================================================
				$data->quote_id = $request->quote_id;
				$data->make = $request->make;
				$data->model = $request->model;
				$data->year = $request->year;
				$data->hours = $request->hours;
				if ($data->save()) {
					if ($request->hasFile('image')) {
						$image = $request->file('image');
						$imagename = rand('1111', '9999') . '_' . time() . '_' . $image->getClientOriginalExtension();
						$destinationPath = public_path('/admin/clip-one/assets/trade_images');
						$image->move($destinationPath, $imagename);

						$source_url = public_path() . '/admin/clip-one/assets/trade_images/' . $imagename;
						$destination_url = public_path() . '/admin/clip-one/assets/trade_images/' . $imagename;
						$quality = 40;

						AdminHelper::compress_image($source_url, $destination_url, $quality);

						$trade_image = new TradeImage;
						$trade_image->trade_id = $data->id;
						$trade_image->image = $imagename;
						$trade_image->save();
					}
				}
				session()->flash('message', 'Trade  added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/quotes/index');				
			} 
			else {
				DB::table('trade_ins')->where('quote_id', $request->quote_id)
				->update(array(
					
					'make' =>  $request->make,
					'model' => $request->model,
					'year' => $request->year,
					'hours' => $request->hours
				));
				session()->flash('message', 'Trade  update successfully');
			Session::flash('alert-type', 'success'); 
			return redirect('admin/quotes/index');
				//return redirect('admin/trade_in/index');
			}
		  
	} 
	catch (\Exception $e) {
		return $e->getMessage();
	}
}
	//====================================================================


	public function addTrd(Request $request)
	{
		
		try {
			if (empty($request->model) && empty($request->make) && empty($request->year) && empty($request->hours) && empty($request->price) && empty($request->image)) {
				session()->flash('message', 'Please enter any one value!');
	            Session::flash('alert-type', 'error');
	           	return redirect('admin/quotes/edit'.'/'.$request->quote_id);
			}
			
			TradeIn::where('quote_id',$request->quote_id)
			->where('product_id',$request->product_id)
			->delete();

	        $data = new TradeIn;
			$data->quote_id = $request->quote_id;
			$data->product_id = $request->product_id;
	        $data->make = $request->make;
			$data->model = $request->model;
			$data->year = $request->year;
			$data->hours = $request->hours;
			$data->price = $request->price;
			if ($data->save()) {
				if ($request->hasFile('image')) {
					$image = $request->file('image');
					$imagename = rand('1111', '9999') . '_' . time() . '_' . $image->getClientOriginalExtension();
					$destinationPath = public_path('/admin/clip-one/assets/trade_images');
					$image->move($destinationPath, $imagename);

					$source_url = public_path() . '/admin/clip-one/assets/trade_images/' . $imagename;
					$destination_url = public_path() . '/admin/clip-one/assets/trade_images/' . $imagename;
					$quality = 40;

					AdminHelper::compress_image($source_url, $destination_url, $quality);

					$trade_image = new TradeImage;
					$trade_image->trade_id = $data->id;
					$trade_image->image = $imagename;
					$trade_image->save();
				}
			}
			session()->flash('message', 'Added successfully');
			Session::flash('alert-type', 'success'); 
			return redirect('admin/quotes/edit'.'/'.$request->quote_id);
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');
           	return redirect('admin/quotes/edit'.'/'.$request->quote_id);
        }
	}


	//Hire Quote 



	 //===================================================

	 public function createHireQuote()
	 {
	   
	   $data = array();
	   $data['users'] = User::where('user_type','user')->orderBy('name')->get();
	   $data['customers'] = Customer::where('status','1')->orderBy('name')->get();
	   $data['dealers'] = Dealer::where('status','1')->get();
 
	   return view('admin/hirequotes/add',$data);
	 }
	 //===================================================
	 public function hiresave(Request $request)
	 {
		 try {
			 $validator = Validator::make($request->all(), [
				 'customer_id' 	=> 'required',
				 'user_id' 		=> 'required',
			 ]);
			 if ($validator->fails()) { 
				 return redirect('admin/sales_order/add')
							 ->withErrors($validator)
							 ->withInput();
			 } else {
				 $customer = Customer::where('id',$request->customer_id)->first();
				 $newLead = new Lead;
				 $newLead->title = $request->title;
				 $newLead->customer_id = $request->customer_id;
				 $newLead->email = $customer->email;
				 $newLead->name = $customer->name;
				 $newLead->phone = $customer->phone;
				 $newLead->address = $customer->address;
				 $newLead->date = date('Y-m-d');
				 $newLead->status = 'Quote Sent';
				 $newLead->message = $customer->message;
				 $newLead->user_id = $request->user_id;
				 $newLead->save();
				 if ($newLead->save()) {
					 $data = new Quote;
					 $data->lead_id = $newLead->id;
					 $data->customer_id = $request->customer_id;
					 $data->status = 'Hire';
					 $data->date = date('Y-m-d');
					 $data->save();
					 if ($data->save()) {
						 DB::table('quote_products')->insert([
							 'quote_id' => $data->id,
							 'product_id' => $request->product_id,
							 'price' => $request->price,
							 'machine_price' =>  $request->price,
							 'quantity' => 1,
							 'status' => 'Hire',
							 'total_price' => $request->price
						 ]);
						 $price1 = QuoteProduct::where('quote_id', $data->id)->sum('total_price');
					  
						 DB::table('quotes')->where('id', $data->id)->update([
							 'price' => $price1
						 ]);
					 }
			 $data = Quote::find($data->id);
			 $data->sent = '1';
			 $data->sent_on = date('Y-m-d');
			 if(!empty($data->attachment)){
				 $pathToFile = public_path().'/admin/clip-one/assets/quotes/'.$data->attachment;
			 }else{
				 $pathToFile = '';
			 }
 
			 $lead = Lead::where('id',$data->lead_id)->first();
			 $user = User::where('id',$lead->user_id)->first();
			 $customer = Customer::where('id',$data->customer_id)->first();
			 $products = QuoteProduct::where('quote_id',$data->id)->get();
			 $leadData = Lead::find($data->lead_id);
			 // echo "<pre>";
			 // print_r($products);die;
			 $leadData = Lead::find($data->lead_id);
 
			 if(!empty($leadData->email)) {
				$customer_myemail = $leadData->email;
			}
			else{
				$customer_myemail = 'test@gmail.com';
			}
			 
			 $emailData = array(
				 'email' => $customer_myemail,
				 'title' => 'Screenpod Quotation',
				 'pathToFile' => $pathToFile,
				 'quote' => $data,
				 'customer' => $customer,
				 'products' => $products,
				 'user_email' => $user->email,
				 'users' => $user,
			 );
			
			 //  echo "<pre>";
			 //     print_r($emailData);die;
			 if(!empty($pathToFile)){
				 Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
					 $message->from('lalit@dmcconsultancy.com', 'Screenpod Quotation');
					 $message->to($emailData['email']);
					 $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
					 $message->subject('Screenpod Quotation');
					 $message->attach($emailData['pathToFile']);
				 });   
			 }else{
				 Mail::send('api.emails.emailQuote', $emailData, function ($message) use ($emailData) {
					 $message->from('lalit@dmcconsultancy.com', 'Screenpod Quotation');
					 $message->to($emailData['email']);
					 $message->cc([$emailData['user_email'],'lalit@dmcconsultancy.com']);
					 $message->subject('Screenpod Quotation');
				 });
			 }
				 session()->flash('message', 'Hire Quote added successfully');
				 Session::flash('alert-type', 'success'); 
				 return redirect('admin/hirequotes/index');
			 }
			 }
		 }
		 catch (\Exception $e) {
			 Log::error($e->getMessage());
			 session()->flash('message', 'Some error occured during save Lead');
			 Session::flash('alert-type', 'error');
				return redirect('admin/hirequotes/add');
		 }
	 }
 
 
	 //===================================================
	 //===================================================

	 public function hireview($id)
	 {
		 $data['result'] = Quote::join('leads','leads.id','=','quotes.lead_id')
							 ->join('users','users.id','=','leads.user_id')
							 ->select('quotes.*','leads.name as lead_name','leads.email','leads.phone','leads.message','leads.status','users.name as user_name','leads.title as leads_title')
							 ->where('quotes.id',$id)
							 ->first();
 
		 $product_ids = QuoteProduct::where('quote_id',$id)->get();
 
		 $products = array();
		 foreach ($product_ids as $key => $value) {
				 $product_data = Product::join('product_images','products.id','=','product_images.product_id')
								// ->join('product_extra_info','quotes.id','=','product_extra_info.quote_id')
								 ->leftjoin('product_extra_info','products.id','=','product_extra_info.product_id')
								->leftjoin('trade_ins','products.id','=','trade_ins.old_product_id')
								->leftjoin('hire_info','products.id','=','hire_info.product_id')
								 ->where('products.id',$value->product_id)
								 ->select('products.id as product_id','products.category_id','products.dealer_id',
								 'products.title','products.price as product_price','products.type',
								 'products.status as product_status','product_images.image','products.attachment as product_attachment',
								 'product_extra_info.depot as depot','product_extra_info.hitch as hitch','product_extra_info.buckets as buckets',
								 'product_extra_info.extra as extra','trade_ins.make as make','trade_ins.model as model',
								 'trade_ins.year as year','trade_ins.hours as hours','trade_ins.price as price',
								 'hire_info.min_hire_period as min_hire_period','hire_info.payment_terms as payment_terms'
								 ,'hire_info.purcharse_period as purcharse_period','hire_info.consumables as consumables'
								 ,'hire_info.transport_in as transport_in','hire_info.weekly_hire_price as weekly_hire_price'
								 ,'hire_info.fittings_price as fittings_price','hire_info.transport_out_price as transport_out_price'
								 ,'hire_info.delivery_location as delivery_location','hire_info.site_contact as site_contact'
								 ,'hire_info.hire_start as hire_start','hire_info.hire_end as hire_end'
								 )
								 ->first();
		 
			 if (!empty($product_data)) {
				 $products[] = [
					 'id' => $product_data->product_id,
					 'quote_product_id' => $value->id,
					 'date' => $value->updated_at,
					 'title' => $product_data->title,
					 'price' => $value->price,
					 'currency' => $value->currency,
					 'quantity' => $value->quantity,
					 'total_price' => $value->total_price,
					 'product_attachment' => $product_data->product_attachment,
					 'image' => $product_data->image,
					 'hitch' => $product_data->hitch,
					 'buckets' => $product_data->buckets,
					 'depot' => $product_data->depot,
					 'extra' => $product_data->extra,
					 'make' => $product_data->make,
					 'model' => $product_data->model,
					 'year' => $product_data->year,
					 'hours' => $product_data->hours,
					 'price' => $product_data->price,
					 'min_hire_period' => $product_data->min_hire_period,
					 'payment_terms' => $product_data->payment_terms,
					 'purcharse_period' => $product_data->purcharse_period,
					 'consumables' => $product_data->consumables,
					 'transport_in' => $product_data->transport_in,
					 'weekly_hire_price' => $product_data->weekly_hire_price,
					 'fittings_price' => $product_data->fittings_price,
					 'transport_out_price' => $product_data->transport_out_price,
					 'delivery_location' => $product_data->delivery_location,
					 'site_contact' => $product_data->site_contact,
					 'hire_start' => $product_data->hire_start,
					 'hire_end' => $product_data->hire_end,
				 ];
			 }
		 }
		 $data['products'] = $products;
 
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
 
		 return view('admin.hirequotes.view',$data);
	 }
 
	 //=================================================================
 
	 public function hireedit($id)
	 {
		 $data = array();
		 $data['result'] = Quote::join('leads','leads.id','=','quotes.lead_id')
							 ->join('users','users.id','=','leads.user_id')
							 ->select('quotes.*','leads.name as lead_name','leads.email','leads.phone','leads.message','leads.status','users.name as user_name','leads.title as leads_title')
							 ->where('quotes.id',$id)
							 ->first();
 
		 $product_ids = QuoteProduct::where('quote_id',$id)->get();
 
		 $products = array();
		 foreach ($product_ids as $key => $value) {
			 $product_data = Product::join('product_images','products.id','=','product_images.product_id')
								 ->where('products.id',$value->product_id)
								 ->select('products.id as product_id','products.category_id','products.dealer_id','products.title','products.price as product_price','products.type','products.status as product_status','product_images.image','products.attachment as product_attachment')
								 ->first();
 
			 if (!empty($product_data)) {
				 $products[] = [
					 'id' => $product_data->product_id,
					 'quote_product_id' => $value->id,
					 'title' => $product_data->title,
					 'price' => $value->price,
					 'quantity' => $value->quantity,
					 'total_price' => $value->total_price,
					 'product_attachment' => $product_data->product_attachment,
					 'image' => $product_data->image,
				 ];
			 }
		 }
 
		 $data['products'] = $products;
 
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
 
		 $data['dealers'] = Dealer::where('status','1')->orderBy('order_no')->get();
 
		 return view('admin/hirequotes/edit',$data);
	 }
 
	 //====================================================================
 
		 public function hiredelete($id){
			 try {
				 $data = Quote::find($id)->delete();
			 
				 session()->flash('message', 'Quote deleted successfully');
				 Session::flash('alert-type', 'success');
	 
				 return redirect('admin/quotes/index');
			 } catch (\Exception $e) {
				 Log::error($e->getMessage());
				 session()->flash('message', 'Some error occured');
				 Session::flash('alert-type', 'error');
	 
				   return redirect('admin/hirequotes/index');
			 }
		 }

		 public function hireaddMachine(Request $request)
	{
		try {
			$product = Product::where('id',$request->product_id)->first();

			$quote_product = new QuoteProduct;
			$quote_product->quote_id = $request->quote_id;
			$quote_product->status = 'Hire';
			
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
			return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');
           	return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
        }
	}

	//====================================================================

	public function hireupdate(Request $request)
	{
		try {
			$quote_product = QuoteProduct::find($request->quote_product_id);
			$quote_product->price = $request->price;
			$quote_product->quantity = $request->quantity;
			$quote_product->total_price = $request->price * $request->quantity;
			$quote_product->save();

			$final_price = QuoteProduct::where('quote_id',$request->quote_id)->sum('total_price');

	        $quote = Quote::find($request->quote_id);
	        $quote->price = $final_price;
	        $quote->save();

			session()->flash('message', 'Updated successfully');
			Session::flash('alert-type', 'success'); 
			return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured!');
            Session::flash('alert-type', 'error');
           	return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
        }
	}
	 
	 //====================================================================

	public function hiregetProducts($id,$type,$dealer_id)
    {
        $products = Product::where("type",'like','%Hire%')
    						->where('dealer_id',$dealer_id)
    						->where('status','!=','Sold')
    						->get(["title","id"]);

        $data = [];
        $data[] = '<option value="" >Select</option>';
    	foreach ($products as $key => $value) {
    		$data[] = '<option value="'.$value->id.'">'.$value->title.'</option>';
    	}

        return response()->json($data);
    }
//=================================================================

public function hireInfo(Request $request)
{
	try {
		if (empty($request->min_hire_period) && empty($request->payment_terms) && empty($request->purcharse_period) && empty($request->consumables) && empty($request->transport_in) && empty($request->weekly_hire_price) && empty($request->fittings_price) && empty($request->transport_out_price) && empty($request->delivery_location) && empty($request->site_contact) && empty($request->hire_start) && empty($request->hire_end)) {
			session()->flash('message', 'Please enter any one value!');
			Session::flash('alert-type', 'error');
			   return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
		}

		HireInfo::where('quote_id',$request->quote_id)
									->where('product_id',$request->product_id)
									->delete();

		        $info = new HireInfo;
                $info->quote_id = $request->quote_id;
                $info->product_id = $request->product_id;
                $info->min_hire_period = $request->min_hire_period;
                $info->payment_terms = $request->payment_terms;
                $info->purcharse_period = $request->purcharse_period;
                $info->consumables = $request->consumables;
                $info->transport_in = $request->transport_in;
                $info->weekly_hire_price = $request->weekly_hire_price;
                $info->fittings_price = $request->fittings_price;
                $info->transport_out_price = $request->transport_out_price;
                $info->delivery_location = $request->delivery_location;
                $info->site_contact = $request->site_contact;
                $info->hire_start = $request->hire_start;
                $info->hire_end	 = $request->hire_end	;
                $info->save();

		session()->flash('message', 'Added successfully');
		Session::flash('alert-type', 'success'); 
		return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
	} catch (\Exception $e) {
		Log::error($e->getMessage());
		session()->flash('message', 'Some error occured!');
		Session::flash('alert-type', 'error');
		   return redirect('admin/hirequotes/edit'.'/'.$request->quote_id);
	}
}
//====================================================================
public function sendhireorder($quote_id)
{
	try {
		$customer_id = DB::select('select * from quotes where id=?', [$quote_id]);
		$products_details = DB::select('select * from quote_products where quote_id=?', [$quote_id]);
		$user_id =   DB::select('select * from leads where id=?', [$customer_id[0]->lead_id]);

		foreach ($products_details as $productData) {
		
			$product_exist = DB::select('select * from hire_orders where quote_id = ? and customer_id = ? and product_id = ?', [$productData->quote_id, $customer_id[0]->customer_id,$productData->product_id]);
			if (empty($product_exist)) {
				$products_stock = DB::select('select * from products where id=?', [$productData->product_id]);
				
				    $chrList = $productData->quote_id;
                    $chrRepeatMin = 'CB0'; 
                    $chrRepeatMax = $productData->product_id;
                    $chrRandomLength = 'VB';
                    $agreement_no= $chrRepeatMin.''.$chrList.''.$chrRepeatMax.''.$chrRandomLength;
					$ordernum = '#ON0'; 
					$order_number= $ordernum.''.$chrList.''.$chrRepeatMax;

					$data = array(
					'quote_id'   => $productData->quote_id,
					'customer_id'   => $customer_id[0]->customer_id,
					'user_id'   => $user_id[0]->user_id,
					'order_number'   => $order_number,
					'agreement_no'   => $agreement_no,
					'product_id'   => $productData->product_id,
					'price'   => $productData->price,
					'date'   => $customer_id[0]->date,
					'serial_number'   => $products_stock[0]->stock_number,
					'qty'   => $productData->quantity,
					'tax'   => ($productData->price * $productData->quantity) * 23 / 100,
					'total_price'   => $productData->total_price + ($productData->price * $productData->quantity) * 23 / 100,					);
				$res = HireOrder::insertGetId($data);
			}
			else{
				$products_stock = DB::select('select * from products where id=?', [$productData->product_id]);
				DB::table('hire_orders')
					->where('quote_id', $productData->quote_id)
					->where('customer_id', $customer_id[0]->customer_id)
					->where('product_id', $productData->product_id)
					->update([
						'quote_id'   => $productData->quote_id,
						'customer_id'   => $customer_id[0]->customer_id,
						'user_id'   => $user_id[0]->user_id,
						'product_id'   => $productData->product_id,
						'price'   => $productData->price,
						'date'   => $customer_id[0]->date,
						'serial_number'   => $products_stock[0]->stock_number,
						'qty'   => $productData->quantity,
						'tax'   => ($productData->price * $productData->quantity) * 23 / 100,
					   'total_price'   => $productData->total_price + ($productData->price * $productData->quantity) * 23 / 100,
					]);
			}
		}

		session()->flash('message', 'Hire order added successfully');
		Session::flash('alert-type', 'success'); 
		return redirect('admin/hire_order/index');
	} catch (\Exception $e) {
		Log::error($e->getMessage());
		session()->flash('message', 'Some error occured!');
		Session::flash('alert-type', 'error');
		return redirect('admin/hirequotes/edit'.'/'.$quote_id);
		   // return redirect('admin/quotes/edit'.'/'.$request->quote_id);
	}
}
//====================================================================
  
}

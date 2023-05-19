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
use App\Models\Category;
use App\Models\ServiceHistory;
use App\Models\Dealer;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Action;
use App\Models\Role;
use App\Models\AdminPermission;
use App\DataTables\ProductDataTable;
use App\Helpers\AdminHelper;
use Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //=================================================================

	public function index(Request $request)
	{
		$data = [];
		//==============================================
		$status_action = Action::where('action_slug','status')->first();
        $data['checkStatusAction'] = Role::where('name_slug','products')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','products')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================

		$data['categories'] = Category::get();
		$data['dealers'] = Dealer::get();

		if (!empty($request->category_id) || !empty($request->dealer_id) || !empty($request->status)  || !empty($request->stock_number) || !empty($request->backorder_number)  || !empty($request->model) || !empty($request->title)) {

			$query = Product::select('*');

			if (!empty($request->category_id)) {
				$query = $query->where('category_id',$request->category_id);
				$data['category_id'] = $request->category_id;
			}else{
				$data['category_id'] = '';
			}
			if (!empty($request->dealer_id)) {
				$query = $query->where('dealer_id',$request->dealer_id);
				$data['dealer_id'] = $request->dealer_id;
			}else{
				$data['dealer_id'] = '';
			}
			if (!empty($request->status)) {
				$query = $query->where('status',$request->status);
				$data['status'] = $request->status;
			}else{
				$data['status'] = '';
			}

			if (!empty($request->stock_number)) {
				$query = $query->where('stock_number',$request->stock_number);
				$data['stock_number'] = $request->stock_number;
			}else{
				$data['stock_number'] = '';
			}
			
			if (!empty($request->backorder_number)) {
				$query = $query->where('backorder_number',$request->backorder_number);
				$data['backorder_number'] = $request->backorder_number;
			}else{
				$data['backorder_number'] = '';
			}
			
			if (!empty($request->model)) {
				$query = $query->where('model',$request->model);
				$data['model'] = $request->model;
			}else{
				$data['model'] = '';
			}
			if (!empty($request->title)) {
				$query = $query->where('title','LIKE','%'.$request->title.'%');
				$data['title'] = $request->title;
			}else{
				$data['title'] = '';
			}
			
		}else{
			$query = Product::select('*');
		}

        $data['results'] = $query->orderBy('order_no')->orderBy('title')->where('type','!=', 'Trade')->groupBy('title')->get();

		return view('admin/products/index',$data);
	}

	//=================================================================

public function instock(Request $request)
	{
		$data = [];
		//==============================================
		$status_action = Action::where('action_slug','status')->first();
        $data['checkStatusAction'] = Role::where('name_slug','products')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','products')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================

		$data['categories'] = Category::get();
		$data['dealers'] = Dealer::get();

		if (!empty($request->category_id) || !empty($request->dealer_id) || !empty($request->status)  || !empty($request->stock_number) || !empty($request->backorder_number)  || !empty($request->model) || !empty($request->title)) {

			$query = Product::select('*');

			if (!empty($request->category_id)) {
				$query = $query->where('category_id',$request->category_id);
				$data['category_id'] = $request->category_id;
			}else{
				$data['category_id'] = '';
			}
			if (!empty($request->dealer_id)) {
				$query = $query->where('dealer_id',$request->dealer_id);
				$data['dealer_id'] = $request->dealer_id;
			}else{
				$data['dealer_id'] = '';
			}
			if (!empty($request->status)) {
				$query = $query->where('status',$request->status);
				$data['status'] = $request->status;
			}else{
				$data['status'] = '';
			}

			if (!empty($request->stock_number)) {
				$query = $query->where('stock_number',$request->stock_number);
				$data['stock_number'] = $request->stock_number;
			}else{
				$data['stock_number'] = '';
			}
			
			if (!empty($request->backorder_number)) {
				$query = $query->where('backorder_number',$request->backorder_number);
				$data['backorder_number'] = $request->backorder_number;
			}else{
				$data['backorder_number'] = '';
			}
			
			if (!empty($request->model)) {
				$query = $query->where('model',$request->model);
				$data['model'] = $request->model;
			}else{
				$data['model'] = '';
			}
			if (!empty($request->title)) {
				$query = $query->where('title','LIKE','%'.$request->title.'%');
				$data['title'] = $request->title;
			}else{
				$data['title'] = '';
			}
			
		}else{
			$query = Product::select('*');
		}

        $data['results'] = $query->orderBy('order_no')->orderBy('title')->where('type','!=', 'Trade')->where('status','!=', 'Sold')->get();

		return view('admin/products/instock',$data);
	}
	//=================================================================

	public function add()
	{
		$data = array();
		$data['categories'] = Category::get();
		$data['dealers'] = Dealer::get();

		return view('admin/products/add',$data);
	}

	//=================================================================

	public function save(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'category_id' => 'required',
				'dealer_id' => 'required',
				'stock_number' => 'required|unique:products,stock_number',
				//'backorder_number' => 'required',
				'date' => 'required',
				'title' => 'required',
				//'model' => 'required',
				'year' => 'required',
				'hours' => 'required',
				'weight' => 'required',
				'description' => 'required',
				'price' => 'required',
				'type' => 'required',
				'status' => 'required',
				'image' => 'required',
				'image.*' => 'mimes:jpeg,jpg,png,gif',

			],
				[   
            'stock_number.unique'      => 'Sorry, This Serial Number Is Already Used By Another Machine.',
        ]
			);
			if ($validator->fails()) { 
	            return redirect('admin/products/add')
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
	            $multtype=implode('/',$request->type);
				$insurance = $request->file('insurance');
				//=========================================================
				/*Insurance*/
				if(!empty($insurance)) {
		        	$insurance_imagename = $insurance->getClientOriginalName();
					$destinationPath = public_path('/admin/clip-one/assets/products/insurance');
			        $insurance->move($destinationPath, $insurance_imagename);
				} else {
					$insurance_imagename = '';
				}

				$ce_cert = $request->file('ce_cert');
				
				//=========================================================
				/*ce_cert*/
				if(!empty($ce_cert)) {
		        	$ce_cert_imagename = $ce_cert->getClientOriginalName();
					$destinationPath = public_path('/admin/clip-one/assets/products/ce_cert');
			        $ce_cert->move($destinationPath, $ce_cert_imagename);
				} else {
					$ce_cert_imagename = '';
				}
			

				$attachment = $request->file('attachment');
				//=========================================================
				/*attachment*/
				if(!empty($attachment)) {
		        	$attachment_imagename = $attachment->getClientOriginalName();
					$destinationPath = public_path('/admin/clip-one/assets/products/attachment');
			        $attachment->move($destinationPath, $attachment_imagename);
				} else {
					$attachment_imagename = '';
				}


				

				$video_file = $request->file('video_file');
				//dd($product); die;
				if(!empty($video_file)) {
		        	$video_file_name = rand('1111','9999').'_'.time().'.'.$video_file->getClientOriginalExtension();

					$destinationPath = public_path('/admin/clip-one/assets/products/video_file');
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
				foreach ($request->stock_number as $key => $stock_number) {
					$maxOrder = Product::max('order_no');

					$data = new Product;
			        $data->category_id = $request->category_id;
			        $data->dealer_id = $request->dealer_id;
			        $data->stock_number = $stock_number;
			        //$data->backorder_number = $request->backorder_number;
			        $data->title = $request->title;
			        $data->model = $request->title;
					$data->region= $request->region;
			        $data->year = $request->year;
			        $data->hours = $request->hours;
			        $data->weight = $request->weight;
			        $data->description = $request->description;
			        $data->price = $request->price;

					//$data['type'] = $request('type');
			        $data->type = $multtype;
			        $data->attachment = $attachment_imagename;
					$data->insurance = $insurance_imagename;
					$data->ce_cert = $ce_cert_imagename;
					$data->video_file = $video_file_name;
			        $data->status = $request->status;
			        $data->upcoming_quantity = $request->upcoming_quantity != '' ? $request->upcoming_quantity : '0';
			        $data->date = date('Y-m-d',strtotime($request->date));
			        $data->order_no = $maxOrder + 1;
			        $data->save();

			        $images = $request->file('image');
					foreach ($images as $key1 => $image) {
						$imagename = rand('1111','9999').'_'.time().'.'.$image->getClientOriginalExtension();
				        $destinationPath = public_path('/admin/clip-one/assets/products/thumbnail');
				        
				        $img = Image::make($image->getRealPath());

				        $img->resize(100, 100, function ($constraint) {
						    $constraint->aspectRatio();
						})->save($destinationPath.'/'.$imagename);

						$destinationPath = public_path('/admin/clip-one/assets/products/original').'/';
				        File::copy($image, $destinationPath.$imagename);
	        			$product_image = new ProductImage;
	        			$product_image->product_id = $data->id;
	        			$product_image->image = $imagename;
	        			$product_image->save();
						$products= ProductImage::where('product_id',$data->id)->get();

						$emailData = array(
							//'email' => $leadData->email,
							'title' => 'Screenpod',
							'products' => $products,
						);
						$file = "products_$data->id.pdf";
						
						$pdf = PDF::loadView('admin.products.productimages', $emailData);

						Storage::disk('uploads')->put('products_' . $data->id . '.pdf', $pdf->output());
		
						DB::table('products')->where('id', $data->id)
							->update(array(
								'pdf_url' => $file,
							));
					
					}
				}
				//die;

				session()->flash('message', 'Product added successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/products/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Product');
            Session::flash('alert-type', 'error');
           	return redirect('admin/products/add');
        }
	}

	//============================View=====================================

	public function view($id)
    {
    	$data['result'] = Product::find($id);
		$data['productImages'] = ProductImage::where('product_id',$id)->get();
		$data['categories'] = Category::get();
		$data['dealers'] = Dealer::get();
		$data['service_exist'] = ServiceHistory::where('product_id',$id)->first();

    	return view('admin.products.view',$data);
    }
//=================================================================




	public function edit($id)
	{
		$data = array();
		$data['result'] = Product::find($id);
		
		$data['productImages'] = ProductImage::where('product_id',$id)->get();
		$data['categories'] = Category::get();
		
		$data['dealers'] = Dealer::get();
		$data['service_exist'] = ServiceHistory::where('product_id',$id)->first();

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

		return view('admin/products/edit',$data);
	}

	//=================================================================

	public function update(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				'category_id' => 'required',
				'dealer_id' => 'required',
				'stock_number' => 'required',
				'date' => 'required',
				'title' => 'required',
				'year' => 'required',
				'hours' => 'required',
				'weight' => 'required',
				'description' => 'required',
				'price' => 'required',
				'type' => 'required',
				'status' => 'required',
			]);
			if ($validator->fails()) { 
	            return redirect('admin/products/edit'.'/'.$request->id)
	                        ->withErrors($validator)
	                        ->withInput();
			} else {
	            $multtype=implode('/',$request->type);
		        $data = Product::find($request->id);
				/*insurance*/
				$insurance = $request->file('insurance');

				if(!empty($insurance)) {
					$file1 = public_path().'/admin/clip-one/assets/products/insurance/'.$data->insurance;
					File::delete($file1);

		        	$insurance_imagename = $insurance->getClientOriginalName();
					$destinationPath = public_path('/admin/clip-one/assets/products/insurance');
			        $insurance->move($destinationPath, $insurance_imagename);
				} else {
					$insurance_imagename = $data->insurance;
				}

					/*insurance*/
					$ce_cert = $request->file('ce_cert');

					if(!empty($ce_cert)) {
						$file1 = public_path().'/admin/clip-one/assets/products/ce_cert/'.$data->ce_cert;
						File::delete($file1);
	
						$ce_cert_imagename = $ce_cert->getClientOriginalName();
						$destinationPath = public_path('/admin/clip-one/assets/products/ce_cert');
						$ce_cert->move($destinationPath, $ce_cert_imagename);
					} else {
						$ce_cert_imagename = $data->ce_cert;
					}
					
				/*attachment*/
				$attachment = $request->file('attachment');

				if(!empty($attachment)) {
					$file1 = public_path().'/admin/clip-one/assets/products/attachment/'.$data->attachment;
					File::delete($file1);

		        	$attachment_imagename = $attachment->getClientOriginalName();
					$destinationPath = public_path('/admin/clip-one/assets/products/attachment');
			        $attachment->move($destinationPath, $attachment_imagename);
				} else {
					$attachment_imagename = $data->attachment;
				}


				



				$video_file = $request->file('video_file');
				//dd($product); die;
				if(!empty($video_file)) {
					$file1 = public_path().'/admin/clip-one/assets/dealers/products/'.$data->video_file;
        			File::delete($file1);

		        	$video_file_name = time().'.'.$video_file->getClientOriginalExtension();

					$destinationPath = public_path('/admin/clip-one/assets/products/video_file');
			        $video_file->move($destinationPath, $video_file_name);
				} else {
					$video_file_name = $data->video_file;
				}
		        //=========================================================
				if(!empty($request->video_url)) {
					$video_url = $request->video_url;
				} else {
					$video_url = '';
				}
		        //=========================================================
		        $data->category_id = $request->category_id;
		        $data->dealer_id = $request->dealer_id;
		        $data->stock_number = $request->stock_number;
		        $data->backorder_number = $request->backorder_number;
		        $data->title = $request->title;
				$data->region= $request->region;
		        $data->model = $request->title;
		        $data->year = $request->year;
		        $data->hours = $request->hours;
		        $data->weight = $request->weight;
		        $data->description = $request->description;
		        $data->price = $request->price;
		        // $data->type = $request->type;
				$data->type = $multtype;

		        $data->attachment = $attachment_imagename;
				$data->insurance = $insurance_imagename;
				$data->ce_cert = $ce_cert_imagename;
				$data->video_file = $video_file_name;
		        $data->status = $request->status;
		        $data->upcoming_quantity = $request->upcoming_quantity != '' ? $request->upcoming_quantity : '0';
		        $data->date = date('Y-m-d',strtotime($request->date));
		        $data->save();

		        $images = $request->file('image');
		        if (!empty($images)) {
		        	foreach ($images as $key => $image) {
						$imagename = rand('1111','9999').'_'.time().'.'.$image->getClientOriginalExtension();
				        $destinationPath = public_path('/admin/clip-one/assets/products/thumbnail');
				        
				        $img = Image::make($image->getRealPath());

				        $img->resize(100, 100, function ($constraint) {
						    $constraint->aspectRatio();
						})->save($destinationPath.'/'.$imagename);

						$destinationPath = public_path('/admin/clip-one/assets/products/original');
				        $image->move($destinationPath, $imagename);

				        $source_url = public_path().'/admin/clip-one/assets/products/original/'.$imagename;
	        			$destination_url = public_path().'/admin/clip-one/assets/products/original/'.$imagename;
	        			$quality = 40;

	        			AdminHelper::compress_image($source_url, $destination_url, $quality);

	        			$product_image = new ProductImage;
	        			$product_image->product_id = $data->id;
	        			$product_image->image = $imagename;
	        			$product_image->save();

						$products= ProductImage::where('product_id',$data->id)->get();
						$emailData = array(
							//'email' => $leadData->email,
							'title' => 'Screenpod',
							'products' => $products,
						);
						$file = "products_$data->id.pdf";
						
						$pdf = PDF::loadView('admin.products.productimages', $emailData);

						Storage::disk('uploads')->put('products_' . $data->id . '.pdf', $pdf->output());
		
						DB::table('products')->where('id', $data->id)
							->update(array(
								'pdf_url' => $file,
							));
					}
		        }

				session()->flash('message', 'Product updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/products/index');
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during update Product');
            Session::flash('alert-type', 'error');
           	return redirect('admin/products/edit'.'/'.$request->id);
        }
	}

	//=================================================================
	public function getMakes($id)
    {
        $models = Category::where("dealer_id",$id)->get();
        $data = [];
        $data[] = '<option value="" >Select Category</option>';
        foreach ($models as $key => $value) {
            $data[] = '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        
        return response()->json($data);
    }

    //====================================================
	public function geteditMakes($id)
    {
        $models = Category::where("dealer_id",$id)->get();
        $data = [];
        $data[] = '<option value="" >Select Category</option>';
        foreach ($models as $key => $value) {
           $data[] = '<option value="'.$value->id.'">'.$value->name.'</option>';



        }
        

		
        return response()->json($data);
    }

    //====================================================


	public function delete($id){
		
		try {
			$data = Product::find($id);
			$images = ProductImage::where('product_id',$id)->get();

			$file = public_path().'/admin/clip-one/assets/products/attachment/'.$data->attachment;
			File::delete($file);

			foreach ($images as $key => $value) {
				$file1 = public_path().'/admin/clip-one/assets/products/original/'.$value->image;
				$file2 = public_path().'/admin/clip-one/assets/products/thumbnail/'.$value->image;
				File::delete($file1,$file2);
			}

			Product::where('id',$id)->delete();
			ProductImage::where('product_id',$id)->delete();
		
			session()->flash('message', 'Product deleted successfully');
	        Session::flash('alert-type', 'success');

	        return back();
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured');
            Session::flash('alert-type', 'error');

          	return back();
        }
    }

    //===================================================
	
	public function status(Request $request, $id){
		
		try {
			
			$data = Dealer::find($id);
			
			if($data->status == '1')
			{
				$status = '0';
			} 
			else 
			{
				$status = '1';
			}
			$data->status = $status;
			$data->save();
			
		
			session()->flash('message', 'Dealer update successfully');
	        Session::flash('alert-type', 'success');
	        return redirect('admin/products/index');
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/products/index');
        }
    }

    //===================================================

    public function imageDelete($id){
		
		try {
			$data = ProductImage::find($id);

			$file1 = public_path().'/admin/clip-one/assets/products/thumbnail/'.$data->image;
			$file2 = public_path().'/admin/clip-one/assets/products/original/'.$data->image;
			File::delete($file1, $file2);

			$delete = ProductImage::where('id',$id)->delete();
		
			return response()->json(['msg'=>'success']);
	    } catch (\Exception $e) {
            Log::error($e->getMessage());
		    return response()->json(['msg'=>'error']);
        }
    }

    //===================================================

    public function sortProducts(Request $request)
  	{
  		$tasks = Product::all();
        foreach ($tasks as $task) {
            $id = $task->id;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order_no' => $order['position']]);
                }
            }
        }
        return response()->json(['status'=>'success']);
  	}

  	//===================================================

  	public function add_more(Request $request)
	{
		try {
		    $validator = Validator::make($request->all(), [
				'stock_number' => 'required|unique:products,stock_number',
			],
			[   
            'stock_number.unique'      => 'Sorry, This Serial Number Is Already Used By Another Machine.',
            ]
			);
			if ($validator->fails()) { 
			    session()->flash('message', 'Sorry, This Serial Number Is Already Used By Another Machine.');
			Session::flash('alert-type', 'error'); 
			return back();
	            
			}
			else {
			$oldData = Product::where('id',$request->id)->first();

			foreach ($request->stock_number as $key => $stock_number) {
				$maxOrder = Product::max('order_no');

				$data = new Product;
		        $data->category_id = $oldData->category_id;
		        $data->dealer_id = $oldData->dealer_id;
		        $data->stock_number = $stock_number;
		        $data->backorder_number = $oldData->backorder_number;
		        $data->date = date('Y-m-d',strtotime($oldData->date));
		        $data->title = $oldData->title;
		        $data->model = $oldData->model;
		        $data->year = $oldData->year;
		        $data->hours = $oldData->hours;
		        $data->weight = $oldData->weight;
		        $data->description = $oldData->description;
		        $data->price = $oldData->price;
		        $data->type = $oldData->type;
		        $data->attachment = $oldData->attachment;
		        $data->status = $oldData->status;
		        $data->order_no = $maxOrder + 1;
		        $data->save();

		        $images = ProductImage::where('product_id',$request->id)->get();
				foreach ($images as $key1 => $image) {
        			$product_image = new ProductImage;
        			$product_image->product_id = $data->id;
        			$product_image->image = $image->image;
        			$product_image->save();
				}
			}

			session()->flash('message', 'Product added successfully');
			Session::flash('alert-type', 'success'); 
			return back();
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save Product');
            Session::flash('alert-type', 'error');
           	return back();
        }
	}

	//=================================================================
//=================================================================
	public function usedEquipments(Request $request)
   
	{
		$data = [];
		//==============================================
		$status_action = Action::where('action_slug','status')->first();
        $data['checkStatusAction'] = Role::where('name_slug','products')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','products')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================

		$data['categories'] = Category::get();
		$data['dealers'] = Dealer::get();

		if (!empty($request->category_id) || !empty($request->dealer_id) || !empty($request->status)  || !empty($request->stock_number) || !empty($request->model) || !empty($request->title)) {

			$query = Product::select('*');

			if (!empty($request->category_id)) {
				$query = $query->where('category_id',$request->category_id);
				$data['category_id'] = $request->category_id;
			}else{
				$data['category_id'] = '';
			}
			if (!empty($request->dealer_id)) {
				$query = $query->where('dealer_id',$request->dealer_id);
				$data['dealer_id'] = $request->dealer_id;
			}else{
				$data['dealer_id'] = '';
			}
			if (!empty($request->status)) {
				$query = $query->where('status',$request->status);
				$data['status'] = $request->status;
			}else{
				$data['status'] = '';
			}

			if (!empty($request->stock_number)) {
				$query = $query->where('stock_number',$request->stock_number);
				$data['stock_number'] = $request->stock_number;
			}else{
				$data['stock_number'] = '';
			}
			if (!empty($request->model)) {
				$query = $query->where('model',$request->model);
				$data['model'] = $request->model;
			}else{
				$data['model'] = '';
			}
			if (!empty($request->title)) {
				$query = $query->where('title','LIKE','%'.$request->title.'%');
				$data['title'] = $request->title;
			}else{
				$data['title'] = '';
			}
			
		}else{
			$query = Product::select('*');
		}

        $data['results'] = $query->orderBy('order_no')->orderBy('title')->where('products.type','Trade')->get();

		return view('admin/products/usedEquipments',$data);
	}

//======================Service History===================================

	public function service_history(Request $request)
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
                
			$service_exist = ServiceHistory::where('product_id',$request->product_id)->first();
			
			


 if (!empty($service_exist)) {
	
	DB::table('service_history')->where('product_id', $request->product_id)
	->update(array( 
		'filters' =>  $request->filters,
		'meshes' => $request->meshes,
		'options' => $request->options,
		 'extras' => $request->extras,
		'engine' => $request->engine,
		'warranty' => $request->warranty,
		'engine_warranty' => $request->engine_warranty,
		'tier' => $request->tier,
		'machine_registration' => $request->machine_registration,
		'insurance' => $request->insurance
	));
  } else {
	
	$data = new ServiceHistory;
	//=========================================================
	$data->product_id = $request->product_id;
	$data->filters = $request->filters;
	$data->meshes = $request->meshes;
	$data->options = $request->options;
	$data->extras = $request->extras;
	$data->engine = $request->engine;
	$data->warranty = $request->warranty;
	$data->engine_warranty = $request->engine_warranty;
	$data->tier = $request->tier;
	$data->machine_registration = $request->machine_registration;
	$data->insurance = $request->insurance;
	$data->save();
  }
		       

				session()->flash('message', 'Record added successfully');
				Session::flash('alert-type', 'success'); 
				
				return redirect()->back();
			}
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during save record');
            Session::flash('alert-type', 'error');
			return redirect()->back();
        }
	}
}

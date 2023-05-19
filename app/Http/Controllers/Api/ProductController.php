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
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\TradeIn;
use App\Helpers\AdminHelper;
use Carbon;

class ProductController extends Controller
{
    //=================================================================

    /*Dealerships*/
    public function dealerships(Request $request)
    {
        if (!empty($request->search)) {
            $data = Dealer::select('id','name','status','order_no')
                        ->where('status','1')
                        ->orderBy('order_no','asc')
                        ->get();
        }else{
            $data = Dealer::select('id','name','status','order_no')
                        ->where('status','1')
                        ->orderBy('order_no','asc')
                        ->get();
        }

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

    //=================================================================

    /*Models by make*/
    public function models(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dealer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }

        $data = Product::select('model')
                        ->where('dealer_id',$request->dealer_id)
                        ->groupBy('model')
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

 
  

    //=================================================================

    /*Machines by dealer id (new)*/
    public function productsByDealer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dealer_id' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }
    
            if (!empty($request->search)) {
            $products = Product::join('dealers','products.dealer_id','=','dealers.id')

                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.id','products.category_id','products.price','products.dealer_id','products.title',
                        'products.video_file','products.insurance','products.ce_cert','products.type','products.order_no','products.upcoming_quantity','products.date',
                        'dealers.name as dealer_name','categories.name as category_name','products.status','products.attachment',
                        'products.stock_number','products.backorder_number','products.pdf_url')
                        ->where('products.dealer_id',$request->dealer_id)
                        ->where('products.category_id',$request->category_id)
                        ->where('products.type', 'like','%New%')
                       // ->where('products.type','New')
                        //->where('products.status','In Stock')
                        ->groupBy('products.title')
                        ->orderBy('products.order_no')
                        ->get();
        }else{
            $products = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.id','products.category_id','products.price','products.dealer_id','products.title',
                        'products.video_file','products.insurance','products.ce_cert','products.description','products.type','products.order_no',
                        'products.upcoming_quantity','products.date','dealers.name as dealer_name',
                        'categories.name as category_name','products.status','products.attachment',
                        'products.stock_number','products.backorder_number','products.pdf_url')
                        ->where('products.dealer_id',$request->dealer_id)
                        ->where('products.category_id',$request->category_id)
                        ->where('products.type', 'like','%New%')
                        //->where('products.status','In Stock')
                        ->groupBy('products.title')
                        ->orderBy('products.order_no')
                        ->get();
        }

        $data = [];
        foreach ($products as $key => $product) {
            $in_stock = Product::where('title',$product->title)
                                ->count();
            
            $data[] = [
                'product_id' => $product->id,
                'product_title' => $product->title,
                'product_description' => strip_tags($product->description),
                'product_price' => $product->price,
                'product_model' => $product->model,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'dealer_id' => $product->dealer_id,
                'dealer_name' => $product->dealer_name,
                'title' => $product->title,
                'serial_number' => $product->stock_number,
                'type' => $product->type,
                'in_stock' => $in_stock,
                'Backorder_Stock'=>$product->upcoming_quantity,
                'upcoming_quantity' => $product->upcoming_quantity,
                'date' => $product->date,
				'attachment' => $product->attachment,
                'Video' => $product->video_file,
                'insurance' => $product->insurance,
                'ce_cert' => $product->ce_cert,
                'productpdf_url' => $product->pdf_url,
                'images' => $this->getProductImages($product->id),
               // 'attachment' => url('/public/admin/clip-one/assets/products/attachment/').'/'.$product->attachment,
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                        'video_path' => url('/public/admin/clip-one/assets/products/video_file/'),
                        'insurance' => url('/public/admin/clip-one/assets/products/insurance/'),
                        'ce_cert' => url('/public/admin/clip-one/assets/products/ce_cert/'),
                        'imgpdf_path' => url('/public/uploads/'),
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


     /*categories by dealer id (new)*/
  public function categoriesByDealer(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'dealer_id' => 'required'
      ]);
     
      if ($validator->fails()) {
          return response()->json(array(
                                      'status' => 400,
                                      'message'=> 'Error',
                                      'error_message'=>$validator->errors()
                                  ),200);
      }

      $data = Category::select('categories.*', 'categories.name as category_name', 
      'dealers.name as dealer_name')   
      ->leftjoin('dealers','categories.dealer_id','=','dealers.id')
      ->where('categories.dealer_id',$request->dealer_id)

      ->get();

    //   print_r($data);
    //   die();
     

      if (count($data)>0) {
          return response()->json(array(
                      'status' => 200,
                      'message'=> 'Success',
                      'success_message'=>'Data found.',
                      'image_path' => url('/public/admin/clip-one/assets/categories/thumbnail/'),
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
     //=================================================================

    //=================================================================

    /*Used Equipments (In stock)*/
    public function usedEquipments(Request $request)
    {
        if (!empty($request->search) || !empty($request->dealer_id) || !empty($request->model)) {

            // echo "<pre>";
            // print_r($request->search);die;

            $query = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id');

            if (!empty($request->search)) {
                $search = $request->search;
                $query = $query->where('products.title','LIKE','%'.$search.'%');
            }
            if (!empty($request->dealer_id)) {
                $dealer_id = $request->dealer_id;
                $query = $query->where('products.dealer_id',$dealer_id);
            }
            if (!empty($request->model)) {
                $model = $request->model;
                $query = $query->where('products.model',$model);
            }
                        
            $products = $query->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                            ->where('products.type','Used')
                            ->get();
        }else{
            $products = Product::join('dealers','products.dealer_id','=','dealers.id')
                            ->join('categories','products.category_id','=','categories.id')
                            ->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                            ->where('products.type','Used')
                            ->get();
        }

        $data = [];
        foreach ($products as $key => $product) {
            if(count($this->getProductImages($product->id))>0){
                $product_image = $this->getProductImages($product->id)[0]->image;
            }else{
                $product_image = '';
            }
            
            $data[] = [
                'product_id' => $product->id,   
                'category_name' => $product->category_name,
                'dealer_name' => $product->dealer_name,
                'dealer_id' => $product->dealer_id,
                'date' => $product->date,
                'title' => $product->title,
                'serial_number' => $product->stock_number,
                'model' => $product->model,
                'year' => $product->year,
                'description' => AdminHelper::removeHtmlTags($product->description),
                'price' => $product->price,
                'type' => $product->type,
                'attachment' => $product->attachment,
                'status' => $product->status,
                'product_image' => $product_image,
                'images' => $this->getProductImages($product->id),
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
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

    //=================================================================

    /*Used Equipments (Coming Soon)*/
    public function comingSoonEquipments(Request $request)
    {
        if (!empty($request->search) || !empty($request->dealer_id) || !empty($request->model)) {

            // echo "<pre>";
            // print_r($request->search);die;

            $query = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id');

            if (!empty($request->search)) {
                $search = $request->search;
                $query = $query->where('products.title','LIKE','%'.$search.'%');
            }
            if (!empty($request->dealer_id)) {
                $dealer_id = $request->dealer_id;
                $query = $query->where('products.dealer_id',$dealer_id);
            }
            if (!empty($request->model)) {
                $model = $request->model;
                $query = $query->where('products.model',$model);
            }
                        
            $products = $query->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                            //->where('products.type','Used')
                           // ->where('products.status','Coming Soon')
                            ->where('products.type','trade')
                            ->get();
        }else{
            $products = Product::join('dealers','products.dealer_id','=','dealers.id')
                            ->join('categories','products.category_id','=','categories.id')
                            ->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                            //->where('products.type','Used')
                            //->where('products.status','Coming Soon')
                            ->where('products.type','trade')
                            ->get();
        }

        $data = [];
        foreach ($products as $key => $product) {
            if(count($this->getProductImages($product->id))>0){
                $product_image = $this->getProductImages($product->id)[0]->image;
            }else{
                $product_image = '';
            }
            
            $data[] = [
                'product_id' => $product->id,
                'title' => $product->title,
                'model' => $product->model,
                'year' => $product->year,
                'description' => AdminHelper::removeHtmlTags($product->description),
                'date' => $product->date,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'dealer_id' => $product->dealer_id,
                'dealer_name' => $product->dealer_name,
                'price' => $product->price,
                'type' => $product->type,
                'attachment' => $product->attachment,
                'status' => $product->status,
                'product_image' => $product_image,
                'images' => $this->getProductImages($product->id),
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                        'video_path' => url('/public/admin/clip-one/assets/products/video_file/'),
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

    public function getProductImages($id)
    {
        $data = ProductImage::where('product_id',$id)->get();

        if (count($data)>0) {
            return $data;
        }else{
            return [];
        }
    }

    //=================================================================

    /*Categories*/
    public function categories(Request $request)
    {
        $data = Category::select('id','name')->get();

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


    //=================================================================

    /*Upload Machinery*/
   public function uploadMachine(Request $request)
    {
        try {
        // print_r($request->all());
        // die();
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'dealer_id' => 'required',
            'stock_number' => 'required',
            'backorder_number' => 'required',
            'date' => 'required',
            'title' => 'required',
            'model' => 'required',
            'year' => 'required',
            'hours' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'status' => 'required',
            'image' => 'required',
            // 'image.*' => 'mimes:jpeg,jpg,png,gif',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                    'status' => 400,
                                    'message'=> 'Error',
                                    'error_message'=>$validator->errors()
                                ),200);
        } else {
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
            //=========================================================
            $maxOrder = Product::max('order_no');
            $data = new Product;
            $data->category_id = $request->category_id;
            $data->dealer_id = $request->dealer_id;
            $data->stock_number = $request->stock_number;
            $data->backorder_number = $request->backorder_number;
            $data->date = date('Y-m-d',strtotime($request->date));
            $data->title = $request->title;
            $data->model = $request->model;
            $data->year = $request->year;
	        $data->hours = $request->hours;
            $data->price = $request->price;
            $data->type = 'trade';
            $data->description = $request->description;
            $data->attachment = $attachment_imagename;
            $data->upcoming_quantity = $request->upcoming_quantity != '' ? $request->upcoming_quantity : '0';
            $data->status = $request->status;
            $data->order_no = $maxOrder + 1;
            $data->save();
            if ($data->save()) {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imagename = rand('1111', '9999') . '.' . time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/admin/clip-one/assets/products/thumbnail');
                    $image->move($destinationPath, $imagename);

                    $source_url = public_path() . '/admin/clip-one/assets/products/thumbnail/' . $imagename;
                    $destination_url = public_path() . '/admin/clip-one/assets/products/original/' . $imagename;
                    $quality = 40;

                    AdminHelper::compress_image($source_url, $destination_url, $quality);

                    $product_image = new ProductImage;
                    $product_image->product_id = $data->id;
                    $product_image->image = $imagename;
                    $product_image->save();
                }
            }
		
            return response()->json(array(
                            'status' => 200,
                            'message'=> 'Success',
                            'success_message'=>'Machine uploaded successfuly.',
                            'image_path' => url('/admin/clip-one/assets/products/original/'),
                            'attachment_path' => url('/admin/clip-one/assets/products/attachment/'),
                            'data' => $data,
                        ),200);
                        
        }
    }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    //=============================================================================

    /*Product Details*/
    public function productDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                    'status' => 400,
                                    'message'=> 'Error',
                                    'error_message'=>$validator->errors()
                                ),200);
        }

        $product = Product::join('dealers','products.dealer_id','=','dealers.id')
                            ->join('categories','products.category_id','=','categories.id')
                            ->select('products.*','dealers.name as dealer_name','categories.name as category_name')
                            ->where('products.id',$request->id)
                            ->first();

        $data = [];
        if (!empty($product)) {
            if(count($this->getProductImages($product->id))>0){
                $product_image = $this->getProductImages($product->id)[0]->image;
            }else{
                $product_image = '';
            }
            
            $data[] = [
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'dealer_id' => $product->dealer_id,
                'price' => $product->price,
                'type' => $product->type,
                'attachment' => $product->attachment,
                'status' => $product->status,
                'product_image' => $product_image,
                'images' => $this->getProductImages($product->id),
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
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
    
    /*Product Images*/
    public function productImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(array(
                                    'status' => 400,
                                    'message'=> 'Error',
                                    'error_message'=>$validator->errors()
                                ),200);
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
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
      /*Upload Tradein*/
   public function uploadTradeIn(Request $request)
  {
      try {
      $validator = Validator::make($request->all(), [
         // 'quote_id' => 'required',
          'product_id' => 'required',
          'category_id' => 'required',
          'dealer_id' => 'required',
          'backorder_number' => 'required',
          'date' => 'required',
          'title' => 'required',
          'model' => 'required',
          'year' => 'required',
          'hours' => 'required',
          'weight' => 'required',
          'price' => 'required',
          //'status' => 'required',
          //'image' => 'required',
          // 'image.*' => 'mimes:jpeg,jpg,png,gif',
      ]);
      if ($validator->fails()) { 
          return response()->json(array(
                                  'status' => 400,
                                  'message'=> 'Error',
                                  'error_message'=>$validator->errors()
                              ),200);
      } else {
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
          //=========================================================
          $maxOrder = Product::max('order_no');
          $data = new Product;
          $data->category_id = $request->category_id;
          $data->dealer_id = $request->dealer_id;
          $data->stock_number = 0;
          $data->backorder_number = $request->backorder_number;
          $data->date = date('Y-m-d',strtotime($request->date));
          $data->title = $request->make;
          $data->model = $request->model;
          $data->year = $request->year;
          $data->hours = $request->hours;
          $data->price = $request->price;
          $data->type = 'Trade';
          $data->description = $request->description;
          $data->attachment = $attachment_imagename;
          $data->upcoming_quantity = $request->upcoming_quantity != '' ? $request->upcoming_quantity : '0';
          $data->status = 'Sold';
          $data->order_no = $maxOrder + 1;
          $data->save();
          if ($data->save()) {

         if ($request->quote_id == 0) {
            $idtrd = DB::table('trade_ins')->where('sales_orders_id',$request->sales_orders_id)->where('old_product_id',$request->product_id)->first();
            if (empty($idtrd)) {
                $newTrade = new TradeIn;  
                $newTrade->sales_orders_id = $request->sales_orders_id;
                $newTrade->old_product_id = $request->product_id;
                $newTrade->product_id = $data->id;
                $newTrade->model = $request->model;
                $newTrade->year = $request->year;
                $newTrade->hours = $request->hours;
                $newTrade->make = $request->make;
                $newTrade->price = $request->price;
                $newTrade->save();
                  
                  return response()->json(array(
                      'status' => 200,
                      'message'=> 'Success',
                      'success_message'=>'trade in Inserted successfully.',
                      'data' => $data,
                  ),200); 
              } 
              else {
                DB::table('trade_ins')->where('sales_orders_id', $request->sales_orders_id)->where('old_product_id', $request->product_id)
                ->update(array( 
                    'product_id' => $data->id,
                    'make' =>  $request->make,
                    'model' => $request->model,
                    'year' => $request->year,
                    'hours' => $request->hours,
                    'price' => $request->price
                ));
                  
                  return response()->json(array(
                      'status' => 200,
                      'message'=> 'Success',
                      'success_message'=>'trade in Update successfully.',
                      'data' => $data,
                  ),200);
              }
         }
else{
    $idtrd = DB::table('trade_ins')->where('quote_id',$request->quote_id)->where('old_product_id',$request->product_id)->first();
            if (empty($idtrd)) {
                $newTrade = new TradeIn;  
                $newTrade->quote_id = $request->quote_id;
                $newTrade->old_product_id = $request->product_id;
                $newTrade->product_id = $data->id;
                $newTrade->model = $request->model;
                $newTrade->year = $request->year;
                $newTrade->hours = $request->hours;
                $newTrade->make = $request->make;
                $newTrade->price = $request->price;
                $newTrade->save();
                  
                  return response()->json(array(
                      'status' => 200,
                      'message'=> 'Success',
                      'success_message'=>'trade in Inserted successfully.',
                      'data' => $data,
                  ),200); 
              } 
              else {
                DB::table('trade_ins')->where('quote_id', $request->quote_id)->where('old_product_id', $request->product_id)
                ->update(array( 
                    'product_id' => $data->id,
                    'make' =>  $request->make,
                    'model' => $request->model,
                    'year' => $request->year,
                    'hours' => $request->hours,
                    'price' => $request->price
                ));
                  
                  return response()->json(array(
                      'status' => 200,
                      'message'=> 'Success',
                      'success_message'=>'trade in Update successfully.',
                      'data' => $data,
                  ),200);
              }
        }
}
          
          
          return response()->json(array(
                          'status' => 200,
                          'message'=> 'Success',
                          'success_message'=>'Machine uploaded successfuly.',
                          'image_path' => url('/admin/clip-one/assets/products/original/'),
                          'attachment_path' => url('/admin/clip-one/assets/products/attachment/'),
                          'data' => $data,
                      ),200);
                      
      
    }
  }
      catch (\Exception $e) {
          return $e->getMessage();
      }
  }

   //=================================================================

    /*Hire Machine (new)*/
    public function hiresByDealer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dealer_id' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                                        'status' => 400,
                                        'message'=> 'Error',
                                        'error_message'=>$validator->errors()
                                    ),200);
        }
    
            if (!empty($request->search)) {
            $products = Product::join('dealers','products.dealer_id','=','dealers.id')

                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.id','products.category_id','products.price','products.dealer_id','products.title',
                        'products.video_file','products.insurance','products.ce_cert','products.type','products.order_no','products.upcoming_quantity','products.date',
                        'dealers.name as dealer_name','categories.name as category_name','products.status','products.attachment',
                        'products.stock_number','products.backorder_number','products.pdf_url','products.year','products.hours')
                        ->where('products.dealer_id',$request->dealer_id)
                        ->where('products.category_id',$request->category_id)
                        ->where('products.type', 'like','%Hire%')
                       // ->where('products.type','New')
                        //->where('products.status','In Stock')
                        ->groupBy('products.title')
                        ->orderBy('products.order_no')
                        ->get();
        }else{
            $products = Product::join('dealers','products.dealer_id','=','dealers.id')
                        ->join('categories','products.category_id','=','categories.id')
                        ->select('products.id','products.category_id','products.price','products.dealer_id','products.title',
                        'products.video_file','products.insurance','products.ce_cert','products.description','products.type','products.order_no',
                        'products.upcoming_quantity','products.date','dealers.name as dealer_name',
                        'categories.name as category_name','products.status','products.attachment',
                        'products.stock_number','products.backorder_number','products.pdf_url','products.year','products.hours')
                        ->where('products.dealer_id',$request->dealer_id)
                        ->where('products.category_id',$request->category_id)
                        ->where('products.type', 'like','%Hire%')
                        //->where('products.status','In Stock')
                        ->groupBy('products.title')
                        ->orderBy('products.order_no')
                        ->get();
        }

        $data = [];
        foreach ($products as $key => $product) {
            $in_stock = Product::where('title',$product->title)
                                ->count();
            
            $data[] = [
                'product_id' => $product->id,
                'product_title' => $product->title,
                'product_description' => strip_tags($product->description),
                'product_price' => $product->price,
                'product_model' => $product->model,
                'category_id' => $product->category_id,
                'category_name' => $product->category_name,
                'dealer_id' => $product->dealer_id,
                'dealer_name' => $product->dealer_name,
                'title' => $product->title,
                'year' => $product->year,
                'hours' => $product->hours,
                'serial_number' => $product->stock_number,
                'type' => $product->type,
                'in_stock' => $in_stock,
                'Backorder_Stock'=>$product->upcoming_quantity,
                'upcoming_quantity' => $product->upcoming_quantity,
                'date' => $product->date,
				'attachment' => $product->attachment,
                'Video' => $product->video_file,
                'insurance' => $product->insurance,
                'ce_cert' => $product->ce_cert,
                'productpdf_url' => $product->pdf_url,
                'images' => $this->getProductImages($product->id),
               // 'attachment' => url('/public/admin/clip-one/assets/products/attachment/').'/'.$product->attachment,
            ];
        }

        if (count($data)>0) {
            return response()->json(array(
                        'status' => 200,
                        'message'=> 'Success',
                        'success_message'=>'Data found.',
                        'image_path' => url('/public/admin/clip-one/assets/products/original/'),
                        'attachment_path' => url('/public/admin/clip-one/assets/products/attachment/'),
                        'video_path' => url('/public/admin/clip-one/assets/products/video_file/'),
                        'insurance' => url('/public/admin/clip-one/assets/products/insurance/'),
                        'ce_cert' => url('/public/admin/clip-one/assets/products/ce_cert/'),
                        'imgpdf_path' => url('/public/uploads/'),
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
  //=============================================================================

}

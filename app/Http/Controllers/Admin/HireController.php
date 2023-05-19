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
use App\Models\Dealer;
use App\Models\Hire;
use App\Models\HireImage;
use App\Models\Action;
use App\Models\Role;
use App\Models\AdminPermission;
use App\DataTables\HireDataTable;
use App\Helpers\AdminHelper;

class HireController extends Controller
{
    //=================================================================

   public function index(Request $request)
   {
      $data = [];
      //==============================================
      $status_action = Action::where('action_slug','status')->first();
        $data['checkStatusAction'] = Role::where('name_slug','hires')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','hires')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================

      $data['categories'] = Category::get();
      $data['dealers'] = Dealer::get();

      if (!empty($request->category_id) || !empty($request->dealer_id) || !empty($request->status)  || !empty($request->stock_number) || !empty($request->backorder_number)  || !empty($request->model) || !empty($request->title)) {

         $query = Hire::select('*');

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
         $query = Hire::select('*');
      }

        $data['results'] = $query->orderBy('order_no')->orderBy('title')->where('type','!=', 'Trade')->groupBy('title')->get();

      return view('admin/hires/index',$data);
   }

   //=================================================================

public function instock(Request $request)
   {
      $data = [];
      //==============================================
      $status_action = Action::where('action_slug','status')->first();
        $data['checkStatusAction'] = Role::where('name_slug','hires')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','hires')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================

      $data['categories'] = Category::get();
      $data['dealers'] = Dealer::get();

      if (!empty($request->category_id) || !empty($request->dealer_id) || !empty($request->status)  || !empty($request->stock_number) || !empty($request->backorder_number)  || !empty($request->model) || !empty($request->title)) {

         $query = Hire::select('*');

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
         $query = Hire::select('*');
      }

        $data['results'] = $query->orderBy('order_no')->orderBy('title')->where('type','!=', 'Trade')->where('status','!=', 'Sold')->get();

      return view('admin/hires/instock',$data);
   }
   //=================================================================

   public function add()
   {
      $data = array();
      $data['categories'] = Category::get();
      $data['dealers'] = Dealer::get();

      return view('admin/hires/add',$data);
   }

   //=================================================================

   public function save(Request $request)
   {
      try {
         $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'dealer_id' => 'required',
            'stock_number' => 'required|unique:hires,stock_number',
            'backorder_number' => 'required',
            'date' => 'required',
            'title' => 'required',
            'model' => 'required',
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
               return redirect('admin/hires/add')
                           ->withErrors($validator)
                           ->withInput();
         } else {
               
            $attachment = $request->file('attachment');
            //=========================================================
            /*attachment*/
            if(!empty($attachment)) {
               $attachment_imagename = $attachment->getClientOriginalName();
               $destinationPath = public_path('/admin/clip-one/assets/hires/attachment');
                 $attachment->move($destinationPath, $attachment_imagename);
            } else {
               $attachment_imagename = '';
            }
                  
              //=========================================================
            foreach ($request->stock_number as $key => $stock_number) {
               $maxOrder = Hire::max('order_no');

               $data = new Hire;
                 $data->category_id = $request->category_id;
                 $data->dealer_id = $request->dealer_id;
                 $data->stock_number = $stock_number;
                 $data->backorder_number = $request->backorder_number;
                 $data->title = $request->title;
                 $data->model = $request->model;
                 $data->year = $request->year;
                 $data->hours = $request->hours;
                 $data->weight = $request->weight;
                 $data->description = $request->description;
                 $data->price = $request->price;
                 $data->type = $request->type;
                 $data->attachment = $attachment_imagename;
                 $data->status = $request->status;
                 $data->upcoming_quantity = $request->upcoming_quantity != '' ? $request->upcoming_quantity : '0';
                 $data->date = date('Y-m-d',strtotime($request->date));
                 $data->order_no = $maxOrder + 1;
                 $data->save();

                 $images = $request->file('image');
               foreach ($images as $key1 => $image) {
                  $imagename = rand('1111','9999').'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/admin/clip-one/assets/hires/thumbnail');
                    
                    $img = Image::make($image->getRealPath());

                    $img->resize(100, 100, function ($constraint) {
                      $constraint->aspectRatio();
                  })->save($destinationPath.'/'.$imagename);

                  $destinationPath = public_path('/admin/clip-one/assets/hires/original').'/';
                    File::copy($image, $destinationPath.$imagename);

                    // $source_url = public_path().'/admin/clip-one/assets/hires/original/'.$imagename;
                  // $destination_url = public_path().'/admin/clip-one/assets/hires/original/'.$imagename;
                  // $quality = 40;
                  // AdminHelper::compress_image($source_url, $destination_url, $quality);

                  $hire_image = new HireImage;
                  $hire_image->hire_id = $data->id;
                  $hire_image->image = $imagename;
                  $hire_image->save();

                  // echo "<pre>";
                  // print_r($hire_image);
               }
            }
            //die;

            session()->flash('message', 'Hire added successfully');
            Session::flash('alert-type', 'success'); 
            return redirect('admin/hires/index');
         }
      } catch (\Exception $e) {
           Log::error($e->getMessage());
           session()->flash('message', 'Some error occured during save Hire');
            Session::flash('alert-type', 'error');
            return redirect('admin/hires/add');
        }
   }

   //=================================================================

   public function edit($id)
   {
      $data = array();
      $data['result'] = Hire::find($id);
      $data['HireImages'] = HireImage::where('Hire_id',$id)->get();
      $data['categories'] = Category::get();
      $data['dealers'] = Dealer::get();
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

      return view('admin/hires/edit',$data);
   }

   //=================================================================

   public function update(Request $request)
   {
      try {
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
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'status' => 'required',
         ]);
         if ($validator->fails()) { 
               return redirect('admin/hires/edit'.'/'.$request->id)
                           ->withErrors($validator)
                           ->withInput();
         } else {

              $data = Hire::find($request->id);
            /*attachment*/
            $attachment = $request->file('attachment');

            if(!empty($attachment)) {
               $file1 = public_path().'/admin/clip-one/assets/hires/attachment/'.$data->attachment;
               File::delete($file1);

               $attachment_imagename = $attachment->getClientOriginalName();
               $destinationPath = public_path('/admin/clip-one/assets/hires/attachment');
                 $attachment->move($destinationPath, $attachment_imagename);
            } else {
               $attachment_imagename = $data->attachment;
            }
               
              //=========================================================
              $data->category_id = $request->category_id;
              $data->dealer_id = $request->dealer_id;
              $data->stock_number = $request->stock_number;
              $data->backorder_number = $request->backorder_number;
              $data->title = $request->title;
              $data->model = $request->model;
              $data->year = $request->year;
              $data->hours = $request->hours;
              $data->weight = $request->weight;
              $data->description = $request->description;
              $data->price = $request->price;
              $data->type = $request->type;
              $data->attachment = $attachment_imagename;
              $data->status = $request->status;
              $data->upcoming_quantity = $request->upcoming_quantity != '' ? $request->upcoming_quantity : '0';
              $data->date = date('Y-m-d',strtotime($request->date));
              $data->save();

              $images = $request->file('image');
              if (!empty($images)) {
               foreach ($images as $key => $image) {
                  $imagename = rand('1111','9999').'_'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/admin/clip-one/assets/hires/thumbnail');
                    
                    $img = Image::make($image->getRealPath());

                    $img->resize(100, 100, function ($constraint) {
                      $constraint->aspectRatio();
                  })->save($destinationPath.'/'.$imagename);

                  $destinationPath = public_path('/admin/clip-one/assets/hires/original');
                    $image->move($destinationPath, $imagename);

                    $source_url = public_path().'/admin/clip-one/assets/hires/original/'.$imagename;
                  $destination_url = public_path().'/admin/clip-one/assets/hires/original/'.$imagename;
                  $quality = 40;

                  AdminHelper::compress_image($source_url, $destination_url, $quality);

                  $hire_image = new HireImage;
                  $hire_image->Hire_id = $data->id;
                  $hire_image->image = $imagename;
                  $hire_image->save();
               }
              }

            session()->flash('message', 'Hire updated successfully');
            Session::flash('alert-type', 'success'); 
            return redirect('admin/hires/index');
         }
      } catch (\Exception $e) {
           Log::error($e->getMessage());
           session()->flash('message', 'Some error occured during update Hire');
            Session::flash('alert-type', 'error');
            return redirect('admin/hires/edit'.'/'.$request->id);
        }
   }

   //=================================================================

   public function delete($id){
      
      try {
         $data = Hire::find($id);
         $images = HireImage::where('Hire_id',$id)->get();

         $file = public_path().'/admin/clip-one/assets/hires/attachment/'.$data->attachment;
         File::delete($file);

         foreach ($images as $key => $value) {
            $file1 = public_path().'/admin/clip-one/assets/hires/original/'.$value->image;
            $file2 = public_path().'/admin/clip-one/assets/hires/thumbnail/'.$value->image;
            File::delete($file1,$file2);
         }

         Hire::where('id',$id)->delete();
         HireImage::where('Hire_id',$id)->delete();
      
         session()->flash('message', 'Hire deleted successfully');
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
           return redirect('admin/hires/index');
       } catch (\Exception $e) {
            Log::error($e->getMessage());
          session()->flash('message', 'Some error occured during status update');
            Session::flash('alert-type', 'error');
          return redirect('admin/hires/index');
        }
    }

    //===================================================

    public function imageDelete($id){
      
      try {
         $data = HireImage::find($id);

         $file1 = public_path().'/admin/clip-one/assets/hires/thumbnail/'.$data->image;
         $file2 = public_path().'/admin/clip-one/assets/hires/original/'.$data->image;
         File::delete($file1, $file2);

         $delete = HireImage::where('id',$id)->delete();
      
         return response()->json(['msg'=>'success']);
       } catch (\Exception $e) {
            Log::error($e->getMessage());
          return response()->json(['msg'=>'error']);
        }
    }

    //===================================================

    public function sorthires(Request $request)
   {
      $tasks = Hire::all();
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
            'stock_number' => 'required|unique:hires,stock_number',
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
         $oldData = Hire::where('id',$request->id)->first();

         foreach ($request->stock_number as $key => $stock_number) {
            $maxOrder = Hire::max('order_no');

            $data = new Hire;
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

              $images = HireImage::where('Hire_id',$request->id)->get();
            foreach ($images as $key1 => $image) {
               $hire_image = new HireImage;
               $hire_image->Hire_id = $data->id;
               $hire_image->image = $image->image;
               $hire_image->save();
            }
         }

         session()->flash('message', 'Hire added successfully');
         Session::flash('alert-type', 'success'); 
         return back();
         }
      } catch (\Exception $e) {
           Log::error($e->getMessage());
           session()->flash('message', 'Some error occured during save Hire');
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
        $data['checkStatusAction'] = Role::where('name_slug','hires')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $data['roles'] = Role::where('name_slug','hires')->first();
        $data['checkStatusPermission'] = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();
        $data['action_ids'] = explode(',', $data['roles']->action_id);
        //==============================================

      $data['categories'] = Category::get();
      $data['dealers'] = Dealer::get();

      if (!empty($request->category_id) || !empty($request->dealer_id) || !empty($request->status)  || !empty($request->stock_number) || !empty($request->model) || !empty($request->title)) {

         $query = Hire::select('*');

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
         $query = Hire::select('*');
      }

        $data['results'] = $query->orderBy('order_no')->orderBy('title')->where('hires.type','Trade')->get();

      return view('admin/hires/usedEquipments',$data);
   }
}

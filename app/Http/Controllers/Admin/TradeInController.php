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
use App\Models\User;
use App\Models\TradeIn;
use App\Models\Product;
use App\Models\QuoteProduct;
use App\Models\Quote;
use App\Models\ExtraProductInfo;
use App\Models\LeadComment;
use App\Models\TradeImage;
use App\Models\Dealer;
use App\Models\Action;
use App\Models\AdminPermission;
use App\DataTables\TradeInDataTable;
use App\Helpers\AdminHelper;

class TradeInController extends Controller
{
    //=================================================================

	public function index(TradeInDataTable $dataTable)
	{
		return $dataTable->render('admin/trade_in/index');
	}

	//=================================================================

    public function view($id)

	{
    	$data['result'] = TradeIn::join('quotes','trade_ins.quote_id','=','quotes.id')
                            ->join('quote_products','quote_products.quote_id','=','quotes.id')
                            ->join('leads','leads.id','=','quotes.lead_id')
		                    ->join('users','users.id','=','leads.user_id')
		                    ->select('trade_ins.*','quotes.lead_id','quotes.attachment','quote_products.product_id as product_id','leads.name as lead_name','leads.email','leads.phone','leads.message as lead_message','leads.status','leads.title as lead_title','users.name as user_name')
		                    ->where('trade_ins.id',$id)
		                    ->first();

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
      


       

    	return view('admin.trade_in.view',$data);
    }
    //===================================================
	public function delete($id){
		try {
			$data = TradeIn::find($id)->delete();
		
			session()->flash('message', 'TradeIn deleted successfully');
			Session::flash('alert-type', 'success');

			return redirect('admin/trade_in/index');
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			session()->flash('message', 'Some error occured');
			Session::flash('alert-type', 'error');

			  return redirect('admin/trade_in/index');
		}
	}
	public function edit($id)
	{   
		$data = array();
		$data['result'] = TradeIn::find($id);
		//print_r($data['result']);die;
		return view('admin/trade_in/edit',$data);
	}
	public function update(Request $request)
	{
		try {
		        $data = TradeIn::find($request->id);
				$data->quote_id = $request->quote_id;
				$data->make = $request->make;
				$data->model = $request->model;
				$data->year = $request->year;
				$data->hours = $request->hours;
		        $data->save();
				
				session()->flash('message', 'Record updated successfully');
				Session::flash('alert-type', 'success'); 
				return redirect('admin/trade_in/index');
			
		} catch (\Exception $e) {
	        Log::error($e->getMessage());
	        session()->flash('message', 'Some error occured during update record');
            Session::flash('alert-type', 'error');
           	return redirect('admin/trade_in/edit'.'/'.$request->id);
        }
	}
}

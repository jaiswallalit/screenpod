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

class SalesOrderReportController extends Controller
{
    //=================================================================

	public function index(SalesOrderReportDataTable $dataTable,Request $request)
	{
		$data = [
            'from' => $request->from,
            'to' => $request->to,
            'customer' => $request->customer,
			'PDI_status' => $request->PDI_status,
            'payment_confirm' => $request->payment_confirm,
            'user_id' => $request->user_id,
		];

		return $dataTable->with('data',$data)->render('admin/sales_order_report/index');
	}

    //===================================================

    public function view($id)
    {
    	$data['result'] = SalesOrder::join('quotes','sales_orders.quote_id','=','quotes.id')
                            ->join('leads','leads.id','=','quotes.lead_id')
                            ->join('users','users.id','=','leads.user_id')
                            ->select('sales_orders.*','quotes.lead_id','quotes.attachment','leads.name as lead_name','leads.email','leads.phone','leads.message as lead_message','leads.status','leads.title as lead_title','users.name as user_name')
                            ->where('sales_orders.id',$id)
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
    	return view('admin.sales_order_report.view',$data);
    }

    //===================Report ================================
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
            $data['results'] = SalesOrder::orderBy('id','DESC')->where('delivered',1)->where('order_status', '1')->paginate(1000);
        }

		return view('admin/sales_order_report/complete_sales',$data);
	}
}

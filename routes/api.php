<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalesOrderController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\HireQuoteController;
use App\Http\Controllers\Api\TradeInController;
use App\Http\Controllers\Api\HireOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/clear-route', function () {
    Artisan::call('route:cache');
    echo '<script>alert("route clear")</script>';
});
Route::get('/me', function () {
    echo "Api is workings";
});
Route::post('login', [UserController::class, 'login'])->name('user.login');
Route::get('userList', [UserController::class, 'usersList'])->name('user.usersList');
 Route::post('/sign-out', [UserController::class, 'logout']);
 Route::post('delete_quotes', [QuoteController::class, 'removeProduct']);

//using middleware
    Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('models', [ProductController::class, 'models'])->name('user.models');
    Route::get('dealerships', [ProductController::class, 'dealerships'])->name('user.dealerships');
    Route::post('products_by_dealer', [ProductController::class, 'productsByDealer'])->name('user.products_by_dealer');
    Route::post('/categories_by_dealer', [ProductController::class, 'categoriesByDealer']);


    //Hire Quote 28date
    Route::post('hires_by_dealer', [ProductController::class, 'hiresByDealer'])->name('user.hires_by_dealer');
    Route::post('/add-hirequote', [HireQuoteController::class, 'createHireQuoteWithNewLead']);
    Route::post('/inProgressHireQuote', [HireQuoteController::class, 'inProgressHireQuote']);
    Route::post('/filterInProgressHireQuote', [HireQuoteController::class, 'filterInProgressHireQuote']);
    Route::post('/previewhirequot', [HireQuoteController::class, 'prvquoteHireDetails']);
    Route::post('/sendpreviewhirequot', [HireQuoteController::class, 'sendPrivewHireQuote']);
    Route::post('/create_contracts', [HireQuoteController::class, 'contracts']);
    Route::post('/hire_info', [HireQuoteController::class, 'HireInformation']);
    Route::post('/hiresend_quote', [HireQuoteController::class, 'sendQuote']);

    Route::post('/hiresentQuote', [QuoteController::class, 'HiresentQuote']);

    //And Hire Quote

    //hire order 19 may//
    Route::post('/create_hire_order', [HireOrderController::class, 'createHireOrder']);
    Route::post('hire_orders', [HireOrderController::class, 'getHireOrders'])->name('user.hire_orders');
    Route::post('/filter_hire_order', [HireOrderController::class, 'filterHireOrder']);
    Route::post('/create_hire', [HireOrderController::class, 'createHire']);
    Route::post('/sendpriviewhireorder', [HireOrderController::class, 'sendpriviewHireorder']);
    Route::post('/privewhireorder', [HireOrderController::class, 'privewHireOrder']);
    Route::post('/refreshpreviewhireorder', [HireOrderController::class, 'refreshPrivewhireOrder']);
    //End hire order 19 may//

    //
   //Sapc sheet Sales orer 11maydate
   Route::post('/specheet', [SalesOrderController::class, 'AdditionalSpec']);
  //And

     //SiteVisis api 28
     Route::post('/createsitevisits', [SiteVisitsController::class, 'createSiteVisits']);
     Route::post('site_visits', [SiteVisitsController::class, 'salesCalls'])->name('user.site_visits');
     Route::post('commentOnsite', [SiteVisitsController::class, 'commentOnSite'])->name('user.commentOnsite');
     Route::post('detail_site_visits', [SiteVisitsController::class, 'detailSiteVisit'])->name('user.detail_site_visits');
     Route::post('site_visit_details', [SiteVisitsController::class, 'siteVisitDetails'])->name('user.site_visit_details');
     Route::post('/searchsitevisits', [SiteVisitsController::class, 'searchSiteVisite']);
     // Route::post('/getcategory', [SiteVisitsController::class, 'getCategory']);
     Route::get('getcategory', [SiteVisitsController::class, 'getCategory'])->name('user.getcategory');
     Route::get('getlocation', [SiteVisitsController::class, 'getLocaton'])->name('user.getlocation');
    //END SiteVisis api 28

    Route::post('/add-quote', [QuoteController::class, 'createQuoteWithNewLead']);
    Route::get('used_equipments', [ProductController::class, 'usedEquipments'])->name('user.used_equipments');
    Route::get('coming_soon_equipments', [ProductController::class, 'comingSoonEquipments'])->name('user.coming_soon_equipments');
    Route::get('categories', [ProductController::class, 'categories'])->name('user.categories');
    Route::get('customers', [LeadController::class, 'getCustomers'])->name('user.customers');
    Route::post('/saveCustomers', [QuoteController::class, 'saveCustomers']);
    Route::post('/saveDealers', [QuoteController::class, 'saveDealers']);
    Route::post('/filter_sales_order', [SalesOrderController::class, 'filterSalesOrder']);
    Route::post('/previewquotemail', [QuoteController::class, 'previewQuoteMail']);
    Route::post('saveinfo', [QuoteController::class, 'saveinfo'])->name('user.saveinfo');
    Route::post('/previewquot', [QuoteController::class, 'prvquoteDetails']);

    Route::post('/sendpreviewquot', [QuoteController::class, 'sendPrivewQuote']);

    Route::post('/filtersendpreviewquot', [QuoteController::class, 'filterPrivewSentQuote']);

    
    Route::post('/send_quote', [QuoteController::class, 'sendQuote']);
    Route::post('upload_machine', [ProductController::class, 'uploadMachine'])->name('user.upload_machine');
    Route::post('sales_calls', [LeadController::class, 'salesCalls'])->name('user.sales_calls');
    Route::post('detail_sales_call', [LeadController::class, 'detailSalesCall'])->name('user.detail_sales_call');
    Route::post('complete_sales_call', [LeadController::class, 'completeSalesCall'])->name('user.complete_sales_call');
    Route::post('sales_orders', [SalesOrderController::class, 'getSalesOrders'])->name('user.sales_orders');
    
    Route::post('/inProgressQuote', [QuoteController::class, 'inProgressQuote']);
    Route::post('/filterInProgressQuote', [QuoteController::class, 'filterInProgressQuote']);
    Route::post('/searchInProgressQuote', [QuoteController::class, 'searchInProgressQuote']);
    Route::post('/sentQuote', [QuoteController::class, 'sentQuote']);
    Route::post('/searchSentQuote', [QuoteController::class, 'searchSentQuote']);
    Route::post('/create_sales_order', [SalesOrderController::class, 'createSalesOrder']);
    Route::post('/create_order', [SalesOrderController::class, 'createOrder']);
    Route::post('/filterSentQuote', [QuoteController::class, 'filterSentQuote']);
    Route::post('/saveTradeIn', [ProductController::class, 'uploadTradeIn']);
    Route::post('sales_call_details', [LeadController::class, 'salesCallDetails'])->name('user.sales_call_details');
    Route::post('commentonlead', [LeadController::class, 'commentOnLead'])->name('user.commentonlead');
    Route::post('/refreshpreviewquot', [QuoteController::class, 'refreshPrivewQuote']);
    Route::post('/sendprivieworder', [SalesOrderController::class, 'sendprivieworder']);
    Route::post('/priveworder', [SalesOrderController::class, 'privewSalesOrder']);
    Route::post('/refreshprevieworder', [SalesOrderController::class, 'refreshPrivewOrder']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



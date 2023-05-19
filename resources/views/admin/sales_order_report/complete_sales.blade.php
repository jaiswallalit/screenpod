@extends('admin.layout.master')
@section('content')
<link rel="stylesheet" href=
"https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
  
     <!-- jQuery library file -->
     <script type="text/javascript" 
     src="https://code.jquery.com/jquery-3.5.1.js">
     </script>
  
      <!-- Datatable plugin JS library file -->
     <script type="text/javascript" src=
"https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
     </script>
<style>
   .cus-check{
    width: 26px;
    height: 26px;
    margin: 0 auto;
    display: block;
   }
</style>

<?php 
   $current_route = \Request::route()->getName();
   $routeArr = explode('.', $current_route);
   $section = $routeArr[0];
   $action = $routeArr[1];

   $data = App\Helpers\AdminHelper::checkAddButtonPermission($section,Auth::user()->id);
   $account_type = Auth::user()->account_type;
   $from = Request::get('from');
   $to = Request::get('to');
   $customer = Request::get('customer');
   $user = Request::get('user');
   $status = Request::get('status');
   $delivered = Request::get('delivered');
   $dealer_id = Request::get('dealer_id');
   $model = Request::get('model');
?>

<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Sales Orders Reports</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Sales Orders Reports</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <!--   <div class="card-header float-right">-->
                  <!--   <a href="{{route('sales_order.add')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Create Sales Order</a>-->
                  <!--</div>-->
                   @if((Auth::user()->user_type == 'admin'))
                  <div class="card-header float-right">
                  <a href="{{route('sales_order.add')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Create Sales Order</a>
                  </div>
               @endif
                  <div class="card-body">
                     <form action="{{route('sales_order.index')}}" method="GET">
                        <div class="row">
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>From:</label>
                                 <input type="text" name="from" class="form-control datepicker clear" value="<?php if(!empty($from)){echo $from; } ?>"  autocomplete="off">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>To:</label>
                                 <input type="text" name="to" class="form-control datepicker clear" value="<?php if(!empty($to)){echo $to; } ?>" autocomplete="off">
                              </div>
                           </div>
                           <div class="col-2">
                              <div class="form-group">
                              <label>Serial Number:</label>
                              <input type="text" name="serial_number" class="form-control clear" placeholder="Serial Number" value="<?php if(!empty($serial_number)){echo $serial_number; } ?>">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>Customer:</label>
                                 <select name="customer" class="select12 form-control clear">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $value)
                                       <option value="{{$value->id}}" <?php if($customer == $value->id){echo "selected";} ?> >{{$value->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                                                      <div class="col-md-2">
                              <div class="form-group">
                                 <label>Sales Rep:</label>
                                 <select name="user" class="select12 form-control clear">
                                    <option value="">Select Sales Rep</option>
                                    @foreach($users as $value)
                                       <option value="{{$value->id}}" <?php if($user == $value->id){echo "selected";} ?> >{{$value->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>Status:</label>
                                 <select name="status" class="select12 form-control clear">
                                    <option value="">Select Status</option>
                                    <option value="Closed" <?php if($status == 'Closed'){echo "selected";} ?>>Closed</option>
                                    <option value="Open" <?php if($status == 'Open'){echo "selected";} ?>>Open</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>Delivery Status:</label>
                                 <select name="delivered" class="select12 form-control clear">
                                    <option value="">Select Delivery Status</option>
                                    <option value="1" <?php if($delivered == '1'){echo "selected";} ?>>Delivered</option>
                                    <option value="0" <?php if($delivered == '0'){echo "selected";} ?>>Not Delivered</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label>Dealers:</label>
                                 <select name="dealer_id" class="select12 form-control clear" id="dealer_id">
                                    <option value="">Select Make</option>
                                    @foreach($dealers as $value)
                                       <option value="{{$value->id}}" <?php if($dealer_id == $value->id){echo "selected";} ?>>{{$value->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                             
                              <div class="form-group">
                                 <label>Model:</label>
                                 <select name="model" class="select12 form-control clear">
                                    <option value="">Select models</option>
                                    @foreach($products as $value)
                                       <option value="{{$value->id}}" <?php if($model == $value->id){echo "selected";} ?> >{{$value->title}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-1">
                              <div class="form-group">
                                 <button type="submit" class="btn btn-info" style="width: 97%;margin-top: 30px;">Search</button>
                              </div>
                           </div>
							   <div class="col-md-1">
                              <div class="form-group">
								<button class='btn btn-danger clearAll'style="width: 97%;margin-top: 30px;">Clear</button>                            
								</div>
								
                           </div>
                           <div class="col-md-1">
                     <div  class="form-group">
                  <button class="btn btn-primary" style="width: 97%;margin-top: 30px;" onClick="printDiv('divToPrint')">Print</button> 
                     </div>
                        </div>
                        </div>
                     </form>

                     <div id="divToPrint" class="table-responsive">
                        <table id="tableID"  class="table table-bordered" >
                           <thead>
                              <tr style="background-color: #ccc;">
                                 <th>Image</th>
                                 <th>Machine</th>
                                 <th>Quantity</th>
                                 <th>Year</th>
                                 <th>Serial#</th>
                                 <th>Date</th>
                                 <th>Sales Rep</th>
                                 <th>Customer</th>
                                 <th>Order#</th>
                                 <th>Depot</th>
                                 <th>Hitch</th>
                                 <th>Buckets</th>
                                 <th>Extra</th>
                                 <th>Delivery Date</th>
                                 <th style="width: 50px;text-align: center;">PAID</th>
                                 <th style="width: 50px;text-align: center;">PDI</th>
                                 <th style="width: 50px;text-align: center;">Delivered</th>
                                 <th>Order Status</th>
                                 <th style="width: 50px;text-align: center;">Action</th>
                              </tr>
                           </thead>
                           
                           @if(count($results)>0)
                           <tbody class="tablecontents" id="tablecontents">
                              <?php $i = 1; ?>
                              @foreach($results as $key => $result)
                              <?php 
                                 $quote = DB::table('quotes')->where('id',$result->quote_id)->first();
                               
                            //   if (!empty($quote)) {
                            //         $lead = DB::table('leads')->where('id',$quote->lead_id)->first();
                            //      }
                               
                               
                            //      if (!empty($result->user_id)) {
                            //   $rep = DB::table('users')->where('id',$result->user_id)->first();
                            //      }
                            //      else{
                            //          echo 'hello';
                            //      }
                            
                            //  if (($result->quote_id != 0)) {
                            //         $lead = DB::table('leads')->where('id',$quote->lead_id)->first();
                            //      }
                                  
                                  if (!empty($result->user_id)) {
                                     $rep = DB::table('users')->where('id',$result->user_id)->first();
                                   }
                                   else{
                                    $rep = DB::table('users')->where('id',$result->user_id)->first();
                                  }
                                 $customer = DB::table('customers')->where('id',$result->customer_id)->first();
                                 
                             
                                 $product = DB::table('products')->where('id',$result->product_id)->first();
                                 
                                 if($result->quote_id == 0){
                                     $product_extra = DB::table('product_extra_info')->where('sales_orders_id',$result->id)->where('product_id',$result->product_id)->first();
                                 }else{
                                     $product_extra = DB::table('product_extra_info')->where('quote_id',$result->quote_id)->where('product_id',$result->product_id)->first();
                                 }
                        


                                 $product_image = DB::table('product_images')->where('product_id',$result->product_id)->first();
                                 
                              ?>
                               <?php 
                             // if (!empty($rep)) {
                              ?>
                              <tr class="row1" id="row1" data-id="{{ $result->id }}">
                                 <td>
                                     <?php
                                       if (!empty($product_image->image)) { ?>
                                      <img src="{{url('/public/admin/clip-one/assets/products/thumbnail').'/'.$product_image->image}}" height="80px" width="80px">
                               <?php  }
                                 else{
                                     echo 'Product Remove';
                                 } ?>
                                 </td>
                                 
                                 <td>
                                       <?php
                                       if (!empty($product->title)) {
                                        echo $product->title;
                                 }
                                 else{
                                     echo 'Machine';
                                 } ?>
                                    </td>
                                 <td>{{$result->qty}}</td>
                                 <td>
                                        <?php
                                       if (!empty($product->year)) {
                                        echo $product->year;
                                 }
                                 else{
                                     echo '';
                                 } ?>
                                     
                                </td>
                                 <td>{{$result->serial_number}}</td>
                                 <td>{{$result->date}}</td>
                              
                                 <td>
                                 
                                        <?php
                                       if (!empty($rep->name)) {
                                        echo $rep->name;
                                 }
                                 else{
                                     echo 'Salesrep';
                                 } ?>
                                 
                                 </td>
                                 <td>
                                 
                                        <?php
                                       if (!empty($customer->name)) {
                                        echo $customer->name;
                                 }
                                 else{
                                     echo 'customer';
                                 } ?>
                                 
                                 </td>
                                 <td>{{$result->id}}</td>
                                 <td>
                                    @if(!empty($product_extra->depot))
                                       {{$product_extra->depot}}
                                    @endif
                                 </td>
                                 <td>
                                    @if(!empty($product_extra->hitch))
                                       {{$product_extra->hitch}}
                                    @endif
                                 </td>
                                 <td>
                                    @if(!empty($product_extra->buckets))
                                       {{$product_extra->buckets}}
                                    @endif
                                 </td>
                                 <td>
                                    @if(!empty($product_extra->extra))
                                       {{$product_extra->extra}}
                                    @endif
                                 </td>
                                 <td>
                                    <?php 
                                    if($result->delivery_date != '0000-00-00' && $result->delivery_date != ''){
                                       echo $result->delivery_date;
                                    }else{
                                       echo "N/A";
                                    }
                                    ?>
                                 </td>
                                 <td>
                                    <div class="icheck-success d-inline">
                                       <input type="checkbox" name="payment_confirm" id="payment_confirm_{{$key}}" class="payment_confirm" value="1" data-id="{{$result->id}}" <?php if($result->payment_confirm == '1'){echo "checked";} ?>>
                                       <label for="payment_confirm_{{$key}}"></label>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="icheck-success d-inline">
                                       <input type="checkbox" name="PDI_status" id="PDI_status_{{$key}}" class="PDI_status" value="1" data-id="{{$result->id}}" <?php if($result->PDI_status == '1'){echo "checked";} ?>>
                                       <label for="PDI_status_{{$key}}"></label>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="icheck-success d-inline">
                                       <input type="checkbox" name="delivered" id="delivered_{{$key}}" class="delivered" value="1" data-id="{{$result->id}}" <?php if($result->delivered == '1'){echo "checked";} ?>>
                                       <label for="delivered_{{$key}}"></label>
                                    </div>
                                 </td>
                                 <td>
                                    <?php if($result->order_status == '1'){ ?>
                                       <a href="{{route('sales_order.status',$result->id)}}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure want to change status?')">Approved</a>
                                    <?php } ?>
                                    <?php if($result->order_status == '0'){ ?>
                                       <a href="{{route('sales_order.status',$result->id)}}" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure want to change status?')">Waitlist</a>
                                    <?php } ?>
                                 </td>
                                <td>@if (!empty($checkPermission) || Auth::user()->user_type == 'admin')
                                       <a href="{{route('sales_order.view', $result->id)}}" class="btn btn-info btn-sm" data-placement="top" data-original-title="View" style="width: 83px;"><i class="fas fa-eye"></i>View</a>
                                          <a class="btn btn-danger" 
                                          
                                          ="return confirm('Are you sure you want to delete order?')" href="{{route('sales_order.delete', $result->id)}}"><i class="fas fa-trash"></i>Delete</a>
                                
                                       @endif</td>
                              </tr>
                            <?php //}  ?>

                              <?php $i++; ?>
                              @endforeach
                           </tbody>
                           @endif
                        </table>
                     </div>

                     <div class="row">
                        <div class="col-lg-12 float-right mt-4">
                           <div class="float-right">
                              {{ $results->links() }}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection

@section('script')
<script>$('.clearAll').on('click', function() {
  $('.clear').val([]);
});</script>
<script>
   $('.select12').select2({
      theme: 'bootstrap4',
   });
</script>

<script>
   $( function() {
      $( ".datepicker" ).datepicker({
         dateFormat: "yy-mm-dd"
      });
   });
</script>

<script>
   $(".payment_confirm").click(function(){
      if($(this).is(":checked")) {
         var payment_confirm = $(this).val();  
      }else{
         var payment_confirm = '0';
      }
      var id = $(this).data('id');
      var type = 'payment_confirm';

      $.ajax({
         url: "{{ url('admin/sales_order/update') }}",
         method: "POST",
         data: {_token: '{{ csrf_token() }}', payment_confirm: payment_confirm, id: id,type: type},
         success: function (response) {
            if(response.status == 'success'){
               toastr.success('Updated successfully.', 'Success');
               setTimeout(function(){ 
                  location.reload();
               }, 2000);
            }else{
               toastr.error('Something went wrong! Try Again', 'Error');
               return false;
            }
         }
      });
   });
   </script>

   <script>
   $('.PDI_status').click(function(){
      if($(this).is(":checked")) {
         var PDI_status = $(this).val();  
      }else{
         var PDI_status = '0';
      }
      var id = $(this).data('id');
      var type = 'PDI_status';

      $.ajax({
         url: "{{ url('admin/sales_order/update') }}",
         method: "POST",
         data: {_token: '{{ csrf_token() }}', PDI_status: PDI_status, id: id,type: type},
         success: function (response) {
            if(response.status == 'success'){
               toastr.success('Updated successfully.', 'Success');
               setTimeout(function(){ 
                  location.reload();
               }, 2000);
            }else{
               toastr.error('Something went wrong! Try Again', 'Error');
               return false;
            }
         }
      });
   });
   </script>

   <script>
   $('.delivered').click(function(){
      if($(this).is(":checked")) {
         var delivered = $(this).val();  
      }else{
         var delivered = '0';
      }
      var id = $(this).data('id');
      var type = 'delivered';

      $.ajax({
         url: "{{ url('admin/sales_order/update') }}",
         method: "POST",
         data: {_token: '{{ csrf_token() }}', delivered: delivered, id: id,type: type},
         success: function (response) {
            if(response.status == 'success'){
               toastr.success('Updated successfully.', 'Success');
               setTimeout(function(){ 
                  location.reload();
               }, 2000);
            }else{
               toastr.error('Something went wrong! Try Again', 'Error');
               return false;
            }
         }
      });
   });
   </script>

   <script>
      var id = $('#dealer_id').val();
      var selected = "<?php echo $model; ?>";

      $.ajax({
         url: "{{ url('admin/sales_order/getModels') }}"+"/"+id+"/"+selected,
         method: "GET",
         success: function (response) {
            //console.log(response); 
            $('#model').html(response);
         }
      });

      $('#dealer_id').on('change',function(){
         var id = $(this).val();

         $.ajax({
            url: "{{ url('admin/sales_order/getModels') }}"+"/"+id,
            method: "GET",
            success: function (response) {
               //console.log(response); 
               $('#model').html(response);
            }
         });
      });
   </script>
  <script>
  function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
 </script>
    <script>
    $(document).ready(function() {
    $('#tableID').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // {
            //     extend: 'excelHtml5',
            //     text : 'Export to CSV',
            //     title: 'Data export'
            // },
            {
                extend: 'csvHtml5',
                text : 'Export',
                title: 'Sales order export'
            }
        ]
    } );
} );
</script>

@endsection
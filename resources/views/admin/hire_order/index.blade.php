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
   button.btn.order_yes {
    background: #fecf00;
    padding: 4px 25px;
    font-size: 16px !important;
    font-weight: 600;
    border-radius: 15px;
    margin-top: 30px;
    margin-right: 10px;
}
#order_completed .modal-content {
    background-color: #e9e9e9;
    border-radius: 25px;
    border: 2px solid #000;
    padding: 15%;
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
               <h1 class="m-0 text-dark">Hire Orders</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Hire Orders List</li>
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
                 <?php
                   $order_number = DB::table('sales_orders')->count() +1; 
                  //  print_r($order_number);
                  //  die();
                 ?>
                   @if((Auth::user()->user_type == 'admin'))
                   <div class="card-header float-right">
                  <a href="{{route('hire_order.add')}}" class="btn btn-custom float-right"><i class="fas fa-plus"></i> Create Hire Order</a>
                  </div>
               @endif
                  <div class="card-body">
                     <form action="{{route('hire_order.index')}}" method="GET">
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
                        <table id="tableID" class="table table-bordered" >
                           <thead>
                              <tr style="background-color: #ccc;">
                               <th>Image</th>
                               <th>Customer</th>
                               <th>Machine</th>
                               <th>Hours</th>
                               <th>Years</th>
                               <th>Serial #</th>
                               <th>Price p/month</th>
                              <th>Date Duration</th>
                              <th>Sales Rep</th>
                              <th>Order #</th>
                              <th>Depot</th>
                              <th>Extras</th>
                              <th>Hire Contract </th>
                             
                              <th style="width: 50px;text-align: center;">Insurance</th>
                              <th style="width: 50px;text-align: center;">Deposit</th>
                              <th style="width: 50px;text-align: center;">PDI</th>
                              <th style="width: 50px;text-align: center;">Delivered</th>
                              <th style="width: 50px;text-align: center;">Returned</th>
                              <th style="width: 50px;text-align: center;">Action</th>
                              </tr>
                           </thead>
                          
                           @if(count($results)>0)
                           <tbody class="tablecontents" id="tablecontents">
                              <?php $i = 1; ?>
                              @foreach($results as $key => $result)
                              <?php 
                                 $quote = DB::table('quotes')->where('id',$result->quote_id)->first();
                               
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
                        
                                 $spec_exist = DB::table('spec_sheets')->where('machine_order_number',$result->machine_order_number)->first();
                                 $spec_add = DB::table('spec_additionals')->where('machine_order_number',$result->machine_order_number)->first();

                                 $category = DB::table('categories')->where('id',$product->category_id)->first();
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
                                 <td><?php
                                      if (!empty($customer->name)) {
                                     echo $customer->name;
                                       }
                                       else{
                                          echo 'customer';
                                       } ?>
                                 </td>
                                 <td> <?php
                                       if (!empty($product->title)) {
                                        echo $product->title; }
                                       else{
                                          echo 'Machine';
                                       } ?>
                                 </td>
                                 <td> <?php
                                       if (!empty($product->hours)) {
                                        echo $product->hours; }
                                       else{
                                          echo 'Machine';
                                       } ?>
                                 </td>
                                 <td> <?php
                                       if (!empty($product->year)) {
                                        echo $product->year; }
                                       else{
                                          echo 'Machine';
                                       } ?>
                                 </td>
                                 <td>
                                 {{$result->serial_number}}
                                 </td>
                                 <td>
                                 {{$result->price}}
                                 </td>
                                 
                                 <td> {{$result->date_duration}} </td>
                                
                                 <td> <?php
                                    if (!empty($rep->name)) {
                                       echo $rep->name;
                                       }
                                       else{
                                          echo 'Salesrep';
                                          } ?>
                                 </td>
                                <td> {{$result->order_number}}</td>
                                <td>{{$result->depot}}</td>
                                <td>{{$result->extras}}</td>
                                @if(!empty($result->id))
                                 <td><a href="{{route('hire_order.contract', $result->id)}}" class="" data-placement="top" data-original-title="View" style="width: 83px;">View </a></td>
                                    @endif
                                 
                                  @if($result->insurance == '1')
                                 <td  style="background: #28a745;"></td>
                                 @else
                                 <td style="background: #dc3545;"></td> 
                                 @endif
                                 @if($result->payment_confirm == '1')
                                 <td  style="background: #28a745;"></td>
                                 @else
                                 <td style="background: #dc3545;"></td> 
                                 @endif
                                 @if($result->PDI_status == '1')
                                    <td  style="background: #28a745;"></td>
                                    @else
                                    <td style="background: #dc3545;"></td>
                                 @endif
                           
                                 @if($result->delivered == '1')
                                    <td  style="background: #28a745;"></td>
                                    @else
                                    <td style="background: #dc3545;"></td>
                                    @endif
                                    @if($result->returned == '1')
                                    <td  style="background: #28a745;"></td>
                                    @else
                                    <td style="background: #dc3545;"></td>
                                    @endif
                                       <td>@if (!empty($checkPermission) || Auth::user()->user_type == 'admin')
                                       <a href="{{route('hire_order.view', $result->id)}}" class="btn btn-info btn-sm" data-placement="top" data-original-title="View" style="width: 83px;"><i class="fas fa-eye"></i>View</a>
                                       <!-- <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete order?')" href="{{route('sales_order.delete', $result->id)}}"><i class="fas fa-trash"></i>Delete</a> -->
                                      
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
        <!-- Add Machine Modal -->
        <div class="modal fade" id="order_completed">
            <div class="modal-dialog">
               <div class="modal-content">
                 
                  <form id="quickForm" action="ordercompleted" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="user_id" value="1">
                     <input type="hidden" name="order_number" value="<?php if (!empty($result->order_number)) {echo $result->order_number;} ?>" readonly>
                     
                     <div class="modal-body" style="text-align: center;">
                     <h4 style="text-align: center;" class="modal-title">Sales Order Completed?</h4>
                     <button type="submit" class="btn order_yes">Yes</button>
                     <button type="button" class="btn order_yes" data-dismiss="modal">NO</button>
                        
                                
                           
                               
                     </div>

                  </form>
               </div>
            </div>
         </div>
         </div>  
         <!-- Modal -->
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
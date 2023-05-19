@extends('admin.layout.master')
@section('content')

<style>
   ul.cus-info li:last-child{
      margin: 20px 0 0 0;
      font-size: 30px;
      font-weight: 700;
   }
   ul.custom-last li:last-child{
      font-size: initial;
      font-weight: normal;
   }
   ul.last-ul{
      background-color: #dadada;
   }
   ul.last-ul li:nth-child(even){
      background-color: transparent;
   }
	i.pdfi {
    font-size: 35px;
    color: #ee1410;
}
/* 3may css */
.col-md-6.heading {
    background: #fecf00;
    padding: 25px 0px 5px 20px;
    text-align: center;
    font-weight: 600;
    font-size: 16px;
    line-height: 0;
}

.row.order_number {
    border: 1px solid;
}
.col-md-6.result {
    padding: 25px 0px 5px 20px;
    font-size: 16px;
    line-height: 0;
}
.customer_detail .col-md-6 {
    border-bottom: 1px solid;
}
.row.customer_detail {
    border-top: 1px solid;
    border-left: 1px solid;
    border-right: 1px solid;
}
h4.mainhead {
    margin: 20px 0px;
    font-size: 20px;
    font-weight: 600;
    padding: 0;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
#customers thead {
    background: #fecf00;
}
</style>

<?php 
   $account_type = Auth::user()->account_type;
     if($result->quote_id == 0){
                                     $product_extra = DB::table('product_extra_info')->where('sales_orders_id',$result->id)->where('product_id',$result->product_id)->first();
                                 }else{
                                     $product_extra = DB::table('product_extra_info')->where('quote_id',$result->quote_id)->where('product_id',$result->product_id)->first();
                                 }
                                 
                                  if($result->quote_id == 0){
                                    $tradein = DB::table('trade_ins')->where('sales_orders_id',$result->id)->where('old_product_id',$result->product_id)->first();
                                }else{
                                    $tradein = DB::table('trade_ins')->where('quote_id',$result->quote_id)->where('old_product_id',$result->product_id)->first();
                                }
                                $customer = DB::table('customers')->where('id',$result->customer_id)->first();

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Sales Order Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
      
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
          

              
                  <!-- New Page designe.user-block -->
                  <div class="row order_number">
                        <div class="col-md-6 heading"><p>Sales Order Number</p></div>
                        <div class="col-md-6 result"><p>{{$result->order_number}}</p></div>
                  </div>
                  <div class="row">
                  <h4 class="mainhead">Customer Details</h4>
                  </div>
                  <div class="row customer_detail">
                        <div class="col-md-6 heading"><p>Customer</p></div>
                        <div class="col-md-6 result"><p>{{$result->lead_name}}</p></div>
                        <div class="col-md-6 heading"><p>Address</p></div>
                        <div class="col-md-6 result"><p>{{$result->customers_address}}</p></div>
                        <div class="col-md-6 heading"><p>Phone</p></div>
                        <div class="col-md-6 result"><p>{{$customer->phone}}</p></div>
                        <div class="col-md-6 heading"><p>Email</p></div>
                        <div class="col-md-6 result"><p>{{$customer->email}}</p></div>
                  </div>
                  <div class="row">
                  <h4 class="mainhead">Machine Details</h4>
                  </div>


               <div class="row">
                  <table class="table-condensed table tbale-bordered table-striped" id="customers">
                    <thead>
                      <tr>
                        <th>Machine Order Code</th>
                        <th>Category</th>
                        <th>Machine</th>
                        <th>Mandatory</th>
                       <th>Optional Extras</th>
                       <th>Additional Extras</th>
                       <th>Notes</th>
                        <th>Price</th>
                        <th>Serial Number</th>
                       
                     </tr>
                    </thead>
               @foreach ($machin as  $resultdata)
                <?php
                    
                  $customer = DB::table('customers')->where('id',$resultdata->customer_id)->first();
                  $product = DB::table('products')->where('id',$resultdata->product_id)->first();
                  $category = DB::table('categories')->where('id',$product->category_id)->first();
                 // $costs = SalesOrder::with('Sort')->where('order_number', $sales_order->order_number)->groupBy('order_number')->sum('sales_orders.price','price');
                 
    
                ?>
              <tbody>
                  <tr>
                  <td>{{$resultdata->machine_order_number}}</td>
                  <td>{{$category->name}}</td>
                  <td> <?php if (!empty($product->title)) {
                        echo $product->title;  }
                        else{
                        echo 'Machine'; } ?>
                  </td>
                  <td>{{$result->mandatory}}</td>
            <td>{{$result->optional_extras}}</td>
            <td>{{$result->additional_extras}}</td>
            <td>{{$result->machines_notes}}</td>
                  <td>{{$resultdata->price}}</td>
                  <td><p class="vieweditbtn">{{$resultdata->serial_number}}</p></td>
                
            </tr>
        
            </tbody>
            @endforeach

            </table>
 </div>
                  <!-- /New Page designe.user-block -->
    

                     


               <div class="row">
                  <div class="col-md-12">

                  </div>
               </div>

            </div>
            
          </div>

            <div class="card-footer">
                            <button onclick="goBack()" class="btn btn-primary btn-secondary float-sm-right">Back</button>

            </div>
           </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('script')
<script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script>
function goBack() {
  window.history.back();
}
</script>
<script>

$('#description').summernote({
   height: 300,
   toolbar: [
    ['style', ['style']],
    ['font', ['bold', 'italic', 'underline', 'clear']],
    ['fontname', ['fontname']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    ['help', ['help']]
   ],
});

$(function () {
   $('#quickForm').validate({
      rules: {
         dealer_id: {
            required: true
         },
         model: {
            required: true
         },
         serial_no: {
            required: true
         }
      },
      messages: {
         dealer_id: {
            required: "",
         },
         model: {
            required: "",
         },
         serial_no: {
            required: "",
         }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
         error.addClass('invalid-feedback');
         element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
         $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass('is-invalid');
      }
   });
});
</script>

<script>
   $(document).ready(function(){
      /*Load models by make*/
      $('#dealer_id').on('change',function(){
         var id = $(this).find(':selected').val();

         $.ajax({
            url: "{{ url('admin/sales_order/getMakes') }}"+"/"+id,
            method: "GET",
            success: function (response) {
               //console.log(response); 
               $('#model').html(response);
            }
         });
      });

      $('#model').on('change', function() {
         var id = this.value;
         
         $("#serial_no").html('');
         $.ajax({
            url: "{{ url('admin/sales_order/getSerialNumbers') }}"+"/"+id,
            type: "GET",
            dataType : 'json',
            success: function(result){
               $('#serial_no').html(result);
            }
         });
      });

      /*Submit form for update*/
      $('#submit').on('click',function(){
         //var serial_number = $('#serial_number').val();
         var PDI_status = $('#PDI_status').val();
         var PDI_message = $('#PDI_message').val();
		   var notes = $('#notes').val();
         //new code
         var depot = $('#depot').val();
         var warranty = $('#warranty').val();
         var payment_type = $('#payment_type').val();
         var transport = $('#transport').val();
         var transport_price = $('#transport_price').val();
         var delivery_price = $('#delivery_price').val();

         
         //End new code
         var payment_confirm = $('#payment_confirm').val();
         var delivered = $('#delivered').val();
         var depot = $('#depot').val();
         var hitch = $('#hitch').val();
         var buckets = $('#buckets').val();
         var extra = $('#extra').val();
         var serial_number = $('#serial_number').val();
         var price = $('#price').val();
         var qty = $('#qty').val();
         var id = "<?php echo $result->id; ?>"
         var type = "all";
         
         $.ajax({
            url: "{{ url('admin/sales_order/update') }}",
            method: "POST",
            data: {_token: '{{ csrf_token() }}',
            id: id,
            type: type,
            PDI_status: PDI_status,
            PDI_message: PDI_message,
            notes: notes,
            // new code
            depot: depot,
            warranty: warranty,
            payment_type: payment_type,
            transport: transport,
            transport_price: transport_price,
            delivery_price: delivery_price,
            //End new code
            payment_confirm: payment_confirm,
            delivered: delivered,
            depot:depot,
            hitch:hitch,
            buckets:buckets,
            extra:extra,
            qty: qty,
            serial_number: serial_number,
            price:price},
            success: function (response) {
               if(response.status == 'success'){
                  toastr.success('Updated successfully.', 'Success');
                  setTimeout(function(){ 
                     location.reload();
                  }, 2000);
               }else if (response.status == 'serial_number') {
                   
                   toastr.error('Sorry, This Serial Number Is Already Used By Another Machine.', 'Error');
                  $('#serial_number').focus();
                  return false;
               }
               
               else{
                  toastr.error('Something went wrong! Try Again', 'Error');
                  $('#serial_number').focus();
                  return false;
               }
            }
         });
      });
   });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script>
   $(document).ready(function(){
    
    var multipleCancelButton = new Choices('#serial_number', {
       removeItemButton: true,
       maxItemCount:5,
       searchResultLimit:5,
       renderChoiceLimit:5
     }); 
    
    
});
   </script>
@endsection
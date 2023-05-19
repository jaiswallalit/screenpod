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
              <li class="breadcrumb-item active">Hire Order Details</li>
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
                        <div class="col-md-6 heading"><p>Agreement No</p></div>
                        <div class="col-md-6 result"><p>{{$result->agreement_no}}</p></div>
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
                        <th>Order#</th>
                        <th>Machine</th>
                        <th>Price</th>
                        <th>Serial Number</th>
                        <th>Hire Contract</th>
                     </tr>
                    </thead>
                     @foreach($products as $product)
              <tbody>
                  <tr>
                  <td>{{$result->order_number}}</td>
                  
                  
                  <td> <?php if (!empty($product['title'])) {
                        echo $product['title'];  }
                        else{
                        echo 'Machine'; } ?>
                  </td>
                  <td>{{$result->price}}</td>
                  <td><p class="vieweditbtn">{{$result->serial_number}}</p></td>
                  <td><a href="{{route('hire_order.contract', $result->id)}}" class="" data-placement="top" data-original-title="View" style="width: 83px;">View </a></td>

            </tr>
        
            </tbody>
            @endforeach

            </table>

 </div>
                  <!-- /New Page designe.user-block -->
               <div class="row">
                  <div class="col-md-12">
                     <h4></h4>
                     <div class="post">
                        <!-- /.user-block -->

                        <ul class="cus-info custom-last">
                          
                            <!--  Sales Details -->
                  <div class="row">
                  <h4 class="mainhead">Hire Details</h4>
                  </div>


                  <div class="row">
                  <table class="table-condensed table tbale-bordered table-striped" id="customers">
                    <thead>
                      <tr>
                        <th>Date From - To</th>
                        <th>Duration (weeks)</th>
                        <th>Weekly Price</th>
                        <th>Currency </th>
                        <th>Transport</th>
                        <th>Transport Price</th>
                        <th>Depot</th>
                        <th>Extras</th>
                     </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td><input type="date" name="date_duration" class="form-control" value="{{$result->date_duration}}" id="date_duration"></td>
                        <td><input type="text" name="duration" class="form-control" value="{{$result->duration}}" id="duration"></td>
                        <td>
                     
                        @foreach($products as $key => $product)
                           @if(Auth::user()->user_type != 'admin')
                              {{number_format($product['order_price'],2)}}
                             @else <input type="number" name="price" class="form-control" value="{{$product['price']}}" id="price">
                           @endif
                           @endforeach

                        </td>
                        <td><input type="text" name="currency" class="form-control" value="{{$result->currency}}" id="currency" readonly></td>

                        <td><input type="text" name="transport" class="form-control" value="{{$result->transport}}" id="transport"></td>
                        <td><input type="number" name="transport_price" class="form-control" value="{{$result->transport_price}}" id="transport_price"></td>
                        <td><input type="text" name="depot" class="form-control" value="{{$result->depot}}" id="depot"></td>
                        <td><input type="text" name="extras" class="form-control" value="{{$result->extras}}" id="extras"></td>

                     </tr>
                    </tbody>
                  </table>
                 </div>

 
                 <!-- Add Sales Details -->
                 <!--  Delivery Details -->
                 <div class="row">
                  <h4 class="mainhead">Delivery</h4>
                  </div>
                  <div class="row">
                  <table class="table-condensed table tbale-bordered table-striped" id="customers">
                    <thead>
                      <tr>
                        <th>PDI</th>
                        <th>Deposit</th>
                        
                        <th>Delivered</th>
                        <th>Insurance</th>
                        <th>Returned</th>
                       
                     </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td> <select class="form-control" name="PDI_status" id="PDI_status">
                                    <option value="">Select PDI Status</option>
                                    <option value="1" <?php if($result->PDI_status == '1'){echo "selected";} ?> >Approved</option>
                                    <option value="0" <?php if($result->PDI_status == '0'){echo "selected";} ?> >Defected</option>
                                 </select></td>
                        <td>
                        <select class="form-control" name="payment_confirm" id="payment_confirm">
                                   <option value="">Select Payment Status</option>
                                   <option value="1" <?php if($result->payment_confirm == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->payment_confirm == '0'){echo "selected";} ?> >No</option>
                                </select>
                        </td>
                        
                     <td><select class="form-control" name="delivered" id="delivered">
                     <option value="">Select delivered Status</option>
                                   <option value="1" <?php if($result->delivered == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->delivered == '0'){echo "selected";} ?> >No</option>
                                </select></td>
                                <td><select class="form-control" name="insurance" id="insurance">
                                  <option value="">Select insurance Status</option>
                                   <option value="1" <?php if($result->insurance == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->insurance == '0'){echo "selected";} ?> >No</option>
                                </select></td>
                                <td><select class="form-control" name="returned" id="returned">
                                <option value="">Select returned Status</option>
                                <option value="1" <?php if($result->returned == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->returned == '0'){echo "selected";} ?> >No</option>
                                </select>
                              </td>
                              </tr>

                    </tbody>
                  </table>
                 </div>  

                 <div class="row">
                  <div class="col-md-12">
                  <h4 class="mainhead">Notes</h4>
                  <textarea class="form-control" name="notes" id="notes">{{$result->notes}}</textarea> 
                  </div>
                 </div>
                        </ul>

                        @if(Auth::user()->account_type != 'Service')
                           <ul class="cus-info last-ul">
                              <li><span><strong>Price:</strong></span><span class="cus-message">
                              
                              {{number_format($result->transport_price + $result->delivery_price + $product['price'],2)}}
                              <?php 
                              $all_prices = ($result->transport_price + $result->delivery_price + $product['price']) * ($product['quantity']);
                           //  print_r($all_prices);
                           //  die();
                              ?>
                              </span></li>
                               <li><span><strong>Quantity:</strong></span><span class="cus-message">
                                 <input type="number" name="qty" class="form-control" value="{{$product['quantity']}}" id="qty">
                                 </span></li>
                               
                              <li><span><strong>Sub Total:</strong></span> <span class="cus-message">{{$all_prices}}</span></li>
                              <li><span><strong>VAT(23%):</strong></span> <span class="cus-message">{{number_format($result->tax,2)}}</span></li>
                              <li><span><strong>Total Price:</strong></span> <span class="cus-price">{{$result->currency}}{{number_format($result->total_price,2)}}</span></li>
                           </ul>
                        @endif
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12">

                  </div>
               </div>

            </div>
            
          </div>

            <div class="card-footer">
                            <button onclick="goBack()" class="btn btn-primary btn-secondary float-sm-right">Back</button>

               <!--<a href="{{route('sales_order.index')}}" class="btn btn-primary btn-secondary float-sm-right">Back</a>-->
               <button type="button" id="submit" class="btn btn-primary float-sm-right" style="margin-right: 3px;">Submit</button>
            </div>
           </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
         </div>  
         <!-- Modal -->
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
        $(document).ready(function() {
            /*Load models by make*/
            $('#dealer_id').on('change', function() {
                var id = $(this).find(':selected').val();

                $.ajax({
                    url: "{{ url('admin/sales_order/getProductMakes') }}" + "/" + id,
                    method: "GET",
                    success: function(response) {
                        console.log(response); 
                        $('#product_id').html(response);
                    }
                });
            });

           

        });
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
         
         var PDI_status = $('#PDI_status').val();
         var PDI_message = $('#PDI_message').val();
		   var notes = $('#notes').val();
         //new code
         var depot = $('#depot').val();
         var payment_type = $('#payment_type').val();
         var transport = $('#transport').val();
         var transport_price = $('#transport_price').val();
         var delivery_price = $('#delivery_price').val();
         var payment_confirm = $('#payment_confirm').val();
         var delivered = $('#delivered').val();
         var date_duration = $('#date_duration').val();
         var duration = $('#duration').val();
         var extras = $('#extras').val();
         var insurance = $('#insurance').val();
         var deposit = $('#deposit').val();
         var returned = $('#returned').val();
         var serial_number = $('#serial_number').val();
         var price = $('#price').val();
         var qty = $('#qty').val();
         var id = "<?php echo $result->id; ?>"
         var type = "all";
         
         $.ajax({
            url: "{{ url('admin/hire_order/update') }}",
            method: "POST",
            data: {_token: '{{ csrf_token() }}',
            id: id,
            type: type,
            PDI_status: PDI_status,
            PDI_message: PDI_message,
            notes: notes,
            // new code
            insurance: insurance,
            deposit: deposit,
            returned: returned,
            depot: depot,
            payment_type: payment_type,
            transport: transport,
            transport_price: transport_price,
            delivery_price: delivery_price,
            payment_confirm: payment_confirm,
            delivered: delivered,
            date_duration: date_duration,
            duration: duration,
            extras:extras,
            serial_number: serial_number,
            price:price,
            qty: qty,
            //End new code
            
            // delivered: delivered,
            // buckets:buckets,
           
            
            
            },
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
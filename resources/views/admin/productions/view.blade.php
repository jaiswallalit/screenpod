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
            <h1>Production Planning</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Production Planning</li>
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
                        <div class="col-md-6 heading"><p>Customer Order #</p></div>
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
                        <th>Machine Order #</th>
                        <th>Model</th>
                        <th>Make</th>
                        <th>Serial Number</th>
                     </tr>
                    </thead>
                     @foreach($products as $product)
              <tbody>
                  <tr>
                  <td>{{$result->machine_order_number}}</td>
                  
                  
                  <td> <?php if (!empty($product['title'])) {
                        echo $product['title'];  }
                        else{
                        echo 'Machine'; } ?>
                  </td>
                  <td><input type="text" name="make" class="form-control" value="{{$result->make}}" id="make"></td>
                  <td><p class="vieweditbtn">{{$result->serial_number}}</p></td>

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
                  <div class="row">
                  <table class="table-condensed table tbale-bordered table-striped" id="customers">
                    <thead>
                      <tr>
                        <th>Purchased Sheet Issued</th>
                        <th>Steel Parts Due</th>
                        <th>Parts Due</th>
                        <th>Build Start Week </th>
                        <th>Build Shed</th>
                        <th>Electrics Start Week</th>
                    
                     </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td> <select class="form-control" name="purchased_sheet" id="purchased_sheet">
                                    <option value="">Select Purchased Sheet Issued</option>
                                    <option value="1" <?php if($result->purchased_sheet == '1'){echo "selected";} ?> >Yes</option>
                                    <option value="0" <?php if($result->purchased_sheet == '0'){echo "selected";} ?> >No</option>
                                 </select>
                        </td>                       
                         <td><input type="date" name="steel_parts_due" class="form-control" value="{{$result->steel_parts_due}}" id="steel_parts_due"></td>
                        <td>
                     
                           <input type="date" name="parts_due" class="form-control" id="parts_due" value="{{$result->parts_due}}" placeholder="Parts Due">

                        </td>
                        <td> <input type="date" name="build_start_week" class="form-control" id="build_start_week" value="{{$result->build_start_week}}" placeholder="Build Start Week">
                        </td>

                        <td><input type="text" name="build_shed" class="form-control" id="build_shed" value="{{$result->build_shed}}" placeholder="build shed"></td>
                        <td><input type="date" name="electrics_start_week" class="form-control" value="{{$result->electrics_start_week}}" id="electrics_start_week" placeholder="Electrics Start Week"></td>
                        

                     </tr>
                    </tbody>
                  </table>
                 </div>

 
                 <!-- Add Sales Details -->
                 <!--  Delivery Details -->
                 
                  <div class="row">
                  <table class="table-condensed table tbale-bordered table-striped" id="customers">
                    <thead>
                      <tr>
                        <th>PDI</th>
                        <th>Build Finish Week</th>
                        
                        <th>Machine Ready For Dispatch</th>
                        <th>Machine Dispatched</th>
                        <th>Dispatched Week #</th>
                       <th>Dispatch Date</th>
                     </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td> <select class="form-control" name="PDI_status" id="PDI_status">
                                    <option value="">Select PDI Status</option>
                                    <option value="1" <?php if($result->PDI_status == '1'){echo "selected";} ?> >Approved</option>
                                    <option value="0" <?php if($result->PDI_status == '0'){echo "selected";} ?> >Defected</option>
                                 </select></td>
                        
                     <td><input type="date" name="build_finish_week" class="form-control" value="{{$result->build_finish_week}}" id="build_finish_week" placeholder="build_finish_week"></td>

                                 <td>
                        <select class="form-control" name="ready_for_dispatch" id="ready_for_dispatch">
                                   <option value="">Machine Ready For Dispatch</option>
                                   <option value="1" <?php if($result->ready_for_dispatch == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->ready_for_dispatch == '0'){echo "selected";} ?> >No</option>
                                </select>
                        </td>
                        
                     <td><select class="form-control" name="machine_dispatched" id="machine_dispatched">
                                   <option value="">Machine Dispatched</option>
                                   <option value="1" <?php if($result->machine_dispatched == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->machine_dispatched == '0'){echo "selected";} ?> >No</option>
                                </select></td>
                      <td><input type="date" name="dispatched_week" class="form-control" value="{{$result->dispatched_week}}" id="dispatched_week" placeholder="dispatched week">
                         </td>
                         <td><input type="date" name="dispatch_date" class="form-control" value="{{$result->dispatch_date}}" id="dispatch_date" placeholder="dispatch_date">
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
         //var PDI_message = $('#PDI_message').val();
		   var notes = $('#notes').val();
         //new code
         var make = $('#make').val();
         var purchased_sheet = $('#purchased_sheet').val();
         var steel_parts_due = $('#steel_parts_due').val();
         var parts_due = $('#parts_due').val();
         var build_start_week = $('#build_start_week').val();
         var build_shed = $('#build_shed').val();
         var electrics_start_week = $('#electrics_start_week').val();
         var build_finish_week = $('#build_finish_week').val();
         var ready_for_dispatch = $('#ready_for_dispatch').val();
         var machine_dispatched = $('#machine_dispatched').val();
         var dispatched_week = $('#dispatched_week').val();
         var dispatch_date = $('#dispatch_date').val();
         var serial_number = $('#serial_number').val();
        
         var id = "<?php echo $result->id; ?>"
         var type = "all";
         
         $.ajax({
            url: "{{ url('admin/production/update') }}",
            method: "POST",
            data: {_token: '{{ csrf_token() }}',
            id: id,
            type: type,
            PDI_status: PDI_status,
            make: make,
            notes: notes,
            // new code
            purchased_sheet: purchased_sheet,
            steel_parts_due: steel_parts_due,
            parts_due: parts_due,
           
            build_start_week: build_start_week,
            build_shed: build_shed,
            electrics_start_week: electrics_start_week,
            build_finish_week: build_finish_week,
            ready_for_dispatch: ready_for_dispatch,
            machine_dispatched: machine_dispatched,
            dispatched_week: dispatched_week,
            dispatch_date: dispatch_date,
            serial_number: serial_number,
            //price:price,
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
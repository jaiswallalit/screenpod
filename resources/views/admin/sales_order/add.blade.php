@extends('admin.layout.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<style>
    ul.cus-info li:last-child {
        margin: 20px 0 0 0;
        font-size: 30px;
        font-weight: 700;
    }

    ul.custom-last li:last-child {
        font-size: initial;
        font-weight: normal;
    }

    ul.last-ul {
        background-color: #dadada;
    }

    ul.last-ul li:nth-child(even) {
        background-color: transparent;
    }

    i.pdfi {
        font-size: 35px;
        color: #ee1410;
    }
    p.vieweditbtn {
    background: #fecf00;
    padding: 6px;
    text-align: center;
    border-radius: 18px;
}
.addtiontabel table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Create Sales Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Sales Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add <small>sales Order</small></h3>
                            <a href="#" class="btn btn-info float-right" data-toggle="modal" data-target="#add_customer"><i class="fas fa-plus"></i> Add Customer </a>
                        </div>
 <!-- Add Customer Modal -->
     <div class="modal fade" id="add_customer">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Add Customer </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form id="quickForm" action="{{route('customers.csave')}}" method="POST" enctype="multipart/form-data">
                     {{csrf_field()}}

                     <div class="card-body">
                        <div class="form-group">
                           <label for="title">Name</label>
                           <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        
                         <div class="form-group">
                           <label for="vat_number">VAT Number</label>
                           <input type="text" name="vat_number" class="form-control" id="vat_number" placeholder="VAT Number">
                        </div>


                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" name="email" class="form-control" id="email" placeholder="Customer Email">
                        </div>

                        <div class="form-group">
                           <label for="phone">Phone</label>
                           <input type="text" name="phone" class="form-control" id="phone" placeholder="Customer Phone">
                        </div>
                        <div class="form-group">
                           <label for="company">Company</label>
                           <input type="text" name="company" class="form-control" id="company" placeholder="company name">
                        </div>
                        <div class="form-group">
                           <label for="address1">Address 1</label>
                           <textarea class="form-control" id="address1" name="address"></textarea>
                        </div>
                        <div class="form-group">
                           <label for="address2">Address 2</label>
                           <textarea class="form-control" id="address2" name="address2"></textarea>
                        </div>
                        
                        <div class="form-group">
                           <label for="town">Town </label>
                           <input type="text" name="town" class="form-control" id="town" placeholder="town">
                        </div>
                        <div class="form-group">
                           <label for="county">County</label>
                           <input type="text" name="county" class="form-control" id="county" placeholder="county name">
                        </div>
                        <div class="form-group">
                           <label for="eircode">Eircode</label>
                           <input type="text" name="eircode" class="form-control" id="eircode" placeholder="eircode name">
                        </div>

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('customers.index')}}" class="btn btn-default btn-secondary">Back</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- Modal -->
                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span><br />
                            @endforeach
                        </div>
                        @endif
                        <form id="quickForm" action="{{route('sales_order.save')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id " value="1">

                            <div class="card-body">
                            <div class="row">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                            <label for="dealer_id">Order Number</label>

                                            <input type="text" name="order_number" class="form-control" id="order_number" value="{{$order_number}}" placeholder="Order Number" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                      
                                            <label for="customer_id">Customer</label>
                                            <select name="customer_id" class="customer_id select12 form-control" id="customer_id" data-placeholder="Select a Customer" style="width: 100%;" required>
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $value)
                                                <?php
 if(empty($result[0])){ ?>
    <option value="{{$value->id}}">{{$value->name}}</option>
 <?php } 
 else{ ?>
                                                <option value="{{$value->id}}" <?php if($result[0]->customer_id == $value->id){echo "selected";} ?> >{{$value->name}}</option>

 <?php } 
                                                ?>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                            <label for="dealer_id">Order Date </label>
                                            <input type="date" name="order_date" class="form-control" id="mandatory">

                                        </div>
                                    </div>
                                </div>

                               
                                    <!-- 2may new code -->
 <div class="row">
    <table class="table-condensed table tbale-bordered table-striped" id="customers">
    <thead>
    <tr>
            <th>Order Code</th>
            <th>Category</th>
            <th>Machine</th>
            <th>Mandatory</th>
            <th>Optional Extras</th>
            <th>Additional Extras</th>
            <th>Notes</th>
            <th>Spec Sheet</th>
       
        </tr>
    </thead>
    <?php
    $macine_order_number = DB::table('sales_orders')->where('order_number',$order_number)->count() +1;
    
    ?>
    

    @foreach ($result as $key => $result)
        <?php
          $customer = DB::table('customers')->where('id',$result->customer_id)->first();
          $product = DB::table('products')->where('id',$result->product_id)->first();
          $category = DB::table('categories')->where('id',$product->category_id)->first();
          //$order_number = DB::table('sales_orders')->count();
          $spec_exist = DB::table('spec_sheets')->where('machine_order_number',$result->machine_order_number)->first();
          $spec_add = DB::table('spec_additionals')->where('machine_order_number',$result->machine_order_number)->first();

// print_r($category);
// die();
        ?>

    <tbody>
        <tr>
       
            <td>{{$result->machine_order_number}}</td>
            <td>{{$category->name}}</td>
            <td> <?php
                                       if (!empty($product->title)) {
                                        echo $product->title;
                                 }
                                 else{
                                     echo 'Machine';
                                 } ?></td>
            <td>@if(!empty($spec_exist->mandatory))
                                 {{$spec_exist->mandatory}}
                              @endif</td>
                              <td>@if(!empty($spec_exist->optional_extras))
                                 {{$spec_exist->optional_extras}}
                              @endif</td>
                              <td>@if(!empty($spec_add->custom_paint))
                              Custom Paint-({{$spec_add->custom_paint}}) </br>
                              @endif
                              @if(!empty($spec_add->extra_vacuum_heads))
                               Extra Vacuum Heads-({{$spec_add->extra_vacuum_heads}})</br>
                              @endif
                              @if(!empty($spec_add->extra_clamps))
                               Extra Clamps- ({{$spec_add->extra_clamps}})</br>
                              @endif
                              @if(!empty($spec_add->extra_standard_hose))
                              Extra Standard Hose- ({{$spec_add->extra_standard_hose}})</br>
                              @endif
                              @if(!empty($spec_add->heavy_duty))
                               Extra Heavy Duty Hose	- ({{$spec_add->heavy_duty}})</br>
                              @endif
                              @if(!empty($spec_add->impeller))
                               Extra Impeller- ({{$spec_add->impeller}})
                              @endif
                              
                           </td>
            <td>{{$result->machines_notes}}</td>
            <td><p class="vieweditbtn"><a href="{{route('sales_order.specheet', $result->machine_order_number)}}" class="" data-placement="top" data-original-title="View" style="width: 83px;">View/Edit </a></p>
         
        </td>
        </tr>
        
</tbody>
@endforeach

    </table>
    
           
        
 </div>
                                   

                           
                                                   <!-- 2may new code end -->
<div class="row">
<div class="col-md-12">

<div class="card-header float-right">
    
<p> <a href="" class="btn btn-success btn-lg open-enquiry" data-target="#add_machine" 
data-toggle="modal" data-id="My Id" data-info="My Id"> <i class="fas fa-plus"></i>Add Machine </a> </p>

 </div>
</div>
</div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Delivery Arrangements</label>
                                    <textarea class="form-control" name="delivery_arrangements" id="notes"></textarea>
                                 </div>
                                 </div>   
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes"></textarea>
                                 </div>
                                 </div>
                                    </div>
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{route('sales_order.index')}}" class="btn btn-default btn-secondary">Back</a>
                                        </div>
                                    </div>
                        </form>
                        <!-- Add Machine Modal -->
           <div class="modal fade" id="add_machine">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Add Machine to Sales Order</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form id="quickForm" action="{{route('sales_order.machinesave')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="user_id" value="1">
                     <input type="hidden" name="machine_order_number" value="{{$order_number}}_{{$macine_order_number}}" readonly>

                     <input type="hidden" class="form-control" name="myid" id="get_my_id" readonly>
                       <input type="hidden" class="form-control" name="order_number" id="order_id" readonly>
                       <input type="hidden" class="form-control" name="customer_id" id="customer_id" readonly>
                     <div class="modal-body">
                     <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dealer_id">Brands</label>
                                            <select class="form-control" name="dealer_id" id="dealer_id">
                                                <option value="">Select Make</option>
                                                @foreach($dealers as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="model">Machines</label>
                                            <select class="form-control" name="product_id" id="product_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                           
                                <div class="row">
                                
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price" placeholder="price">
                                     </div>

                                    </div>
                                   
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Notes</label>
                                    <textarea class="form-control" name="machines_notes" id="machine_notes"></textarea>
                                 </div>
                                 </div>
                                    </div>
                     </div>

                     <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         </div>  
         <!-- Modal -->
          
                    </div>
                </div>
               
            </div>
        </div>
        </div>
    </section>
    
    @endsection
    @section('script')
    <script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script>


      $(document).ready(function () { 
        
        $(document).on('click', '.editbtn', function (){
         
           
        var machine_order_number = $(this).val();
        $("#ctext").val(machine_order_number);
        //alert(machine_order_number);
         //$('myModal').modal('show');
         $('#myModal').modal('show');

         $.ajax({
            type: "GET",
            url: "{{ url('admin/sales_order/machineedit') }}"+"/"+machine_order_number,
            success: function(response){

                console.log(response);
            }
           // method: "GET",
        });  
         }); 
         
        });
    </script>
<script>
$(document).on("click", ".open-enquiry", function() {
var myId = $(this).data('id'); // get the button value in a variable
// and also get the other values in another variables by using the input field id
var order_number = document.getElementById("order_number").value; 
var customer_id = document.getElementById("customer_id").value;

// here pass these values in popup by using the id's
$(".modal-dialog #get_my_id").val( myId );
$(".modal-dialog #order_id").val( order_number );
$(".modal-dialog #customer_id").val( customer_id );
});
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

        $(function() {
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
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

   
    @endsection
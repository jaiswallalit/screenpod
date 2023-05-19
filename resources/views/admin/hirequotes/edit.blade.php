@extends('admin.layout.master')
@section('content')

<style>
   ul.cus-info li:last-child{
      margin: 20px 0 0 0;
      font-size: 30px;
      font-weight: 700;
   }
</style>
<style>
   #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
   }

   #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
   }

   #customers tr:nth-child(even){background-color: #f2f2f2;}

   #customers tr:hover {background-color: #ddd;}

   #customers th {
      padding-top: 8px;
      /*padding-bottom: 8px;*/
      text-align: left;
      background-color: #d6d6d6;
      color: #000;
   }
   .head-1 {
      padding: 10px;
      margin-bottom: 0;
      /*display: flow-root;*/
   }
   .side_bar_menu ul {
      padding-left: 0;
   }
   .side_bar_menu ul li a {
      font-size: 15px;
      color: #000;
   }
   .side_bar_menu ul li {
      display: block;
      padding: 10px 0;
      border-bottom: 1px solid #f1f1f1;
   }
   .side_bar_menu {
      background: #e0e0e0;
      padding: 15px;
   }
   .add-pro-btn{
      float: right;
      border: none;
      background-color: #007aff;
      color: #fff;
      margin-bottom: 10px;
      outline: none;
      height: 34px;
      padding: 0 20px;
      border-radius: 4px;
      font-weight: 100;
      letter-spacing: .4px;
      font-size: 13px;
      margin-left: 5px;
   }
   .cus-content{
      height: 200px;
   }
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Hire Quote Details</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Hire Details</li>
               </ol>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
      <div class="card">
         <div class="card-header float-right">
            <a href="#" class="btn btn-info float-right" data-toggle="modal" data-target="#add_machine"><i class="fas fa-plus"></i> Add Machine </a>
         </div>

         <!-- Modal -->
         <div class="modal fade" id="add_machine">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Add Machine to Hire Quote</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form id="quickForm" action="{{route('hirequotes.addMachine')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="quote_id" value="{{$result->id}}">
                     
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="type">Type</label>
                                 <select name="type" id="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="Hire">Hire</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="depot">Brands</label>
                                 <select name="dealer_id" id="dealer_id" class="form-control">
                                    <option value="">Select Brands</option>
                                    @foreach($dealers as $value)
                                       <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="product_id">Products</label>
                           <select name="product_id" id="product_id" class="form-control select12">
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="quantity">Quantity</label>
                           <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity" >
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
         <!-- Modal -->

         <div class="card-body">
            <div class="row">
               <div class="col-12 col-md-12 col-lg-12">
                  <div class="row">
                     <div class="col-md-12">
                        <h4></h4>
                        <div class="post">
                           <table class="table tbale-bordered table-striped" id="customers">
                              <tbody>
                                 <tr>
                                    <th>Sales Rep.</th>
                                    <td>{{$result->user_name}}</td>
                                 </tr>
                                 <tr>
                                    <th>Lead</th>
                                    <td>{{$result->leads_title}} ({{$result->lead_name}})</td>
                                 </tr>
                                 <tr>
                                    <th>Email</th>
                                    <td>{{$result->email}}</td>
                                 </tr>
                                 <tr>
                                    <th>Contact No.</th>
                                    <td>{{$result->phone}}</td>
                                 </tr>
                                 <tr>
                                    <th>Date</th>
                                    <td>{{date('d F Y',strtotime($result->created_at))}}</td>
                                 </tr>
                                 <tr>
                                    <th>Time</th>
                                    <td>{{date('h:i A',strtotime($result->created_at))}}</td>
                                 </tr>
                                 <tr>
                                    <th style="width: 200px;">Contact Method</th>
                                    <td>Enquiry</td>
                                 </tr>
                                 <tr>
                                    <th>Message</th>
                                    <td>{{$result->message}}</td>
                                 </tr>
                                 <?php if(!empty($result->attachment)){ 
                                    $ext = explode('.', $result->attachment);
                                 ?>
                                    <tr>
                                       <th>Attachment</th>
                                       <td> 
                                          <a class="" href="{{ asset('/public/admin/clip-one/assets/quotes')}}/{{ $result->attachment }}" target="_blank" downlaod><span>{{$result->attachment}}</span></a>
                                          <i class="far fa-file-{{$icons[$ext[1]]}} fa-5x text-center"/></i>
                                       </td>
                                    </tr>
                                 <?php } ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <table id="customers">
                           <tbody>
                              <tr>
                                 <th width="60px">Image</th>
                                 <th>Name</th>
                                 <th width="200px">Price</th>
                                 <th width="200px">Qty</th>
                                 <th>Total</th>
                                 <th>Action</th>
                              </tr>
                              @foreach($products as $key => $product)
                                 <?php 
                                 $extra_info = DB::table('hire_info')->where('quote_id',$result->id)->where('product_id',$product['id'])->first();
                              //  print_r($extra_info);
                              //  die('heee');
                               ?>
                                 <form action="{{route('hirequotes.update')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="quote_product_id" value="{{$product['quote_product_id']}}">
                                    <input type="hidden" name="quote_id" value="{{$result->id}}">
                                    <tr class="table_row">
                                       <td>   
                                          <a href="#"><img src="{{url('/public/admin/clip-one/assets/products/original')}}/{{$product['image']}}" alt="" height="80px"></a>
                                       </td>
                                       <td>{{$product['title']}}</td>
                                       <td>
                                          <input type="number" name="price" class="form-control" value="{{$product['price']}}" step="any">
                                       </td>
                                       <td class="quantity"><input type="number" name="quantity" class="form-control" value="{{$product['quantity']}}"></td>
                                       <td>&#128;{{$product['total_price']}}</td>
                                       <td>
                                          <button type="submit" class="btn btn-primary" title="Update" ><i class="fas fa-sync"></i></button>&nbsp;&nbsp;
                                          <a href="#" data-toggle="modal" data-target="#modal-default_{{$key}}" title="Add Extra Info"><button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button></a>&nbsp;&nbsp;
                                          <button type="button" class="btn btn-danger remove_machine" data-id="{{$product['quote_product_id']}}" title="Remove"><i class="fas fa-trash"></i></button>
										                                          <!--<a href="#" data-toggle="modal" data-target="#modal-default1_{{$key}}" title="Add Trade"><button type="button" class="btn btn-info">Add Trade</button></a>&nbsp;&nbsp;-->

                                       </td>
                                    </tr>
                                 </form>

                                 <!-- Modal -->
                                 <div class="modal fade" id="modal-default_{{$key}}">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h4 class="modal-title">Add Machine Hire Information</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          
                                          <form action="{{route('hirequotes.hire_info')}}" method="post">
                                             {{csrf_field()}}
                                             <input type="hidden" name="quote_id" value="{{$result->id}}">
                                             <input type="hidden" name="product_id" value="{{$product['id']}}">
                                             <div class="modal-body">
                                                <div class="form-group">
                                                   <label for="min_hire_period">Min Hire Period</label>
                                                   <input type="text" name="min_hire_period" class="form-control" id="min_hire_period" placeholder="Min Hire Period" value="<?php if(!empty($extra_info)){echo $extra_info->min_hire_period;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="payment_terms">Payment Terms</label>
                                                   <input type="text" name="payment_terms" class="form-control" id="payment_terms" placeholder="Payment Terms" value="<?php if(!empty($extra_info)){echo $extra_info->payment_terms;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="purcharse_period">Hire back Purcharse Period</label>
                                                   <input type="text" name="purcharse_period" class="form-control" id="purcharse_period" placeholder="Hire back Purcharse Period" value="<?php if(!empty($extra_info)){echo $extra_info->purcharse_period;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="consumables">Consumables</label>
                                                   <input type="text" name="consumables" class="form-control" id="consumables" placeholder="Consumables" value="<?php if(!empty($extra_info)){echo $extra_info->consumables;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="transport_in">Transport In</label>
                                                   <input type="text" name="transport_in" class="form-control" id="transport_in" placeholder="Transport In" value="<?php if(!empty($extra_info)){echo $extra_info->transport_in;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="weekly_hire_price">Weekly Hire Price</label>
                                                   <input type="text" name="weekly_hire_price" class="form-control" id="weekly_hire_price" placeholder="Weekly Hire Price" value="<?php if(!empty($extra_info)){echo $extra_info->weekly_hire_price;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="fittings_price">Fittings Price</label>
                                                   <input type="text" name="fittings_price" class="form-control" id="fittings_price" placeholder="Fittings Price" value="<?php if(!empty($extra_info)){echo $extra_info->fittings_price;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="transport_out_price">Transport Out Price</label>
                                                   <input type="text" name="transport_out_price" class="form-control" id="transport_out_price" placeholder="Transport Out Price" value="<?php if(!empty($extra_info)){echo $extra_info->transport_out_price;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="delivery_location">Delivery Location</label>
                                                   <input type="text" name="delivery_location" class="form-control" id="delivery_location" placeholder="delivery location" value="<?php if(!empty($extra_info)){echo $extra_info->delivery_location;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="site_contact">Site Contact</label>
                                                   <input type="text" name="site_contact" class="form-control" id="site_contact" placeholder="Site Contact" value="<?php if(!empty($extra_info)){echo $extra_info->site_contact;} ?>">
                                                </div>
                                               
                                                <label for="site_contact">Hire Period</label>
                                                <div class="row">
                                                
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="site_contact">Hire Start</label>
                                                   <input type="date" name="hire_start" class="form-control" id="hire_start" placeholder="Start" value="<?php if(!empty($extra_info)){echo $extra_info->hire_start;} ?>">
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                <label for="site_contact">Hire END</label>
                                                   <input type="date" name="hire_end" class="form-control" id="hire_end" placeholder="Hire End" value="<?php if(!empty($extra_info)){echo $extra_info->hire_end;} ?>">
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
                                 <!-- Modal -->

							
                              @endforeach
                              
                          </tbody></table>

                        <div class="float-right delivr" style="margin-top: 15px; WIDTH: 39%;margin-bottom: 50px;">
                           <table id="customers"> 
                              <tbody>
                                 <tr style="background-color: #d6d6d6;">
                                    <td><strong>Quote Price</strong></td>
                                    <td><strong>&#128;{{$result->price}}</strong></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                     </div>
                  </div>
               </div>
            </div>

            <div class="card-footer text-right">
               <div>
                  <a href="{{url('admin/hirequotes/sendhireorder')}}/{{$result->id}}" class="btn btn-custom mr-2">Create Order </a>
				      <a href="{{url('admin/quotes/view')}}/{{$result->id}}" class="btn btn-success mr-2">Priview Quote </a>
                  <a href="{{url('admin/quotes/resend')}}/{{$result->id}}" class="btn btn-primary mr-2">Resend Quote</a>
                  <a href="{{route('quotes.index')}}" class="btn btn-primary btn-secondary">Back</a>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

@endsection

@section('script')
<script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script>
   $(document).ready(function(){
      $('.select12').select2({
         theme: 'bootstrap4'
      });

      $('.remove_machine').on('click',function(){
         var id = "<?php echo $result->id; ?>";
         var quote_product_id = $(this).data('id');

         $.ajax({
            url: "{{ url('admin/quotes/removeMachine') }}",
            method: "post",
            data: {_token: '{{ csrf_token() }}', id: id, quote_product_id: quote_product_id},
            success: function (response) {
               if(response.msg == 'success'){
                  toastr.success('Machine removed successfully.', 'Success');
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

      $('#type,#dealer_id').on('change', function() {
         var id = "<?php echo $result->id; ?>";
         var type = $('#type').val();
         var dealer_id = $('#dealer_id').val();

         if (type == '' || dealer_id == '') {
            return false;
         }
         
         $("#product_id").html('');
         $.ajax({
            url: "{{ url('admin/hirequotes/hiregetProducts') }}"+"/"+id+"/"+type+"/"+dealer_id,
            type: "GET",
            dataType : 'json',
            success: function(result){
               $('#product_id').html(result);
            }
         });
      });

   });


   $(function () {
      $('#quickForm').validate({
         rules: {
            type: {
               required: true
            },
            dealer_id: {
               required: true
            },
            product_id: {
               required: true
            },
            quantity: {
               required: true
            },
         },
         messages: {
            type: {
               required: "",
            },
            dealer_id: {
               required: "",
            },
            product_id: {
               required: "",
            },
            quantity: {
               required: "",
            },
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
@endsection
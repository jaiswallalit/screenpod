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
        <!-- <div class="card-header">
          <h3 class="card-title">Projects Detail</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div> -->
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="row">

               <div class="col-12 col-sm-12">
                  <div class="machine-panel">
                     <h1>Selected Machines</h1>
                        <ul class="machine-list">
                           @foreach($products as $product)
                              <li><a href="#"><img src="{{url('/public/admin/clip-one/assets/products/original')}}/{{$product['image']}}" alt=""> <span>{{$product['title']}}</span><span>{{$result->currency}}{{$product['price']}} X {{$product['quantity']}} = {{$result->currency}}{{$product['total_price']}}</span></a><br>
<a class="" href="{{ asset('/admin/clip-one/assets/products/attachment')}}/{{$product['product_attachment']}}" target="_blank" downlaod="{{$product['product_attachment']}}"><span><i class="pdfi far fa-file-pdf fa-5x text-center"></i> </span></a>
</li>
                           @endforeach
                        </ul>
                  </div>
               </div>

              </div>
               <div class="row">
                  <div class="col-md-12">
                     <h4></h4>
                     <div class="post">
                        <!-- /.user-block -->

                        <ul class="cus-info custom-last">
                           <li><span>Sales Rep:</span> {{$result->user_name}}</li>
                           <li><span>Lead:</span> {{$result->lead_title}} ({{$result->lead_name}})</li>
                           <li><span>Email:</span> {{$result->email}}</li>
                           <li><span>Contact No.:</span> {{$result->phone}}</li>
                            <li><span>Customer Name:</span>{{$result->lead_name}}</li>
                           <li><span>Date:</span> {{date('d F Y',strtotime($result->created_at))}}</li>
                           <li><span>Time:</span> {{date('h:i A',strtotime($result->created_at))}}</li>
                           <li><span>Message:</span> <span class="cus-message">{{$result->message}}</span></li>
<li><span><b>Tradein</b></span>
                               </li>
                            
                              <li><span>Make:</span>
                                 <?php if (!empty($tradein)) {
                                    echo $tradein->make;
                                 } ?>
                                 </span>
                              </li>
                              <li><span>Mode:</span>
                                 <?php if (!empty($tradein)) {
                                    echo $tradein->model;
                                 } ?>
                                 </span>
                              </li>
                              <li><span>Year:</span>
                                 <?php if (!empty($tradein)) {
                                    echo $tradein->year;
                                 } ?>
                                 </span>
                              </li>
                              <li><span>Hours:</span>
                                 <?php if (!empty($tradein)) {
                                    echo $tradein->hours;
                                 } ?>
                                 </span>
                              </li>
                              <li><span>Trade Price:</span>
                                 <?php if (!empty($tradein)) {
                                    echo $tradein->price;
                                 } ?>
                                 </span>
                              </li>
                              
                              <li>@foreach($products as $key => $product)

										      <a href="#" data-toggle="modal" data-target="#modal-default1_{{$key}}" title="Add Trade"><button type="button" class="btn btn-info">Add Trade</button></a>&nbsp;&nbsp;

                               <!--Trade Modal -->
<div class="modal fade" id="modal-default1_{{$key}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add TRAD Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('sales_order.addTrd')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="quote_id" value="{{$result['quote_id']}}">
                <input type="hidden" name="old_product_id" value="{{$product['id']}}">
                <input type="hidden" name="product_id" value="{{$product['id']}}">
                 <input type="hidden" name="sales_orders_id" value="{{$result['id']}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="make">Make</label>
                        <input type="text" name="make" class="form-control" id="make" placeholder="make" value="<?php if (!empty($extra_info)) {echo $extra_info->make;} ?>">
                    </div>
                    <div class="form-group">
                        <label for="model">model</label>
                        <input type="text" name="model" class="form-control" id="model" placeholder="model" value="<?php if (!empty($extra_info)) {echo $extra_info->model;} ?>">
                    </div>
                    <div class="form-group">
                        <label for="year">year</label>
                        <input type="text" name="year" class="form-control" id="year" placeholder="year" value="<?php if (!empty($extra_info)) {echo $extra_info->year; } ?>">
                    </div>
                    <div class="form-group">
                        <label for="hours">hours</label>
                        <input type="text" name="hours" class="form-control" id="hours" placeholder="hours" value="<?php if (!empty($extra_info)) { echo $extra_info->hours;} ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" placeholder="price" value="<?php if (!empty($extra_info)) {echo $extra_info->price; } ?>">
                    </div>
                    <div class="form-group">
                       
                         <div class=" modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
@endforeach
                           @if(Auth::user()->user_type != 'admin')
                              <li><span>Depot:</span> <?php if(!empty($extra_info) && $extra_info->depot != ''){ echo $extra_info->depot; } ?></li>
                              <li><span>Hitch:</span> <?php if(!empty($extra_info) && $extra_info->hitch != ''){ echo $extra_info->hitch; } ?></li>
                              <li><span>Buckets:</span> <?php if(!empty($extra_info) && $extra_info->buckets != ''){ echo $extra_info->buckets; } ?></li>
                              <li><span>Extra:</span> <?php if(!empty($extra_info) && $extra_info->extra != ''){ echo $extra_info->extra; } ?></li>
                           @else
                           <li><span><b>Extra Info</b></span>
                               </li>
                              <li><span>Depot:</span>
                                @if(!empty($product_extra->depot))
                                       {{$product_extra->depot}}
                                    @endif
                             
                                 </span>
                              </li>
                              <li><span>Hitch:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->hitch;} ?>-->
                                   @if(!empty($product_extra->hitch))
                                       {{$product_extra->hitch}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Buckets:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->buckets;} ?>-->
                                    @if(!empty($product_extra->buckets))
                                       {{$product_extra->buckets}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Extra:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->extra;} ?>-->
                                     @if(!empty($product_extra->extra))
                                       {{$product_extra->extra}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Loader:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->loader;} ?>-->
                                     @if(!empty($product_extra->loader))
                                       {{$product_extra->loader}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Warranty:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->warranty;} ?>-->
                                     @if(!empty($product_extra->warranty))
                                       {{$product_extra->warranty}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Cab type:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->cabtype;} ?>-->
                                     @if(!empty($product_extra->cabtype))
                                       {{$product_extra->cabtype}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Tyres:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->tyres;} ?>-->
                                     @if(!empty($product_extra->tyres))
                                       {{$product_extra->tyres}}
                                    @endif
                                 </span>
                              </li>
                              <li><span>Accessories:</span>
                                 <span class="cus-message"> 
                                 <!--<?php if(!empty($extra_info)){echo $extra_info->accessories;} ?>-->
                                     @if(!empty($product_extra->accessories))
                                       {{$product_extra->accessories}}
                                    @endif
                                 </span>
                              </li>

                              <li>@foreach($products as $key => $product)
<a href="#" data-toggle="modal" data-target="#modal-default_{{$key}}" title="Add Extra Info"><button type="button" class="btn btn-info"><i class="fas fa-plus"></i>Add Extra Info
</button></a>&nbsp;&nbsp;
<!-- Modal -->
<div class="modal fade" id="modal-default_{{$key}}">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h4 class="modal-title">Add Extra Info</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <form action="{{route('sales_order.addExtra')}}" method="post">
                                             {{csrf_field()}}
                                             <input type="hidden" name="quote_id" value="{{$result['quote_id']}}">
                                             <input type="hidden" name="product_id" value="{{$product['id']}}">
                                         <input type="hidden" name="sales_orders_id" value="{{$result['id']}}">
                                                                                          <input type="hidden" name="user_id" value="{{$result['user_id']}}">

                                             <div class="modal-body">
                                                <div class="form-group">
                                                   <label for="depot">Depot</label>
                                                   <input type="text" name="depot" class="form-control" id="depot" placeholder="Depot" value="<?php if(!empty($product_extra)){echo $product_extra->depot;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="hitch">Hitch</label>
                                                   <input type="text" name="hitch" class="form-control" id="hitch" placeholder="Hitch" value="<?php if(!empty($product_extra)){echo $product_extra->hitch;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="buckets">Buckets</label>
                                                   <input type="text" name="buckets" class="form-control" id="buckets" placeholder="Buckets" value="<?php if(!empty($product_extra)){echo $product_extra->buckets;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="extra">Extra</label>
                                                   <input type="text" name="extra" class="form-control" id="extra" placeholder="Extra" value="<?php if(!empty($product_extra)){echo $product_extra->extra;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="extra">loader</label>
                                                   <input type="text" name="loader" class="form-control" id="loader" placeholder="loader" value="<?php if(!empty($product_extra)){echo $product_extra->loader;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="extra">cabtype</label>
                                                   <input type="text" name="cabtype" class="form-control" id="cabtype" placeholder="cabtype" value="<?php if(!empty($product_extra)){echo $product_extra->cabtype;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="extra">tyres</label>
                                                   <input type="text" name="tyres" class="form-control" id="tyres" placeholder="tyres" value="<?php if(!empty($product_extra)){echo $product_extra->tyres;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="extra">accessories</label>
                                                   <input type="text" name="accessories" class="form-control" id="accessories" placeholder="accessories" value="<?php if(!empty($product_extra)){echo $product_extra->accessories;} ?>">
                                                </div>
                                                <div class="form-group">
                                                   <label for="extra">warranty</label>
                                                   <input type="text" name="warranty" class="form-control" id="warranty" placeholder="warranty" value="<?php if(!empty($product_extra)){echo $product_extra->warranty;} ?>">
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

                           </li>
                           @endif
                           <?php if(!empty($result->attachment)){ 
                              $ext = explode('.', $result->attachment);
                              ?>
                              <li><span>Attachment:</span> 
                                 <a class="" href="{{ asset('/public/admin/clip-one/assets/quotes')}}/{{ $result->attachment }}" target="_blank" downlaod><span>{{$result->attachment}}</span></a>
                                 <i class="far fa-file-{{$icons[$ext[1]]}} fa-5x text-center"></i>
                              </li>
                           <?php } ?>

                    <li>
                        <!--<span>Serial Number : {{$result->serial_number}}</span>-->
                    <br>
                                 <!--<div class="form-group">-->
                                 <!--   <select class="form-control" name="serial_number" id="serial_number">-->
                                 <!--      <option value="">Select Serial Number</option>-->
                                 <!--      @foreach($serial_number as $value)-->
                                 <!--      <option value="{{$value->stock_number}}">{{$value->stock_number}}</option>-->
                                 <!--      @endforeach-->

                                 <!--   </select>-->
                                 <!--</div>-->
                              <!--@if($result->serial_number != 0 )-->
                              <!--   <span class="cus-message">-->
                                    <!-- {{$result->serial_number}} -->
                              <!--      <input type="number" name="serial_number" class="form-control" value="{{$result->serial_number}}" id="serial_number">-->
                              <!--   </span>-->
                              <!--@else-->
                              <!--   <span class="cus-message">-->
                              <!--      @if(Auth::user()->user_type == 'admin' || $account_type == 'Office')-->
                              <!--         <button class="btn btn-block btn-secondary btn-sm mt-2" data-placement="top" data-original-title="Add More" style="display: block;" data-toggle="modal" data-target="#modal-default" ><i class="fas fa-plus"></i>Add Machine</button>-->

                              <!--         <input type="hidden" name="product_id" class="form-control" id="product_id">-->
                              <!--         <input type="hidden" name="serial_number" class="form-control" id="serial_number">-->
                              <!--      @else-->
                              <!--         {{$result->serial_number}}-->
                              <!--      @endif-->
                              <!--   </span>-->
                              <!--@endif-->
                           </li>
                   

                           <!-- Add machine modal -->
                           <div class="modal fade" id="modal-default">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Add Machine</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <form id="quickForm" action="{{route('sales_order.add_machine')}}" method="POST" enctype="multipart/form-data" >
                                       {{csrf_field()}}
                                       <input type="hidden" name="sales_order_id" id="product_id" value="{{$result->id}}">

                                       <div class="modal-body">

                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="dealer_id">Make</label>
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
                                                   <label for="model">Model</label>
                                                   <select class="form-control" name="model" id="model">
                                                   </select>
                                                </div>
                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <label for="serial_no">Serial Number</label>
                                             <select class="form-control" name="serial_no" id="serial_no">
                                             </select>
                                          </div>
                                          
                                       </div>
                                       <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Add</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!-- Add more modal -->

                           <li><span>PDI Status:</span>
                              <span class="cus-message">
                                 <select class="form-control" name="PDI_status" id="PDI_status">
                                    <option value="">Select PDI Status</option>
                                    <option value="1" <?php if($result->PDI_status == '1'){echo "selected";} ?> >Approved</option>
                                    <option value="0" <?php if($result->PDI_status == '0'){echo "selected";} ?> >Defected</option>
                                 </select>
                              </span>
                           </li>
                           <li>
                              <span>PDI Message:</span>
                              <span class="cus-message">
                                 <textarea class="form-control" name="PDI_message" id="PDI_message">{{$result->PDI_message}}</textarea>
                              </span>
                           </li>
                           <li><span>Payment Confirm:</span>
                             <span class="cus-message">
                                <select class="form-control" name="payment_confirm" id="payment_confirm">
                                   <option value="">Select Payment Status</option>
                                   <option value="1" <?php if($result->payment_confirm == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->payment_confirm == '0'){echo "selected";} ?> >No</option>
                                </select>
                             </span>
                           </li>
                           <li><span>Delivered:</span>
                             <span class="cus-message">
                                <select class="form-control" name="delivered" id="delivered">
                                   <option value="">Delivery Status</option>
                                   <option value="1" <?php if($result->delivered == '1'){echo "selected";} ?> >Yes</option>
                                   <option value="0" <?php if($result->delivered == '0'){echo "selected";} ?> >No</option>
                                </select>
                             </span>
                           </li>
                            <li><span>Delivery Date:</span><span class="cus-message">{{$result->delivery_date}}</span></li>

                            <li>
                              <span>Notes:</span>
                              <span class="cus-message">
                                 <textarea class="form-control" name="notes" id="notes">{{$result->notes}}</textarea>
                              </span>
                           </li>
                        </ul>

                        @if(Auth::user()->account_type != 'Service')
                           <ul class="cus-info last-ul">
                              <li><span><strong>Price:</strong></span><span class="cus-message">
                                 @if(Auth::user()->user_type != 'admin')
                                    {{number_format($product['price'],2)}}
                                 @else
                                    <input type="number" name="price" class="form-control" value="{{$product['price']}}" id="price">
                                 @endif
                              </span></li>
                               <li><span><strong>Quantity:</strong></span><span class="cus-message">
                                 <input type="number" name="qty" class="form-control" value="{{$product['quantity']}}" id="qty">
                                 </span></li>
                                 <li><span><strong>Serial Number:</strong>{{$result->serial_number}}</span></li>
                                 <li><span><strong>Add Serial Number:</strong></span><span class="cus-message">
                         
                                 <div class="form-group">
                                    <select class="form-control" name="serial_number" id="serial_number" multiple>
                                       @foreach($serial_number as $value)
                                       <option value="{{$value->stock_number}}">{{$value->stock_number}}</option>
                                       @endforeach

                                    </select>
                                 </div></li>
                              <li><span><strong>Sub Total:</strong></span> <span class="cus-message">{{number_format($product['quantity'] * $product['price'],2)}}</span></li>
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
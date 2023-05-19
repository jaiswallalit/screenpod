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
.mybtn button.btn {
    background: #fecf00;
    color: #000;
    text-align: center;
}
.mybtn {
    text-align: center;
}
.mybtn a.btn {
    background: #000;
    color: #fff;
    text-align: center;
    margin-left: 15px;
    padding: 6px 30px;
}
input[type="checkbox"][readonly] {
  pointer-events: none;
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
            <h1>Spacs Details</h1>
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
        @foreach ($machin as  $resultdata)
        <?php 
        $specsexist = DB::table('spec_sheets')->where('machine_order_number',$resultdata->machine_order_number)->first();
        $addspecsexist = DB::table('spec_additionals')->where('machine_order_number',$resultdata->machine_order_number)->first();

        ?>
        <form id="quickForm" action="{{route('sales_order.machinespecsheet')}}" method="post">
                     {{csrf_field()}}
                     <input type="hidden" name="user_id" value="1">
                     <input type="hidden" name="machine_order_number" value="{{$resultdata->machine_order_number}}" id="ctext" readonly>
                     <input type="hidden" name="order_number" value="{{$resultdata->order_number}}" readonly>

                     <div class="modal-body">
                     <table class="addtiontabel table-condensed table tbale-bordered table-striped">
                            <tr style="background: #8e8e8e;">
                                <th class="col1"></th>
                                <th class="col2">Description</th>
                                <th class="col2">Required</th>
                                <th class="col4">Comments</th>
                            </tr>
                            <tr>
                                <td class="col1">Mandatory</td>
                                <td class="col2">AV52 BASE MACHINE </td>
                                <td class="col3"><label>
                                <?php
                                    $all_type = array('AV52 BASE MACHINE');
                                    //$fruit = "apple,orange,banana";
                                    $multitype = explode('/','AV52 BASE MACHINE'); // convert selecte fruits to array
                                    foreach ($all_type as $value){
                                    $checkedStatus = "";
                                    // check if $fruit in $selected fruit array - make it checked
                                    if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                    echo "<label><input name='mandatory[]' type='checkbox' ".$checkedStatus." value='".$value."' readonly/></label>"; 
                                     }?>
                              
                                </td>
                                
                                <td class="col4">Mandatory</td>
                            </tr>
                            <tr>
                                <td>Optional Extras</td>
                                <td>Vacuum Head</td>
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($specsexist->mandatory)){ ?>
                                        <label><input type="checkbox" name="optional_extras[]" value="Vacuum Head"></label>                                        <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array('Vacuum Head');
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$specsexist->optional_extras); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='optional_extras[]' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                    <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Clamps x 3</td>


                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($specsexist->mandatory)){ ?>
                                       <label><input type="checkbox" name="optional_extras[]" value="Clamps x 3"></label>                                     <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array('Clamps x 3');
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$specsexist->optional_extras); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='optional_extras[]' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Standard Duty Hose</td>
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($specsexist->mandatory)){ ?>
                                       <label><input type="checkbox" name="optional_extras[]" value="Standard Duty Hose"></label>                                    <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array('Standard Duty Hose');
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$specsexist->optional_extras); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='optional_extras[]' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Heavy Duty Hose</td>
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($specsexist->mandatory)){ ?>
                                       <label><input type="checkbox" name="optional_extras[]" value="Heavy Duty Hose"></label>                                   <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array('Heavy Duty Hose');
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$specsexist->optional_extras); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='optional_extras[]' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                              
                              
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Spare Impeller</td>
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($specsexist->mandatory)){ ?>
                                       <label><input type="checkbox" name="optional_extras[]" value="Spare Impeller"></label>                                  <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array('Spare Impeller');
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$specsexist->optional_extras); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='optional_extras[]' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                               
                                <td></td>
                            </tr>
                            <tr class="custompaint">
                            <!-- Custom Paint Row -->
                            <td> Additional Items</td>
                                <td>  Custom Paint</td>
                                <td class="col3"><label>
                                    <?php
                                        if(empty($addspecsexist->custom_paint)){ ?>
                                       <label> <input type="checkbox" name="" id="wr" data-id="yesWR" value=""></label>                                  <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array($addspecsexist->custom_paint);
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$addspecsexist->custom_paint); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='' id='wr' data-id='yesWR' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                    <td>
                                    <?php 
                                     if(empty($addspecsexist->custom_paint)){?>
                                     <div id="yesWR" style="display: none">
                                    <input type="text" name="custom_paint" id="yesWR" value="" placeholder="" />
                                   </div>
                                    <?php } 
                                    else{ ?>
                                    <input type="text" name="custom_paint" id="yesWR" value="{{$addspecsexist->custom_paint}}" placeholder="" />

                                    <?php } 
                                   ?>
                                    </td>
                             </tr>
                            <tr>
                                <td></td>
                                <td> Extra Vacuum Heads</td>
                                <td class="col3"><label>
                               
                                    <?php
                                        if(empty($addspecsexist->extra_vacuum_heads)){ ?>
                                       <label> <input type="checkbox" name="" value="" id="weddings" data-id="yesWed"></label> 
                                       

                                       <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array($addspecsexist->extra_vacuum_heads);
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$addspecsexist->extra_vacuum_heads); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='' id='weddings' data-id='yesWed' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                               
                               
                                <td>
                                <?php 
                                     if(empty($addspecsexist->extra_vacuum_heads)){?>
                                     <div id="yesWed" style="display: none">
                                    <input type="text" name="extra_vacuum_heads" id="yesWed" placeholder="" />
                                   </div>
                                    <?php } 
                                    else{ ?>
                                    <input type="text" name="extra_vacuum_heads" id="yesWed" value="{{$addspecsexist->extra_vacuum_heads}}" placeholder="" />

                                    <?php } 
                                   ?>
                                 </td>
                            </tr>
                            <tr>
                            <td></td>
                                <td>Extra Clamps</td>
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($addspecsexist->extra_clamps)){ ?>
                                       <label> <input type="checkbox" id="bday" data-id="yesBday" name="" value="Extra Clamps"></label> 
                                       
                                 <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array($addspecsexist->extra_clamps);
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$addspecsexist->extra_clamps); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='' id='bday' data-id='yesBday' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                               
                                <td><?php 
                                     if(empty($addspecsexist->extra_clamps)){?>
                                     <div id="yesBday" style="display: none">
                                    <input type="text" name="extra_clamps" id="yesBday" placeholder="" />
                                   </div>
                                    <?php } 
                                    else{ ?>
                                    <input type="text" name="extra_clamps" id="yesBday" value="{{$addspecsexist->extra_clamps}}" placeholder="" />

                                    <?php } 
                                   ?> </td>
                            </tr>
                            <tr>
                            <td></td>
                                <td>Extra Standard Hose</td>
                               
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($addspecsexist->extra_standard_hose)){ ?>
                                       <label> <input type="checkbox" id="hose" data-id="yesHose" name="" value=""></label>                                  <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array($addspecsexist->extra_standard_hose);
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$addspecsexist->extra_standard_hose); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='' id='hose' data-id='yesHose' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                    <td><?php 
                                     if(empty($addspecsexist->extra_standard_hose)){?>
                                     <div id="yesHose" style="display: none">
                                    <input type="text" name="extra_standard_hose" id="yesHose" placeholder="" />
                                   </div>
                                    <?php } 
                                    else{ ?>
                                    <input type="text" name="extra_standard_hose" id="yesHose" value="{{$addspecsexist->extra_standard_hose}}" placeholder="" />

                                    <?php } 
                                   ?> </td>
                            </tr>
                            <tr>
                            <td></td>
                                <td>Extra Heavy Duty Hose</td>
                             
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($addspecsexist->heavy_duty)){ ?>
                                       <label> <input type="checkbox" name="" id="duty" data-id="yesDuty" value=""></label>                                  <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array($addspecsexist->heavy_duty);
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$addspecsexist->heavy_duty); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='' id='duty' data-id='yesDuty' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                    <td><?php 
                                     if(empty($addspecsexist->heavy_duty)){?>
                                     <div id="yesDuty" style="display: none">
                                    <input type="text" name="heavy_duty" id="yesDuty" placeholder="" />
                                   </div>
                                    <?php } 
                                    else{ ?>
                                    <input type="text" name="heavy_duty" id="yesDuty" value="{{$addspecsexist->heavy_duty}}" placeholder="" />

                                    <?php } 
                                   ?> </td>
                            </tr>
                            <tr>
                            <td></td>
                                <td>Extra Impeller</td>
                                <td class="col3"><label>
                                    
                                    <?php
                                        if(empty($addspecsexist->impeller)){ ?>
                                       <label> <input type="checkbox" name="" id="impeller" data-id="yesImpeller"  value=""></label>                                  <?php } 
                                        else{ ?>
                                        <?php

                                            $all_type = array($addspecsexist->impeller);
                                            //$fruit = "apple,orange,banana";
                                            $multitype = explode('/',$addspecsexist->impeller); // convert selecte fruits to array
                                            foreach ($all_type as $value){
                                            $checkedStatus = "";
                                            // check if $fruit in $selected fruit array - make it checked
                                            if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                                            echo "<label><input name='' id='impeller' data-id='Impeller' type='checkbox' ".$checkedStatus." value='".$value."'/></label>"; 
                                            }
                                            ?> 
                                        <?php } 
                                   ?>
                                    </td>
                                
                                    <td><?php 
                                     if(empty($addspecsexist->impeller)){?>
                                     <div id="yesImpeller" style="display: none">
                                    <input type="text" name="impeller" id="yesImpeller" placeholder="" />
                                   </div>
                                    <?php } 
                                    else{ ?>
                                    <input type="text" name="impeller" id="yesImpeller" value="{{$addspecsexist->impeller}}" placeholder="" />

                                    <?php } 
                                   ?> </td>
                            </tr>
                     </table>
                     </div>
                    <div class="mybtn">
                        <button type="submit" class="btn">Save changes</button>
                        <a href="{{route('sales_order.add', $resultdata->order_number)}}" class="btn">Back</a>

                     </div>
                  </form>
                  @endforeach

            </div>
            
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

    /*global window */
(function ($) {
    "use strict";
    $(document.body).delegate('[type="checkbox"][readonly="readonly"]', 'click', function(e) {
        e.preventDefault();
    });
    
    $('#test-form').submit(function(e) {
        $('.code').first().html($(this).serialize());
        return false;
    });
}(window.jQuery));
</script>
<script type="text/javascript">
  $(function() {
  $('input[type="checkbox"]').click(function() {
  var id = $(this).attr("data-id");
    
    if ($(this).is(":checked")) {
      $('#'+id).show();
    } else {
      $('#'+id).hide();
    }
  });
});
</script>
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
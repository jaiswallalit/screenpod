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
   #sheet-container {
        width: 250px;
        height: 100px;
        border: 1px solid black;
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
   p.orderenq{
    margin: 20px 10px;
    font-size: 18px;
}
table td.grand {
  border-top: 1px solid #5D6975;
}

table tr:nth-child(2n-1) td {
  background: #fff;
  border: 1px solid;
}
.info td {
    width: 600px;
    padding: 10px;
    font-size: 16px;
}
table.info {
    margin-top: 20px;
    margin-bottom: 20px;
}
td {
    border: 1px solid;
}
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Hire Contract  Details</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Hire Contract</li>
               </ol>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
   <div class="card">
      
      <div class="card-body">
      @foreach ($machin as  $resultdata)
        <?php 
        $hireinfo = DB::table('hire_info')->where('quote_id',$resultdata->quote_id)->where('product_id',$resultdata->product_id)->first();
        $statements = DB::table('statements')->where('hire_orders_id',$resultdata->id)->first();
        
        ?>
        
      @endforeach
   
      <div class="row align-items-end">
      <div class="col-md-4">
        <span><strong> Contract Offer </strong></span>
        </div>
        <div class="col-md-4">
        <img src="https://screenpod.demodmcconsultancy.com/public/assets/admin/dist/img/logo.jpg" alt=""  style="display: block; padding: 0;" width="100px"> 
        </div>
       
        <div class="col-md-4 text-right">
        @foreach ($result as  $results)
      
        <span class="align-bottom"><strong>Agreement No: {{$results->agreement_no}} </strong></span>
        @endforeach
        </div>
        </div>
        <div class="row">
      <p class="orderenq text-justify">We thank you for your order/enquiry and set out below a schedule of plant/equipment which we offer 
      at the rates and terms noted and subject to the CPA Model Conditions for the Hiring of Plant (2001)
       - "The CPA Conditions". The appropriate set of conditions is attached. The plant is subject to 
       being available to the owner when the Hirer's acceptance of the Contract is received by the Owner.
        Please sign the ACCEPTANCE STATEMENT below and return to the owner.</p>
        </div>

        <div class="row">
        <div class="col-md-12">
        <span class="align-bottom"><strong>Date of offer: {{$results->date}} </strong></span>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
       
        <table class="info">
        <tbody>
          <tr style="background: #fff;">
          <td colspan="2">From:  {{$user->name}}<br>
          Company: Screenpod Design and Manufacturing Ltd<br>
          Tel: {{$user->mobile}}
        </td>
        <td colspan="2">To: {{$customer->name}}<br>
          Company: {{$customer->company}}<br>
          Tel:{{$customer->telephone}}</td>
          </tr>
        </tbody>
       </table>
      </div>
        </div>
        <form action="{{route('hire_order.updateinfo')}}" method="post">
         {{csrf_field()}}
         <input type="hidden" name="quote_id" value="{{$results->quote_id}}">
          <input type="hidden" name="product_id" value="{{$results->product_id}}">
          <input type="hidden" name="hire_orders_id" value="{{$results->id}}">
        <div class="row">
        <div class="col-md-12">
        <span><strong>Hire terms</strong></span>

        <table class="info">
        <tbody>
          <tr style="background: #fff;">
          <td>Minimum initial hire period</td>
        <td>
        <input type="text" name="min_hire_period" class="form-control" id="min_hire_period" placeholder="min_hire_period" value="<?php if(!empty($hireinfo)){echo $hireinfo->min_hire_period;} ?>">
       
        </td>
          </tr>
          <tr>
          <td>Payment terms</td>
          <td>
          <input type="text" name="payment_terms" class="form-control" id="payment_terms"  value="<?php if(!empty($hireinfo)){echo $hireinfo->payment_terms;} ?>">

          </td>
          </tr>
          <tr style="background: #fff;">
          <td>100% Hire back against purchase period</td>
          <td>
          <input type="text" name="purcharse_period" class="form-control" id="purcharse_period"  value="<?php if(!empty($hireinfo)){echo $hireinfo->purcharse_period;} ?>">

          </td>
          </tr>
         
          <tr style="background: #fff;">
          <td>Consumables</td>
          <td>
          <input type="text" name="consumables" class="form-control" id="consumables"  value="<?php if(!empty($hireinfo)){echo $hireinfo->consumables;} ?>">

          </td>
          </tr>
        </tbody>
       </table>
      </div>
        </div>
       
        <div class="row">
         <div class="col-md-12">
         <p><strong>Hire, services and additional consumables rates</strong></p>
       <table class="info">
        <tbody>
          <tr style="background: #fff;">
          <td>Transport in</td>
          <td>
          <input type="text" name="transport_in" class="form-control" id="transport_in"  value="<?php if(!empty($hireinfo)){echo $hireinfo->transport_in;} ?>">

          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Weekly hire</td>
          <td>
              <input type="text" name="weekly_hire_price" class="form-control" id="weekly_hire_price"  value="<?php if(!empty($hireinfo)){echo $hireinfo->weekly_hire_price;} ?>">
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Fitting</td>
          <td>
              <input type="text" name="fittings_price" class="form-control" id="fittings_price"  value="<?php if(!empty($hireinfo)){echo $hireinfo->fittings_price;} ?>">

          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Transport out</td>
          <td>
              <input type="text" name="transport_out_price" class="form-control" id="transport_out_price"  value="<?php if(!empty($hireinfo)){echo $hireinfo->transport_out_price;} ?>">

          </td>
          </tr>
          
        </tbody>
        
       </table>
         </div>
        </div>


        <div class="row">
         <div class="col-md-12">
         <p><strong>Hire Details</strong></p>
       <table class="info">
        <tbody>
          <tr style="background: #fff;">
          <td>Delivery address</td>
          <td>
              <input type="text" name="delivery_location" class="form-control" id="delivery_location"  value="<?php if(!empty($hireinfo)){echo $hireinfo->delivery_location;} ?>">

          </td>
          
          </tr>
          <tr style="background: #fff;">
          <td>Site contact</td>
          <td>
              <input type="text" name="site_contact" class="form-control" id="site_contact"  value="<?php if(!empty($hireinfo)){echo $hireinfo->site_contact;} ?>">

          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Period of hire (4 weeks minimum)</td>
          <td>
              From: <input type="date" name="hire_start" class="form-control" id="hire_start"  value="<?php if(!empty($hireinfo)){echo $hireinfo->hire_start;} ?>">
              To: <input type="date" name="hire_end" class="form-control" id="hire_end"  value="<?php if(!empty($hireinfo)){echo $hireinfo->hire_end;} ?>">
          </td>
          </tr>
          
        </tbody>
       </table>
         </div>
        </div>
        <button type="submit" class="btn btn-custom">Save changes</button>
        </form>
        <div class="row">
         <div class="col-md-12">
         
       <table class="info">
       <tbody>
          <tr style="background: #fff;">
          <td><strong>TERMS</strong> <br>
          1)this is a fixed term contract for 4 weeks minium. 2) Max 40 hours per 5 day working week. 3) Hirer to refuel the machine. 4) If equipment is returned prior to the end of the rented period a charge will be applied for the remaining period. 6) All other terms and conditions as per CPA July 2011 (attached) Acceptance statement</td>
          <td><strong>Machine Insurance</strong><br>
          It is the responsibility of the hirer to ensure the appropriate business insurance is in place and that the machine hired is insured to the value of: £39,000</td>
          </tr>
          
        </tbody>
       </table>

       <table class="info">
        <tbody>
          <tr style="background: #fff;">
          <td><strong>TERMS</strong> <br>
          1)this is a fixed term contract for 4 weeks minium. 2) Max 40 hours per 5 day working week. 3) Hirer to refuel the machine. 4) If equipment is returned prior to the end of the rented period a charge will be applied for the remaining period. 6) All other terms and conditions as per CPA July 2011 (attached) Acceptance statement</td>
          <td><strong>Machine Insurance</strong><br>
          It is the responsibility of the hirer to ensure the appropriate business insurance is in place and that the machine hired is insured to the value of: £39,000</td>
          </tr>
          
        </tbody>
       </table>
     
      
         </div>
        </div>

        <div class="row">
         <div class="col-md-12">
       
       <p><strong>Acceptance statement</strong></p>
       <form action="{{route('hire_order.statement')}}" method="post">
         {{csrf_field()}}
          <input type="hidden" name="hire_orders_id" value="{{$results->id}}">
       <table class="info">
        <tbody>
          <tr style="background: #fff;">
          <td>Signature</td>
          <td>
            
          <div id="sheet-container">
      <canvas id="sheet"  width="250" height="100"></canvas>
    </div>
    <input type="button" class="btn btn-default btn-sm" id="saveSign" value="Add Signature">
    <button class="btn btn-danger btn-sm" id="clearSignature">Clear Signature</button>
    <!--Add signature here -->
      <div id="signature">
      </div>
</td>
 
         </tr>
          <tr style="background: #fff;">
          <td>Print name</td>
          <td><input type="text" name="print_name" class="form-control" id="print_name"  value="<?php if(!empty($statements)){echo $statements->print_name;} ?>"></td>
          </tr>
          <tr style="background: #fff;">
          <td>Company name</td>
          <td><input type="text" name="company_name" class="form-control" id="company_name"  value="<?php if(!empty($statements)){echo $statements->company_name;} ?>"></td>
          </tr>
          <tr style="background: #fff;">
          <td>Position</td>
          <td><input type="text" name="position" class="form-control" id="position"  value="<?php if(!empty($statements)){echo $statements->position;} ?>"></td>
          </tr>
        </tbody>
       </table>
       <button type="submit" class="btn btn-custom">Save changes</button>

       <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-xxxxx/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.3/fabric.js'></script>
<script>
            var canvas = new fabric.Canvas('sheet');
            canvas.isDrawingMode = true;
            canvas.freeDrawingBrush.width = 1;
            canvas.freeDrawingBrush.color = "#ff0000";
            $( '#saveSign' ).click( function( e ) {
                e.preventDefault();
                var canvas = document.getElementById("sheet");
                var dataUrl =  canvas.toDataURL("image/png"); //
                var saveButton = $(this).val();
                if(saveButton == "Add Signature"){
                    //alert(dataUrl); check if canvas is empty
                    var blank = isCanvasBlank(canvas);
                    if(blank){
                        alert('Signature can\'t be empty');
                        return false;
                    }
                    //Pass signature to the form.
                    var signature = document.getElementById('signature');
                    signature.innerHTML = '<input type="hidden" name="signature" value="'+dataUrl+'">';
                    $(this).val('Remove Signature'); //Update button text
                }else if(saveButton == "Remove Signature"){
                    var signature = document.getElementById('signature');
                    signature.innerHTML = '';
                    $(this).val("Add Signature");
                }
            });
            //Clear signature
           $('#clearSignature').click(function (e) {
               e.preventDefault();
               canvas.clear();
           });
           //Check if canvass is empty
           function isCanvasBlank(canvas) {
               var blank = document.createElement('canvas');
               blank.width = canvas.width;
               blank.height = canvas.height;
               return canvas.toDataURL() == blank.toDataURL();
           }
    </script>
       </form>
       <p><strong>Footnotes:</strong></p>
       <p class="orderenq text-justify">1. Hirer is responsible for damage whilst on hire, inc. tyres and puncture repairs.
         Any excessive damage to shredder teeth may be charged. 
         2. Normal Belt wear is included in the hire rate, except continued use of misaligned belts. 
         3. If plant supplied without an operator, the hirer is to ensure the plant is operated by a competent operator. 
         4. Unless otherwise agreed in writing the Hirer is responsible for insuring against his liabilities under clauses 8 and 13
          of the CPA Conditions. S. Acceptance of the plant on site implies acceptance of all terms and conditions
           stated on this offer (see clause 3 of the CPA Conditions) unless otherwise agreed in writing.
            6. In accordance of clause 24 of the CPA Conditions where the hire period is indeterminate, 
            it may be determined on 7 days written notice. 7. Fuel to be supplied by hirer, 
            unless otherwise agreed in writing. 8. If any provision in this Contract shall be held to be illegal,
            invalid or unenforceable, in whole or in part, such provision (or part) shall to that extent be deemed not to form part of this agreement but the legality, 
            validity and enforceability of the remainder of this Agreement shall not be affected.</p>
            <p class="orderenq" style="text-align: right;">Screenpd Design and Manufacturing Ltd,<br> 30 Tullyodonnell Road, Dungannon, Co. Tyrone Northern Ireland. BT70 3JE</p>
       
      
         </div>
        </div>

      </div>
   </div>
   </section>
</div>

@endsection

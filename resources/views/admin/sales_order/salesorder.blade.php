<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 3</title>
    <style>
/* .clearfix:after {
  content: "";
  display: table;
  clear: both;
} */

a {
  color: #001028;
  text-decoration: none;
}

body {
  font-family: Junge;
  position: relative;
  width: 100%;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-size: 14px; 
}

.arrow {
  margin-bottom: 4px;
}

.arrow.back {
  text-align: right;
}

.inner-arrow {
  padding-right: 10px;
  height: 30px;
  display: inline-block;
  background-color: rgb(233, 125, 49);
  text-align: center;

  line-height: 30px;
  vertical-align: middle;
}

.arrow.back .inner-arrow {
  background-color: rgb(233, 217, 49);
  padding-right: 0;
  padding-left: 10px;
}

.arrow:before,
.arrow:after {
  content:'';
  display: inline-block;
  width: 0; height: 0;
  border: 15px solid transparent;
  vertical-align: middle;
}

.arrow:before {
  border-top-color: rgb(233, 125, 49);
  border-bottom-color: rgb(233, 125, 49);
  border-right-color: rgb(233, 125, 49);
}

.arrow.back:before {
  border-top-color: transparent;
  border-bottom-color: transparent;
  border-right-color: rgb(233, 217, 49);
  border-left-color: transparent;
}

.arrow:after {
  border-left-color: rgb(233, 125, 49);
}

.arrow.back:after {
  border-left-color: rgb(233, 217, 49);
  border-top-color: rgb(233, 217, 49);
  border-bottom-color: rgb(233, 217, 49);
  border-right-color: transparent;
}

.arrow span { 
  display: inline-block;
  width: 80px; 
  margin-right: 20px;
  text-align: right; 
}

.arrow.back span { 
  margin-right: 0;
  margin-left: 20px;
  text-align: left; 
}

h1 {
  color: #5D6975;
  font-family: Junge;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 2em 0;
}

h1 small { 
  font-size: 0.45em;
  line-height: 1.5em;
  float: left;
} 

h1 small:last-child { 
  float: right;
} 

#project { 
  float: left; 
}

#company { 
  float: right; 
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 30px;
}

table th,
table td {
  text-align: center;
  border: 1px solid;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: left;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.sub {
  border-top: 1px solid #C1CED9;
}

table td.grand {
  border-top: 1px solid #5D6975;
}

table tr:nth-child(2n-1) td {
  background: #fff;
  border: 1px solid;
}

table tr:last-child td {
  background: #fff;
}

#details {
  margin-bottom: 30px;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <main>
      
      <h1 style="vertical-align: text-bottom"  class="clearfix">
        <small><span>Hire Contract Offer</span></small> <img src="https://screenpod.demodmcconsultancy.com/public/assets/admin/dist/img/logo.jpg" alt=""  style="display: block; padding: 0;" width="100px"> <small>
          <span>@foreach($contracts as $key => $contract)
          Agreement No: {{$contract->agreement_no}}
        
</span></small></h1>
     <p style="text-align: justify;" >We thank you for your order/enquiry and set out below a schedule of plant/equipment which we offer 
      at the rates and terms noted and subject to the CPA Model Conditions for the Hiring of Plant (2001)
       - "The CPA Conditions". The appropriate set of conditions is attached. The plant is subject to 
       being available to the owner when the Hirer's acceptance of the Contract is received by the Owner.
        Please sign the ACCEPTANCE STATEMENT below and return to the owner.</p>
        <p><strong>Date of offer: {{$contract->offer_date}}</strong></p>
       <table>
        <tbody>
          <tr style="background: #fff;">
          <td>From:  {{$users->name}}<br>
          Company: Screenpod Design and Manufacturing Ltd<br>
          Tel: {{$users->mobile}}
        </td>
          <td>To: {{$contract->name}}<br>
          Company: {{$contract->company_name}}<br>
          Tel:{{$contract->telephone}}</td>
          </tr>
          @endforeach
        </tbody>
       </table>
      
       @foreach($products as $key => $product)
       <?php
         
        $productData = DB::table('products')->where('id',$product->product_id)->first();
         //$producthireinfo = DB::table('hire_info')->where('quote_id',$product->quote_id)->where('product_id',$product->product_id)->first();
        
         //$productTradeData = DB::table('trade_ins')->where('quote_id',$product->quote_id)->where('old_product_id',$product->product_id)->first();
         $productdescription = strip_tags($productData->description);
        ?>
        @foreach($producthireinfo as $key => $producthireinfo)
        @if(!empty($producthireinfo))
       <p><strong>Hire terms</strong></p>
       <table>
        <tbody>
          <tr style="background: #fff;">
          <td>Minimum initial hire period</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->min_hire_period}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Payment terms</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->payment_terms}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>100% Hire back against purchase period</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->purcharse_period}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Hire items descriptions</td>
          <td>
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Consumables</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->consumables}}
              @endif
          </td>
          </tr>
       
        </tbody>
       </table>
        <p><strong>Hire, services and additional consumables rates</strong></p>
       <table>
        <tbody>
          <tr style="background: #fff;">
          <td>Transport in</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->transport_in}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Weekly hire</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->weekly_hire_price}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Fitting</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->fittings_price}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Transport out</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->transport_out_price}}
              @endif
          </td>
          </tr>
          
        </tbody>
        
       </table>
        <p><strong>Hire Details</strong></p>
       <table>
        <tbody>
          <tr style="background: #fff;">
          <td>Delivery address</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->delivery_location}}
              @endif
          </td>
          
          </tr>
          <tr style="background: #fff;">
          <td>Site contact</td>
          <td>@if(!empty($producthireinfo))
              {{$producthireinfo->site_contact}}
              @endif
          </td>
          </tr>
          <tr style="background: #fff;">
          <td>Period of hire (4 weeks minimum)</td>
          <td>@if(!empty($producthireinfo))
          From: {{$producthireinfo->hire_start}}
          To: {{$producthireinfo->hire_end}}

              @endif
          </td>
          </tr>
          
        </tbody>
       </table>
       @endif
       @endforeach
       @endforeach

       <table>
        <tbody>
          <tr style="background: #fff;">
          <td><strong>TERMS</strong> <br>
          1)this is a fixed term contract for 4 weeks minium. 2) Max 40 hours per 5 day working week. 3) Hirer to refuel the machine. 4) If equipment is returned prior to the end of the rented period a charge will be applied for the remaining period. 6) All other terms and conditions as per CPA July 2011 (attached) Acceptance statement</td>
          <td><strong>Machine Insurance</strong><br>
          It is the responsibility of the hirer to ensure the appropriate business insurance is in place and that the machine hired is insured to the value of: £39,000</td>
          </tr>
          
        </tbody>
       </table>
       <p><strong>Acceptance statement</strong></p>
       <table>
        <tbody>
          <tr style="background: #fff;">
          <td>Signature</td>
          <td></td>
          </tr>
          <tr style="background: #fff;">
          <td>Print name</td>
          <td></td>
          </tr>
          <tr style="background: #fff;">
          <td>Company name</td>
          <td></td>
          </tr>
          <tr style="background: #fff;">
          <td>Position</td>
          <td></td>
          </tr>
        </tbody>
       </table>
       <p><strong>Footnotes:</strong></p>
       <p>1. Hirer is responsible for damage whilst on hire, inc. tyres and puncture repairs.
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
            <p style="text-align: right;">Screenpd Design and Manufacturing Ltd,<br> 30 Tullyodonnell Road, Dungannon, Co. Tyrone Northern Ireland. BT70 3JE</p>
       
      
    </main>
   
  </body>
</html>
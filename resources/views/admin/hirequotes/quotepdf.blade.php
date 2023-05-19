<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Email</title> 
</head>

<body>

<table style="width:100%; border-collapse: collapse; border: 0px solid black;">
  <tr style="background-color: #f1f1f1;">
    <th style="text-align: left;
    padding: 8px;" colspan="2"><a href="#" target="_blank"><img src="https://screenpod.demodmcconsultancy.com/public/assets/admin/dist/img/logo.jpg" alt="" border="0" style="display: block; padding: 0;" width="100px"></th>
    <th colspan="2">
 <p style="margin: 0 0 4px 0;">{{date('d F Y',strtotime($quote->sent_on))}}</p>
   <p style="margin: 0 0 4px 0;">Re: Quotation</p>
 <p style="margin: 0 0 4px 0;">Dear {{$customer->name}},</p>
  </tr>
  <tr style="background-color: #f1f1f1;">
  	<td colspan="4" style="text-align: center;
    font-size: 18px;
    line-height: 2; padding: 8px;">As discussed, Please find quotation details below,</td>
  </tr>
    @foreach($products as $key => $product)
         <?php
          
        $productData = DB::table('products')->where('id',$product->product_id)->first();
         $productExtraData = DB::table('product_extra_info')->where('quote_id',$quote->id)->where('product_id',$product->product_id)->first();
         $productTradeData = DB::table('trade_ins')->where('quote_id',$quote->id)->where('old_product_id',$product->product_id)->first();
          $productdescription = strip_tags($productData->description);
        ?>
 <tr style="background-color: #fe7e0f;">
    <td style=" padding: 8px;">Product Name</td>
    <td style=" padding: 8px;">Quantity</td>
    <td style=" padding: 8px;">Unit Price</td>
    <td style=" padding: 8px;">Total Price</td>
  </tr>
  <tr>
    <td style=" padding: 8px;"> {{$productData->title}}</td>
    <td style=" padding: 8px;">{{$product->quantity}}</td>
    <td style=" padding: 8px;"> {{ $product->currency }}{{ $product->machine_price }}</td>
    <td style=" padding: 8px;"> {{ $product->currency }} {{number_format($product->total_price,2)}} plus vat</td>
  </tr>
  <tr>
  	<td colspan="4">
        <h2>Product Description</h2>
  		<p style="text-align: justify;
    font-size: 16px;
    line-height: 2; padding: 8px;">{{$productdescription}}</p>
</td>
  </tr>

</table>
@if(!empty($productData->attachment))
               <p><a href="https://screenpod.demodmcconsultancy.com/public/admin/clip-one/assets/products/attachment/{{$productData->attachment}}" download="{{$productData->attachment}}">Download Attachment</a>

            </p>
            
               @endif
<p><b>Comment</b></p>
<table style="width:100%; ">
  <tr style="background-color: #fe7e0f;">
    <td style=" padding: 8px;">Depot</td>
    <td style=" padding: 8px;">Hitch</td>
    <td style=" padding: 8px;"> Buckets</td>
    <td style=" padding: 8px;">Extra</td>
    <td style=" padding: 8px;">Loader</td>
    <td style=" padding: 8px;">Warranty</td>
    <td style=" padding: 8px;">Cab type</td>
    <td style=" padding: 8px;">Tyres</td>
    <td style=" padding: 8px;">Accessories</td>
  </tr>
  <tr  style="background-color: #f1f1f1;">
      <td style=" padding: 8px;">@if(!empty($productExtraData))
                     {{$productExtraData->depot}}
                  @endif</td>
    <td style=" padding: 8px;">
     @if(!empty($productExtraData)) Hitch: {{$productExtraData->hitch}}
     @endif
   </td>
    <td style=" padding: 8px;"> @if(!empty($productExtraData))
                      {{$productExtraData->buckets}}
                  @endif</td>
    <td style=" padding: 8px;"> @if(!empty($productExtraData))
                     {{$productExtraData->extra}}
                  @endif</td>
    <td style=" padding: 8px;">@if(!empty($productExtraData))
                   {{$productExtraData->loader}}
                  @endif</td>
    <td style=" padding: 8px;"> @if(!empty($productExtraData))
                   {{$productExtraData->warranty}}
                  @endif</td>
    <td style=" padding: 8px;">@if(!empty($productExtraData))
                  {{$productExtraData->cabtype}}
                  @endif</td>
    <td style=" padding: 8px;">@if(!empty($productExtraData))
                   {{$productExtraData->tyres}}
                  @endif</td>
    <td style=" padding: 8px;">     @if(!empty($productExtraData))
                   {{$productExtraData->accessories}}
                  @endif</td>
   
                 
  </tr>
  </table>
  <p><b>Tradein</b></p>
<table style="width:100%; ">
  <tr style="background-color: #fe7e0f;">
    <td style=" padding: 8px;">Make</td>
    <td style=" padding: 8px;">Mode</td>
    <td style=" padding: 8px;"> Year</td>
    <td style=" padding: 8px;">Hours</td>
     <td style=" padding: 8px;">Trade Price</td>

  </tr>
  <tr  style="background-color: #f1f1f1;">
     <td style=" padding: 8px;">@if(!empty($productTradeData))
                {{$productTradeData->make}}
                 @endif</td>
    <td style=" padding: 8px;">@if(!empty($productTradeData)) 
                {{$productTradeData->model}}
                 @endif</td>
    <td style=" padding: 8px;"> @if(!empty($productTradeData))
                  {{$productTradeData->year}}
                 @endif</td>
    <td style=" padding: 8px;"> @if(!empty($productTradeData))
                 {{$productTradeData->hours}}
                 @endif</td>
    <td style=" padding: 8px;"> @if(!empty($productTradeData))
                 {{$productTradeData->price}}
                 @endif</td>
  </tr>
 
  @endforeach
     
                 
  </table>

  <table style="width:100%; ">
	 <tr>
         <td colspan="4" style="color: #333; letter-spacing: .4px;">
            <p style="margin: 20px 0 5px 0; font-weight: 600;"> 
             Sales reps <br>
                 Name:{{$users->name}}<br>
                Email :{{$users->email}}<br>
                Phone No.:{{$users->mobile}}<br>
               <br>    
        
            </p>
         </td>
      </tr>
      <tr style="background-color: #f1f1f1;">
  	<td colspan="4" style="text-align: left;
    font-size: 18px;
    line-height: 2; padding: 8px;"> 
<p><i>Quotation valid for 21 days only</i> <br>If you have any queries or require any further information please do not hesitate to contact me on {{$users->mobile}} alternatively on email <a href="mailto:{{$users->email}}">{{$users->email}}</a>
</p></td>
  </tr>
      <tr>
      	<td colspan="4" style="color: #333; letter-spacing: .4px;">
            <p style="margin: 20px 0 6px 0; font-weight: 600;">Regards</p>
            <p style="background-color: #a5a5a5; height: 1px; width: 200px; margin: 9px 0 9px 0;"></p>
            <p style="margin: 0 0 6px 0; font-weight: 600;">{{$users->name}}</p>
            <p style="margin: 0 0 6px 0; font-weight: 600;">{{$users->mobile}}</p>
         </td>
      </tr>
        <tr style="background-color: #fe7e0f;">
            <td colspan="4" style="color: #333; letter-spacing: .4px; text-align: center;">
               <p style="padding: 10px 0;">
                  <b>Copyright © 2023 Screenpod. All rights reserved.</b>
               </p>
            </td>
         </tr>
</table>

   
</body>
</html>
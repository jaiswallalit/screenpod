<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Email</title> 
</head>

<body>
   <table style="width: 100%; margin: 0 auto; font-family: sans-serif;" border="0">
      <tr>
         <td colspan="2" align="center" valign="middle" style="padding:5px 0;">
            <a href="#" target="_blank"><img src="{{asset('assets/front/images/logo.png')}}" alt="" border="0" style="margin:0 auto;display: block; padding: 0;" width="100px"></a>
         </td> 
      </tr>
      <tr style="background-color: #f1f1f1;">
         <td colspan="2" style="padding: 16px; color: #333; letter-spacing: .4px;">
            <p style="margin: 0 0 4px 0;">{{date('d F Y',strtotime($quote->sent_on))}}</p>
            <p style="margin: 0 0 4px 0;">Re: Quotation</p>
            <p style="margin: 0 0 4px 0;">Dear {{$customer->name}},</p>
         </td>
      </tr>

      <tr style="background-color: #eaeaea;">
         <td colspan="2" style="padding: 16px; color: #333; letter-spacing: .4px;">As discussed, Please find quotation details below,</td>
      </tr>

      @foreach($products as $key => $product)
         <?php
            $productData = DB::table('products')->where('id',$product->product_id)->first();

         $productExtraData = DB::table('product_extra_info')->where('quote_id',$quote->id)->where('product_id',$product->product_id)->first();
         $productTradeData = DB::table('trade_ins')->where('quote_id',$quote->id)->where('old_product_id',$product->product_id)->first();
 $productdescription = strip_tags($productData->description);
         ?>
         <tr>
            <td style="padding: 20px 0 0 0; color: #333; letter-spacing: .4px;">
               <p style="margin: 0; color: #f11512; font-weight: 600;"> <i>{{$product->quantity}} x {{$productData->title}}</i> </p> 
               <br>
               Unit Price €{{ $product->price }}
               <br>
               <p style="padding: 16px; color: #333; letter-spacing: .4px;">{{$productdescription}}</p> 

                @if(!empty($productData->attachment))
               <p>
               <a href="https://screenpod.demodmcconsultancy.com/public/admin/clip-one/assets/products/attachment/{{$productData->attachment}}" download="{{$productData->attachment}}">Download Attachment</a>
            </p>
               @endif


               <p>
                  <b>Comment</b> - <br>
                  @if(!empty($productExtraData))  
                     Hitch: {{$productExtraData->hitch}}<br>
                  @endif
                  @if(!empty($productExtraData))
                     Buckets: {{$productExtraData->buckets}}<br>
                  @endif
                  @if(!empty($productExtraData))
                     Extra: {{$productExtraData->extra}}<br>
                  @endif
                  @if(!empty($productExtraData))
                     Depot: {{$productExtraData->depot}}<br>
                  @endif
               </p>
                <p>
                 <b> Trade In</b> - <br>
                 @if(!empty($productTradeData)) 
                 model: {{$productTradeData->model}}<br>
                 @endif
                 @if(!empty($productTradeData))
                 year: {{$productTradeData->year}}<br>
                 @endif
                 @if(!empty($productTradeData))
                 hours: {{$productTradeData->hours}}<br>
                 @endif
                 @if(!empty($productTradeData))
                make: {{$productTradeData->make}}<br>
                 @endif
               </p>
               <!--<p>-->
               <!--   <b>Trade In</b> - <br>-->
               <!--   model: {{$productData->model}}<br>-->
               <!--   year: {{$productData->year}}<br>-->
               <!--   hours: {{$productData->hours}}<br>-->
               <!--   weight: {{$productData->weight}}<br>-->
               <!--</p>-->
            </td>
            <td style="padding: 20px 0 0 0; color: #333; letter-spacing: .4px; width: 170px;" valign="top">
               <p style="color: #f11512; margin: 0; font-weight: 600;"> <i>€ {{number_format($product->total_price,2)}} plus vat</i> </p>
            </td>
         </tr>
      @endforeach

      <tr>
         <td colspan="2" style="color: #333; letter-spacing: .4px;">
            <p style="margin: 20px 0 5px 0; font-weight: 600;"> 
             Sales reps <br>
                Name:{{$users->name}}<br>
                Email :{{$users->email}}<br>
                Phone No.:{{$users->mobile}}<br>
               <br>    
        
            </p>
         </td>
      </tr>

      <tr>
         <td colspan="2" style="color: #333; letter-spacing: .4px;">
            <p style="color: #f11512; margin: 20px 0 5px 0; font-weight: 600;"> <i>Quotation valid for 21 days only</i> </p>
         </td>
      </tr>

     <tr>
         <td colspan="2" style="color: #333; letter-spacing: .4px;">If you have any queries or require any further information please do not hesitate to contact me on {{$users->mobile}} alternatively on email <a href="mailto:{{$users->email}}">{{$users->email}}</a> </td>
      </tr>

      <tr>
         <td colspan="2" style="color: #333; letter-spacing: .4px;">
            <p style="margin: 20px 0 6px 0; font-weight: 600;">Regards</p>
            <p style="background-color: #a5a5a5; height: 1px; width: 200px; margin: 9px 0 9px 0;"></p>
            <p style="margin: 0 0 6px 0; font-weight: 600;">{{$users->name}}</p>
            <p style="margin: 0 0 6px 0; font-weight: 600;">{{$users->mobile}}</p>
            <p style="margin: 0 0 6px 0; font-weight: 600;">Screenpod</p>    
         </td>

         <tr>
            <td colspan="2" style="color: #333; letter-spacing: .4px; text-align: center;">
               <p style="line-height: 1.65; background-color: #f1f1f1; padding: 20px 0; margin: 20px 0 0 0;">
                  <b>Screenpod<br>
                       Copyright © 2023 Screenpod. All rights reserved.</b>
               </p>
            </td>
         </tr>
      </tr>
        
   </table>

</body>
</html>
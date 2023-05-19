@extends('admin.layout.master')
@section('content')

<style>
  ul.cus-info li:last-child{
     margin: 20px 0 0 0;
    font-size: 30px;
    font-weight: 700;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hire Quote Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Hire Quote Details</li>
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
              <div class="row">

               <div class="col-12 col-sm-12">
                  <div class="machine-panel">
                     <h1>Selected Machines</h1>
                        <ul class="machine-list">
                           @foreach($products as $product)
                              <li><a href="#"><img src="{{url('/public/admin/clip-one/assets/products/original')}}/{{$product['image']}}" alt=""> <span>{{$product['title']}}</span><span>{{$product['currency']}}{{$product['price']}} X {{$product['quantity']}} = {{$product['currency']}}{{$product['total_price']}}</span><br>
                              {{date('d F Y',strtotime($product['date']))}}
                              
                              </a>
                              
							         <p><strong>Machine Hire Information</strong><br>
                              <span>Min Hire Period : {{$product['min_hire_period']}}</span><br>
                              <span>Payment Terms : {{$product['payment_terms']}}</span><br>
                              <span>Hire back Purcharse Period : {{$product['purcharse_period']}}</span><br>
                              <span>Consumables : {{$product['consumables']}}</span>
                              
                              <span>Transport In : {{$product['transport_in']}}</span><br>
                              <span>Weekly Hire Price : {{$product['weekly_hire_price']}}</span><br>
                              <span>Fittings Price : {{$product['fittings_price']}}</span><br>
                              <span>Transport Out Price : {{$product['transport_out_price']}}</span><br>
                              <span>Delivery Location : {{$product['delivery_location']}}</span>
                              <span>Site Contact : {{$product['site_contact']}}</span><br>
                              <span>Hire Period : From: {{$product['hire_start']}}

To: {{$product['hire_end']}}

                              </span>
                              </p>
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

                        <ul class="cus-info">
                           <li><span>Sales Rep:</span> {{$result->user_name}}</li>
                           <li><span>Lead:</span> {{$result->leads_title}} ({{$result->lead_name}})</li>
                           <li><span>Email:</span> {{$result->email}}</li>
                           <li><span>Contact No.:</span> {{$result->phone}}</li>
                           <li><span>Date:</span> {{date('d F Y',strtotime($result->date))}}</li>
                           <li><span>Time:</span> {{date('h:i A',strtotime($result->date))}}</li>
                           <li><span>Message:</span> <span class="cus-message">{{$result->message}}</span></li>
                           <?php if(!empty($result->attachment)){ 
                              $ext = explode('.', $result->attachment);
                              ?>
                              <li><span>Attachment:</span> 
                                 <a class="" href="{{ asset('/public/admin/clip-one/assets/quotes')}}/{{ $result->attachment }}" target="_blank" downlaod><span>{{$result->attachment}}</span></a>
                                 <i class="far fa-file-{{$icons[$ext[1]]}} fa-5x text-center"/></i>
                              </li>
                           <?php } ?>
                           <li><span>Price:</span> <span class="cus-price">{{$result->currency}}{{number_format($result->price,2)}}</span></li>
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
              <div>
                 <a href="{{route('hirequotes.index')}}" class="btn btn-primary btn-secondary float-sm-right">Back</a>
              </div>
           </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('script')

@endsection
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
            <h1>Sales Quote Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Sales Quote Details</li>
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
                              
							 <p><strong>product extra info</strong><br>
                              <span>Depot : {{$product['depot']}}</span><br>
                              <span>Hitch : {{$product['hitch']}}</span><br>
                              <span>Buckets : {{$product['buckets']}}</span><br>
                              <span>Extra : {{$product['extra']}}</span>
                              </p>
                               <p><strong>TradeIn</strong><br>
                              <span>Make : {{$product['make']}}</span><br>
                              <span>Model : {{$product['model']}}</span><br>
                              <span>Year : {{$product['year']}}</span><br>
                              <span>Hours : {{$product['hours']}}</span><br>
                              <span>Price : {{$product['price']}}</span>
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
				 <a href="{{url('admin/quotes/sendorder')}}/{{$result->id}}" class="btn btn-success mr-2">Create Order </a>
                 <a href="{{route('quotes.index')}}" class="btn btn-primary btn-secondary float-sm-right">Back</a>
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
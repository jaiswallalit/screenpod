@extends('admin.layout.master')
@section('content')
 
<style type="text/css">
   .select12:invalid + .select2 .select2-selection{
       border-color: #dc3545!important;
   }
   .select12:valid + .select2 .select2-selection{
       border-color: #28a745!important;
   }
   *:focus{
     outline:0px;
   }
   .pdfbox .form-group {
    text-align: center;
    margin-top: 5%;
    margin-bottom: 5%;
    border: 1px solid;
    padding: 30px;
    background: #d3d3d3;
    font-size: 17px;
    font-weight: 600;
    color: #fecf00 !important;
}
.pdfbox span {
    color: #000;
}

</style>

<style>
   .custom_close{
     position: relative;
    display: inline-block;
   }
  .custom_close button{
   position: absolute;
    right: 0;
    width: 25px;
    height: 25px;
    line-height: 0;
    text-align: center;
    padding: 0;
    font-size: 10px !important;
}
</style>

<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Equipment</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Equipment View</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">View <small>Equipment</small></h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
          <div class="row">
          <div class="col-md-6">
                              
                              @if (count($productImages)>0)
                                <br>
                                @foreach($productImages as $productImage)
                                 <div class="">
                                    <img style="width: 560px;" src="{{ asset('/admin/clip-one/assets/products/original')}}/{{ $productImage->image }}" alt="" class="product-edit-img" > 
                                 </div>
                                @endforeach
                              @endif


                              <br>
                              <div id="video_file">
                           
                           @if(!empty($result->video_file))
                           <div class="form-group">
                        <label for="video_file">Video File</label><br>
                           </div>
                           <div>
                              <video loop="true" autoplay="autoplay" muted playsinline class="inner-video" width="560px">
                                 <source src="{{url('/public/admin/clip-one/assets/products/video_file/')}}/{{$result->video_file}}" type="video/mp4" >
                              </video>
                           </div>
                           @endif

                           </div>
                           </div>
                           <div class="col-md-6">
                           <div class="post">
                       
                        <?php 
                                 $category = DB::table('categories')->where('id',$result->category_id)->first();
                                 $dealer = DB::table('dealers')->where('id',$result->dealer_id)->first();
                                 $image = DB::table('product_images')->where('product_id',$result->id)->first();
                              ?>
                        <ul class="cus-info">
                           <li><span>Model:</span> {{$result->title}}</li>
                           <li><span>Serial Number:</span> {{$result->stock_number}}</li>
                            <li><span>Brands:</span>
                            {{$dealer->name}}
                           </li>
                           
                           <li><span>categories:</span>
                           {{$category->name}}
                           </li>
                           <li><span>Region:</span>{{$result->region}}</li>
                           <li><span>year.:</span>{{$result->year}}</li>
                           <li><span>Hours:</span> {{$result->hours}}</li>
                           <li><span>Price:</span> {{$result->price}}</li>
                           <li><span>Type:</span> {{$result->type}}</li>
                           <li><span>Status:</span> {{$result->status}}</li>
                           <li><span>Backorder Stock:</span> {{$result->upcoming_quantity}}</li>
                           <li><span>Backorder Stock:</span> {{$result->upcoming_quantity}}</li>
                        </ul>
                        <ul class="cus-info">
                        <li><span><b>Service History</b></span></li>
                       
                           <li><span>Extras:</span><?php if(!empty($service_exist)){echo $service_exist->extras;} ?></li>
                           <li><span>Filters:</span> <?php if(!empty($service_exist)){echo $service_exist->filters;} ?></li>
                           <li><span>Meshes:</span><?php if(!empty($service_exist)){echo $service_exist->meshes;} ?></li>
                           <li><span>Options</span><?php if(!empty($service_exist)){echo $service_exist->options;} ?></li>
                           <li><span>Warranty:</span><?php if(!empty($service_exist)){echo $service_exist->warranty;} ?></li>
                           <li><span>Engine Registrations.:</span><?php if(!empty($service_exist)){echo $service_exist->engine;} ?></li>
                           <li><span>Engine Warranty:</span> <?php if(!empty($service_exist)){echo $service_exist->engine_warranty;} ?></li>
                           <li><span>Tier:</span> <?php if(!empty($service_exist)){echo $service_exist->tier;} ?></li>
                           <li><span><?php if(!empty($service_exist)){echo $service_exist->machine_registration;} ?></li>
                           <li><span>insurance:</span> <?php if(!empty($service_exist)){echo $service_exist->insurance;} ?></li>
                          
                        </ul>
                     </div>
                           </div>
            
            
          </div>

          <div class="row pdfbox">
          <div class="col-md-4">
          <?php if (!empty($result->insurance)){ ?>
                              <div class="form-group">
                                
                               
                                    <a class="" href="{{ asset('/admin/clip-one/assets/products/insurance')}}/{{ $result->insurance }}" target="_blank" downlaod="{{ $result->insurance }}"><span>  <i class="far fa-file-pdf fa-5x text-center"></i><br>
                                    Insurance</span>
                                </a>
                                
                              </div>
                              <?php } ?> 
                           </div>

                           <div class="col-md-4">
                           <?php if (!empty($result->ce_cert)){ ?>
                              <div class="form-group">
                                

                                 
                                <a class="" href="{{ asset('/admin/clip-one/assets/products/ce_cert')}}/{{ $result->ce_cert }}" target="_blank" downlaod="{{ $result->insurance }}"><span><i class="far fa-file-pdf fa-5x text-center"></i><br>
                                CE Cert</span></a>
                              
                              </div>
                              <?php } ?> 
                           </div>
                           <div class="col-md-4">
                           <?php if (!empty($result->attachment)){ ?>
                              <div class="form-group">
                                
                                 
                                    
                                    <a class="" href="{{ asset('/admin/clip-one/assets/products/attachment')}}/{{ $result->attachment }}" target="_blank" downlaod="{{ $result->attachment }}"><span><i class="far fa-file-pdf fa-5x text-center"></i><br>Attachment</span></a>
                                
                              </div>
                              <?php } ?> 
                           </div>

          </div>

       
          </div>
               </div>
            </div>
        
          <div class="card-footer">
              <div>
                 <a href="{{route('products.index')}}" class="btn btn-primary btn-secondary float-sm-right">Back</a>
              </div>
           </div>
      
            <div class="col-md-6"></div>
         </div>
      
   </section>
</div>
@endsection

@section('script')
<script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>



@endsection
  



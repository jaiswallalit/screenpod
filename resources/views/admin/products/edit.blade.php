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
                  <li class="breadcrumb-item active">Equipment Edit</li>
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
                     <h3 class="card-title">Edit <small>Equipment</small></h3>
                  </div>
                  @if (count($errors) > 0)       
                     <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        @foreach ($errors->all() as $error)
                           <span>{{ $error }}</span><br/>
                        @endforeach    
                     </div>         
                  @endif
                  <form id="quickForm" action="{{route('products.update')}}" method="POST" enctype="multipart/form-data" >
                     {{csrf_field()}}
                     <input type="hidden" name="id" value="{{ $result->id }}">

                     <div class="card-body">
                     <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dealer_id">Brands</label>
                                            <select class="form-control" name="dealer_id" id="dealer_id">
                                                <option value="">Select Make</option>
                                                @foreach($dealers as $value)
                                             
                                                <option value="{{$value->id}}" <?php if($result->dealer_id == $value->id){echo "selected";} ?> >{{$value->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="model">Category</label>
                                            <select class="form-control" name="category_id" id="model">
                                            @foreach($categories as $value)
                                             
                                             <option value="{{$value->id}}" <?php if($result->category_id == $value->id){echo "selected";} ?> >{{$value->name}}</option>

                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="stock_number">Serial Number</label>
                                 <input type="text" name="stock_number" class="form-control" id="stock_number" value="{{ $result->stock_number }}" placeholder="Serial Number">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="region">Region</label>
                                 <input type="text" name="region" class="form-control" id="region" value="{{ $result->region }}" placeholder="Region">
                              </div>
                           </div>
            
                        </div>


                        <div class="row">
                          
                        <div class="col-md-3">
                              <div class="form-group">
                                 <label for="title">Model</label>
                                 <input type="text" name="title" value="{{ $result->title }}" class="form-control" id="title" placeholder="Title">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="year">Year</label>
                                 <input type="text" name="year" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" data-mask id="year" value="{{ $result->year }}">
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="hours">Hours</label>
                                 <input type="number" name="hours" class="form-control" id="hours" placeholder="Hours" value="{{ $result->hours }}">
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="weight">Weight</label>
                                 <input type="number" name="weight" step="0.02" class="form-control" id="weight" placeholder="Weight" value="{{ $result->weight }}">
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="description">Description</label>
                           <textarea name="description" id="description" >{{ $result->description }}</textarea>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="price">Price</label>
                                 <input type="number" name="price" class="form-control" id="price" placeholder="Price" step="0.02" value="{{ $result->price }}">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="type">Type</label><br>
                               
                               
                           <?php
                           $all_type = array('New','Used','Hire');
                           //$fruit = "apple,orange,banana";
                           $multitype = explode('/',$result->type); // convert selecte fruits to array
                           foreach ($all_type as $value){
                              $checkedStatus = "";
                              // check if $fruit in $selected fruit array - make it checked
                              if(in_array($value,$multitype)) { $checkedStatus ="checked"; }
                              echo "<label><input name='type[]' type='checkbox' ".$checkedStatus." value='".$value."'/>".$value."</label>"; 
                           }

                              
                        
                           ?>
                              </div>
                           </div>


                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="status">Status</label>
                                 <select name="status" class="status form-control" id="status" data-placeholder="Select status" style="width: 100%;" required>
                                    <option value="">Select status</option>
                                    <option value="Coming Soon" <?php if($result->status == 'Coming Soon'){echo "selected";} ?>>Coming Soon</option>
                                    <option value="In Stock" <?php if($result->status == 'In Stock'){echo "selected";} ?>>In Stock</option>
                                    <option value="Sold" <?php if($result->status == 'Sold'){echo "selected";} ?>>Sold</option>
                                 </select>
                              </div>
                           </div>

                           <div class="col-md-4" id="upcoming_quantity_div">
                              <div class="form-group">
                                 <label for="upcoming_quantity">Backorder Stock </label>
                                 <input type="number" name="upcoming_quantity" value="{{ $result->upcoming_quantity }}" class="form-control" min="0" id="upcoming_quantity" >
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="date">Date</label>
                                 <input type="date" name="date" value="{{ $result->date }}" class="form-control" id="date" >
                              </div>
                           </div>

                        </div>

                        <div class="row">
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="image">Product Images</label>
                                 <input type="file" name="image[]" class="form-control" id="image" accept="image/*" multiple>
                              </div>
                              @if (count($productImages)>0)
                                <br>
                                @foreach($productImages as $productImage)
                                 <div class="custom_close">
                                    <img src="{{ asset('/admin/clip-one/assets/products/thumbnail')}}/{{ $productImage->image }}" alt="" class="product-edit-img"> 
                                      <button type="button" class="btn btn-danger product-edit-btn" id="delete_img" data-id="{{$productImage->id}}"><i class="far fa-trash-alt"></i></button>
                                 </div>
                                @endforeach
                              @endif
                           </div>


                           <div class="col-md-2">
                              <div id="video_file">
                           <div class="form-group">
                              <label for="video_file">Video File</label>
                              <input type="file" name="video_file" class="form-control" id="video_file">
                           </div>
                           @if(!empty($result->video_file))
                           <div>
                              <video loop="true" autoplay="autoplay" muted playsinline class="inner-video" width="150px">
                                 <source src="{{url('/public/admin/clip-one/assets/products/video_file/')}}/{{$result->video_file}}" type="video/mp4" >
                              </video>
                           </div>
                           @endif

                        </div>
                           </div>

                           <?php 
                           if (!empty($result->insurance)) {
                              $string = Str::slug($result->insurance, '.');
                              $array1 = preg_split ("/\./", $string);
                              $ext = end($array1);
                           }else{
                              $ext = '';
                           }

                           ?>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="Insurance">Insurance</label>
                                 <input type="file" name="insurance" class="form-control" id="insurance" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf" ><br>
                                 <?php if (!empty($result->insurance)){ ?>
                                    <i class="far fa-file-{{$icons[$ext]}} fa-5x text-center"/></i>
                                    <a class="" href="{{ asset('/admin/clip-one/assets/products/insurance')}}/{{ $result->insurance }}" target="_blank" downlaod="{{ $result->insurance }}"><span>{{$result->insurance}}</span></a>
                                 <?php } ?> 
                              </div>
                           </div>

                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="ce_cert">CE Cert</label>
                                 <input type="file" name="ce_cert" class="form-control" id="ce_cert" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf" ><br>
                                 <?php if (!empty($result->ce_cert)){ ?>
                                    <i class="far fa-file-{{$icons[$ext]}} fa-5x text-center"/></i>
                                    <a class="" href="{{ asset('/admin/clip-one/assets/products/ce_cert')}}/{{ $result->ce_cert }}" target="_blank" downlaod="{{ $result->insurance }}"><span>{{$result->ce_cert}}</span></a>
                                 <?php } ?> 
                              </div>
                           </div>



                           <?php 
                           if (!empty($result->attachment)) {
                              $string = Str::slug($result->attachment, '.');
                              $array1 = preg_split ("/\./", $string);
                              $ext = end($array1);
                           }else{
                              $ext = '';
                           }

                           ?>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="attachment">Attachment</label>
                                 <input type="file" name="attachment" class="form-control" id="attachment" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf" ><br>
                                 <?php if (!empty($result->attachment)){ ?>
                                    <i class="far fa-file-{{$icons[$ext]}} fa-5x text-center"/></i>
                                    <a class="" href="{{ asset('/admin/clip-one/assets/products/attachment')}}/{{ $result->attachment }}" target="_blank" downlaod="{{ $result->attachment }}"><span>{{$result->attachment}}</span></a>
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>
                        <a href="#" class="btn btn-warning  float-sm-left" data-toggle="modal" data-target="#add_machine"><i class="fas fa-plus"></i> Update Service History </a>

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('products.index')}}" class="btn btn-default btn-secondary">Back</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
          
            <div class="row">
                           
                           <!-- Modal -->
                           <div class="modal fade servicesh" id="add_machine">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h4 class="modal-title">Service History</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                             </div>
                                             <form id="quickForm" action="{{route('products.servicehistory')}}" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <input type="hidden" name="product_id" value="{{$result['id']}}">
                                                <div class="card-body grayform">        
                                                   <div class="form-group">
                                                      <div class="row">
                                                      <div class="col-md-4"><label for="Extras">Extras</label></div>
                                                      <div class="col-md-8"><input type="text" name="extras" class="form-control" id="extras" placeholder="Extras" value="<?php if(!empty($service_exist)){echo $service_exist->extras;} ?>"></div>
                                                      </div>
                                                      
                                                   </div>
                                                   <div class="form-group">
                                                      <div class="row">
                                                      <div class="col-md-4"><label for="Filters">Filters</label></div>
                                                      <div class="col-md-8"><input type="text" name="filters" class="form-control" id="filters" placeholder="filters" value="<?php if(!empty($service_exist)){echo $service_exist->filters;} ?>"></div>
                                                   </div>
                                                   </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Meshes">Meshes</label></div>
                                                      <div class="col-md-8"><input type="text" name="meshes" class="form-control" id="meshes" placeholder="Meshes" value="<?php if(!empty($service_exist)){echo $service_exist->meshes;} ?>"></div>
                                                      </div>
                                                   </div>
                                                   
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Options">Options</label></div>
                                                      <div class="col-md-8"><input type="text" name="options" class="form-control" id="options" placeholder="options" value="<?php if(!empty($service_exist)){echo $service_exist->options;} ?>"></div>
                                                      </div>
                                                   </div>
                                                  
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Warranty">Warranty</label></div>
                                                      <div class="col-md-8"> <input type="text" name="warranty" class="form-control" id="warranty" placeholder="warranty" value="<?php if(!empty($service_exist)){echo $service_exist->warranty;} ?>"></div>
                                                      </div>
                                                   </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Engine Registrations">Engine Registrations</label></div>
                                                      <div class="col-md-8"> <input type="text" name="engine" class="form-control" id="engine" placeholder="Engine Registrations" value="<?php if(!empty($service_exist)){echo $service_exist->engine;} ?>"></div>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4">
                                                      <label for="Engine Warranty">Engine Warranty</label></div>
                                                      <div class="col-md-8"> 
                                                      <input type="text" name="engine_warranty" class="form-control" id="engine_warranty" placeholder="Engine Warranty" value="<?php if(!empty($service_exist)){echo $service_exist->engine_warranty;} ?>">
                                                      </div>
                                                      </div>
                                                   </div>
                                                
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Tier">Tier</label></div>
                                                      <div class="col-md-8"> <input type="text" name="tier" class="form-control" id="tier" placeholder="Tier" value="<?php if(!empty($service_exist)){echo $service_exist->tier;} ?>"></div>
                                                      </div>
                                                      </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                   <div class="col-md-4"><label for="Machine Registration">Machine Registration</label></div>
                                                   <div class="col-md-8"><input type="text" name="machine_registration" class="form-control" id="machine_registration" placeholder="Machine Registration" value="<?php if(!empty($service_exist)){echo $service_exist->machine_registration;} ?>"></div>
                                                      </div>
                                                      </div>
                                                      <div class="form-group">
                                                      <div class="row">
                                                      <div class="col-md-4"><label for="insurance">insurance</label></div>
                                                      <div class="col-md-8"><input type="text" name="insurance" class="form-control" id="insurance" placeholder="insurance" value="<?php if(!empty($service_exist)){echo $service_exist->insurance;} ?>"></div>
                                                      </div>
                                                      </div>
                                                  
                                                </div>
                                                <div class="card-footer">
                                                   <div>
                                                      <button type="submit" class="btn btn-warning">Update</button>
                                                     
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- Modal -->
            <div class="col-md-6"></div>
         </div>
      </div>
   </section>
</div>
@endsection

@section('script')
<script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script>
        $(document).ready(function() {
            /*Load models by make*/
            $('#dealer_id').on('change', function() {
                var id = $(this).find(':selected').val();

                $.ajax({
                    url: "{{ url('admin/products/geteditMakes') }}" + "/" + id,
                    method: "GET",
                    success: function(response) {
                        //console.log(response); 
                        $('#model').html(response);
                    }
                });
            });

           

        });
    </script>
<script>
   var old_status = $('#status').val();
   if (old_status == 'Coming Soon') {
      $('#upcoming_quantity_div').hide();
   }else{
      $('#upcoming_quantity_div').show();
   }

   $('#status').on('change',function(){
      var status = $('#status').val();

      if (status == 'Coming Soon') {
         $('#upcoming_quantity_div').hide();
      }else{
         $('#upcoming_quantity_div').show();
      }
   });
</script>

<script>
$('.select12').select2({
   theme: 'bootstrap4',
   minimumResultsForSearch: Infinity
});

$('#year').inputmask('yyyy', { 'placeholder': 'yyyy' });

$('#description').summernote({
   height: 150,
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
         stock_number: {
            required: true
         },
         backorder_number: {
            required: true
         },
         title: {
            required: true
         },
         date: {
            required: true
         },
         make: {
            required: true
         },
         model: {
            required: true
         },
         year: {
            required: true
         },
         hours: {
            required: true
         },
         weight: {
            required: true
         },
         price: {
            required: true
         },
         type: {
            required: true
         },
         status: {
            required: true
         },
      },
      messages: {
         stock_number: {
            required: "Please enter stock number",
         },
         backorder_number: {
            required: "Please enter backorder number",
         },
         title: {
            required: "Please enter title",
         },
         date: {
            required: "Please select date",
         },
         make: {
            required: "Please enter make",
         },
         model: {
            required: "Please enter model",
         },
         year: {
            required: "Please enter year",
         },
         hours: {
            required: "Please enter hours",
         },
         weight: {
            required: "Please enter weight",
         },
         price: {
            required: "Please enter price",
         },
         type: {
            required: "Please select type",
         },
         status: {
            required: "Please select status",
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

<script>
   $(document).ready(function(){
     $('.product-edit-btn').on('click',function(){
         var id = $(this).data('id');
         
         $.ajax({
             url: "{{ url('admin/products/image/delete') }}/"+id,
             method: "get",
             success: function (response) {
                if(response.msg == 'success'){
                    alert('Image deleted successfully!');
                    location.reload();
                }
             }
         });
     });
   });
</script>

@endsection
  



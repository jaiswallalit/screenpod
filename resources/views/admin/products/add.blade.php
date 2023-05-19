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
   .servicesh .modal-content {
    background: #eaeae9;
}
/* .grayform .form-group {
    display: flex;
}
.grayform label {
    margin-right: 25px;
    margin-top: 10px;
} */
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
                  <li class="breadcrumb-item active">Equipment Add</li>
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
                     <h3 class="card-title">Add <small>Equipment</small></h3>
                  </div>
                  @if (count($errors) > 0)       
                     <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        @foreach ($errors->all() as $error)
                           <span>{{ $error }}</span><br/>
                        @endforeach    
                     </div>         
                  @endif
                  <form id="quickForm" action="{{route('products.save')}}" method="POST" enctype="multipart/form-data" >
                     {{csrf_field()}}
                     <div class="card-body">
                     <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dealer_id">Brands</label>
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
                                            <label for="model">Category</label>
                                            <select class="form-control" name="category_id" id="model">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                       

                        <div id="addDiv">
                           <div class="row">
                     
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="stock_number">Serial Number</label>
                                    <input type="text" name="stock_number[]" class="form-control stock_number" id="stock_number" placeholder="Serial Number" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <!-- <label for="model">Model</label>
                                 <input type="text" name="model" value="{{ old('model') }}" class="form-control" id="model" placeholder="Model"> -->
                                 <label for="region">Region</label>
                                 <input type="text" name="region" value="{{ old('region') }}" class="form-control" id="region	" placeholder="Region">
                              </div>
                           </div>
                           </div>
                        </div>


                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <!-- <label for="model">Model</label>
                                 <input type="text" name="model" value="{{ old('model') }}" class="form-control" id="model" placeholder="Model"> -->
                                 <label for="title">Model</label>
                                 <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Title">
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="year">Year</label>
                                 <input type="text" name="year" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" data-mask id="year" value="{{ old('year') }}">
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="hours">Hours</label>
                                 <input type="number" name="hours" class="form-control" id="hours" placeholder="Hours" value="{{ old('hours') }}">
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="weight">Weight</label>
                                 <input type="number" name="weight" step="0.02" class="form-control" id="weight" placeholder="Weight" value="{{ old('weight') }}">
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="description">Description</label>
                           <textarea name="description" id="description" required></textarea>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="price">Price</label>
                                 <input type="number" name="price" class="form-control" id="price" placeholder="Price" step="0.02" value="{{ old('price') }}">
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="type">Type</label><br>
                               

                                 <label><input type="checkbox" name="type[]" value="New"> New</label>
                                <label><input type="checkbox" name="type[]" value="Used"> Used</label>
                                <label><input type="checkbox" name="type[]" value="Hire"> Hire</label>
                              </div>
                           </div>
                        </div>

                      

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="status">Status</label>
                                 <select name="status" class="status form-control" id="status" data-placeholder="Select status" style="width: 100%;" required>
                                    <option value="">Select status</option>
                                    <option value="Coming Soon">Coming Soon</option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Sold">Sold</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4" id="upcoming_quantity_div">
                              <div class="form-group">
                                 <label for="upcoming_quantity">Backorder Stock </label>
                                 <input type="number" name="upcoming_quantity" value="{{ old('upcoming_quantity') }}" class="form-control" min="0" id="upcoming_quantity" >
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-group">
                                 <label for="date">Date</label>
                                 <input type="date" name="date" value="{{ old('date') }}" class="form-control" id="date" >
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="image">Product Images</label>
                                 <input type="file" name="image[]" class="form-control" id="image" accept="image/*" multiple>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="image">Product Videos</label>
                                 <input type="file" name="video_file" class="form-control" id="video_file">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group">
                                 <label for="Insurance">Insurance</label>
                                 <input type="file" name="insurance" class="form-control" id="Insurance" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf">
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="CE Cert">CE Cert</label>
                                 <input type="file" name="ce_cert" class="form-control" id="ce_cert" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf">
                              </div>
                           </div>
                   

                           <div class="col-md-3">
                              <div class="form-group">
                                 <label for="attachment">Attachment</label>
                                 <input type="file" name="attachment" class="form-control" id="attachment" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf">
                              </div>
                           </div>
                        </div>
                       
                        <!-- <a href="#" class="btn btn-warning  float-sm-right" data-toggle="modal" data-target="#add_machine"><i class="fas fa-plus"></i> Update Service History </a> -->

                        </div>
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
                                              
                                                <div class="card-body grayform">        
                                                   <div class="form-group">
                                                      <div class="row">
                                                      <div class="col-md-4"><label for="Extras">Extras</label></div>
                                                      <div class="col-md-8"><input type="text" name="extras" class="form-control" id="extras" placeholder="Extras"></div>
                                                      
                                                   </div>
                                                   <div class="form-group">
                                                      <div class="row">
                                                      <div class="col-md-4"><label for="Filters">Filters</label></div>
                                                      <div class="col-md-8"><input type="text" name="filters" class="form-control" id="filters" placeholder="filters"></div>
                                                   </div>
                                                   </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Meshes">Meshes</label></div>
                                                      <div class="col-md-8"><input type="text" name="meshes" class="form-control" id="meshes" placeholder="Meshes"></div>
                                                      </div>
                                                   </div>
                                                   
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Options">Options</label></div>
                                                      <div class="col-md-8"><input type="text" name="options" class="form-control" id="options" placeholder="options"></div>
                                                      </div>
                                                   </div>
                                                  
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Warranty">Warranty</label></div>
                                                      <div class="col-md-8"> <input type="text" name="warranty" class="form-control" id="warranty" placeholder="warranty"></div>
                                                      </div>
                                                   </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Engine Registrations">Engine Registrations</label></div>
                                                      <div class="col-md-8"> <input type="text" name="engine" class="form-control" id="engine" placeholder="Engine Registrations"></div>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4">
                                                      <label for="Engine Warranty">Engine Warranty</label></div>
                                                      <div class="col-md-8"> 
                                                      <input type="text" name="engine_warranty" class="form-control" id="engine_warranty" placeholder="Engine Warranty">
                                                      </div>
                                                      </div>
                                                   </div>
                                                
                                                   <div class="form-group">
                                                   <div class="row">
                                                      <div class="col-md-4"><label for="Tier">Tier</label></div>
                                                      <div class="col-md-8"> <input type="text" name="tier" class="form-control" id="tier" placeholder="Tier"></div>
                                                      </div>
                                                      </div>
                                                   <div class="form-group">
                                                   <div class="row">
                                                   <div class="col-md-4"><label for="Machine Registration">Machine Registration</label></div>
                                                   <div class="col-md-8"><input type="text" name="machine_registration" class="form-control" id="machine_registration" placeholder="Machine Registration"></div>
                                                      </div>
                                                      </div>
                                                      <div class="form-group">
                                                      <div class="row">
                                                      <div class="col-md-4"><label for="insurance">insurance</label></div>
                                                      <div class="col-md-8"><input type="text" name="insurance" class="form-control" id="insurance" placeholder="insurance"></div>
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
                    url: "{{ url('admin/products/getMakes') }}" + "/" + id,
                    method: "GET",
                    success: function(response) {
                        //console.log(response); 
                        $('#model').html(response);
                    }
                });
            });

           

        });
    </script>
<script type="text/javascript">

   
   $("#stock_quantity").on('keyup',function(){
      var qty = $("#stock_quantity").val();

      if (qty > 1) {
         $('.addedRow').remove();

         for(i=1; i<qty; i++) {
            $("#addDiv").append('<div class="row addedRow" style="margin-top: -30px;"><div class="col-md-6"></div><div class="col-md-6"><div class="form-group"><label for="stock_number"></label><input type="text" name="stock_number[]" class="form-control stock_number" id="stock_number" placeholder="Stock Number" required></div></div></div>');
         }
         $(".stock_number").filter(function() {
            return !this.value;
         }).removeClass('invalid-feedback').addClass("is-invalid");
      }else{
         $('.addedRow').remove();
      }
   });
</script>

<script>
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
         backorder_number: {
            required: false
         },
         title: {
            required: false
         },
         date: {
            required: false
         },
         make: {
            required: false
         },
         model: {
            required: false
         },
         year: {
            required: false
         },
         hours: {
            required: false
         },
         weight: {
            required: false
         },
         description: {
            required: false
         },
         price: {
            required: false
         },
         type: {
            required: false
         },
         image: {
            required: false
         },
         status: {
            required: false
         },
      },
      messages: {
        //  backorder_number: {
        //     required: "Please enter backorder number",
        //  },
        //  title: {
        //     required: "Please enter title",
        //  },
        //  date: {
        //     required: "Please select date",
        //  },
        //  make: {
        //     required: "Please enter make",
        //  },
        //  model: {
        //     required: "Please enter model",
        //  },
        //  year: {
        //     required: "Please enter year",
        //  },
        //  hours: {
        //     required: "Please enter hours",
        //  },
        //  weight: {
        //     required: "Please enter weight",
        //  },
        //  description: {
        //     required: "Please enter description",
        //  },
        //  price: {
        //     required: "Please enter price",
        //  },
        //  type: {
        //     required: "Please select type",
        //  },
        //  image: {
        //     required: "Please upload an image",
        //  },
        //  status: {
        //     required: "Please select status",
        //  },
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

@endsection
  



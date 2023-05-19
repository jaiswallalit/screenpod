@extends('admin.layout.master')
@section('content')

<style>
   ul.check-list li{
      display: inline-block;
      width: 100px;
   }
</style>

<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Trade</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Trade Add</li>
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
                     <h3 class="card-title">Add <small>Trade</small></h3>
                  </div>
                  @if (count($errors) > 0)       
                     <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        @foreach ($errors->all() as $error)
                           <span>{{ $error }}</span><br/>
                        @endforeach    
                     </div>         
                  @endif
                  <form id="quickForm" action="{{route('quotes.addtrade')}}" method="POST" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <div class="card-body">
                        <div class="form-group">
                        <input type="hidden" name="quote_id" value="{{$data['id']}}"><br>

                           <label for="name"> Make</label>
                           <input type="text" name="make" class="form-control" id="make" placeholder="Make" required>
                        </div>
                        <div class="form-group">
                           <label for="name"> Model</label>
                           <input type="text" name="model" class="form-control" id="model" placeholder="Model" required>
                        </div>
                        <div class="form-group">
                           <label for="name"> year</label>
                           <input type="text" name="year" class="form-control" id="year" placeholder="Year" required>
                        </div>
                        <div class="form-group">
                           <label for="name"> hours</label>
                           <input type="text" name="hours" class="form-control" id="hours" placeholder="Hours" required>
                        </div>
                        <div class="form-group">

                           <label for="image">image</label>
                           <input type="file" name="image" class="form-control" id="image" placeholder="Image">
                        </div>
                      
         
                       

                        
                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
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
$(function () {
   $('#quickForm').validate({
      rules: {
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
         image: {
            required: true
         },
      },
      messages: {
         make: {
            required: "Please enter a Make",
         },
         model: {
            required: "Please enter a model",
         },
         year: {
            required: "Please enter a year",
         },
         hours: {
            required: "Please enter a hours",
         },
         image: {
            required: "Please upload an image",
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


@endsection
  







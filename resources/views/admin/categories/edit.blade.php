@extends('admin.layout.master')
@section('content')
 
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Category</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Category Edit</li>
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
                     <h3 class="card-title">Edit <small>Category</small></h3>
                  </div>
                  @if (count($errors) > 0)       
                     <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        @foreach ($errors->all() as $error)
                           <span>{{ $error }}</span><br/>
                        @endforeach    
                     </div>         
                  @endif
                  <form id="quickForm" action="{{route('categories.update')}}" method="POST" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <input type="hidden" name="id" value="{{$result->id}}">

                     <div class="card-body">
                     <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="title">Category Name</label>
                           <input type="text" name="name" value="{{$result->name}}" class="form-control" id="name" placeholder="Category Name">
                        </div>
                     </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                 <label for="dealer_id">Dealer/Brand/Make</label>
                                 <select name="dealer_id" class="dealer_id select12 form-control" id="dealer_id" data-placeholder="Select a Dealer" style="width: 100%;" required>
                                    <option value="">Select Dealer</option>
                                    @foreach($dealers as $value)
                                       <option value="{{$value->id}}" <?php if($result->dealer_id == $value->id){echo "selected";} ?> >{{$value->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                     </div>

                        <div class="form-group">
                           <label for="description">Description</label>
                           <textarea name="description" class="form-control" rows="3">{{$result->description}}</textarea>
                        </div>

                        <div class="form-group">
                           <label for="image">Category Image</label>
                           <input type="file" name="image" class="form-control" id="image" placeholder="Image"><br>

                           @if (!empty($result->image))
                              <img src="{{ asset('/public/admin/clip-one/assets/categories/thumbnail') }}/{{$result->image}}" alt="" class="product-edit-img">
                           @endif

                        </div>

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('categories.index')}}" class="btn btn-default btn-secondary">Back</a>
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
         name: {
            required: true
         },
         description: {
            required: true
         }
      },
      messages: {
         name: {
            required: "Please enter a Category Name",
         },
         description: {
            required: "Please enter description",
         }
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
  



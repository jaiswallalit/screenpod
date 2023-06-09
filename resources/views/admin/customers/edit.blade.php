@extends('admin.layout.master')
@section('content')
 
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Customer</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Customer Edit</li>
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
                     <h3 class="card-title">Edit <small>Customer</small></h3>
                  </div>
                  @if (count($errors) > 0)       
                     <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        @foreach ($errors->all() as $error)
                           <span>{{ $error }}</span><br/>
                        @endforeach    
                     </div>         
                  @endif
                  <form id="quickForm" action="{{route('customers.update')}}" method="POST" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <input type="hidden" name="id" value="{{$result->id}}">

                     <div class="card-body">
                        <div class="form-group">
                           <label for="title">Name</label>
                           <input type="text" name="name" value="{{$result->name}}" class="form-control" id="name" placeholder="Name">
                        </div>

                        <div class="form-group">
                           <label for="vat_number">Vat Number</label>
                           <input type="text" name="vat_number" value="{{$result->vat_number}}" class="form-control" id="vat_number" placeholder="VAT Number">
                        </div>

                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" name="email" value="{{$result->email}}" class="form-control" id="email" placeholder="Customer Email">
                        </div>

                        <div class="form-group">
                           <label for="phone">Phone</label>
                           <input type="text" name="phone" value="{{$result->phone}}" class="form-control" id="phone" placeholder="Customer Phone">
                        </div>
 <div class="form-group">
                           <label for="company">Company</label>
                           <input type="text" name="company" value="{{$result->company}}" class="form-control" id="company" placeholder="company">
                        </div>
                        <div class="form-group">
                           <label for="address">Address</label>
                           <textarea class="form-control" id="address" name="address">{{$result->address}}</textarea>
                        </div>
                        
                        <div class="form-group">
                           <label for="address2">Address 2</label>
                           <textarea class="form-control" id="address2" name="address2">{{$result->address2}}</textarea>
                        </div>
                        <div class="form-group">
                           <label for="town">Town </label>
                           <input type="text" name="town" class="form-control" id="town" value="{{$result->town}}" placeholder="town">
                        </div>
                        <div class="form-group">
                           <label for="county">County</label>
                           <input type="text" name="county" class="form-control" id="county" value="{{$result->county}}" placeholder="county name">
                        </div>
                        <div class="form-group">
                           <label for="eircode">Eircode</label>
                           <input type="text" name="eircode" class="form-control" value="{{$result->eircode}}" id="eircode" placeholder="eircode name">
                        </div>

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('customers.index')}}" class="btn btn-default btn-secondary">Back</a>
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

$('.select12').select2({
   theme: 'bootstrap4'
});

$(function () {
   $('#quickForm').validate({
      rules: {
         name: {
            required: true
         },
         phone: {
            required: true
         },
         email: {
            required: true
         },
         address: {
            required: false
         },
         vat_number: {
            required: false
         },
      },
      messages: {
         name: {
            required: "Please enter Customer Name",
         },
         vat_number: {
            required: "Please enter VAT Number",
         },
         phone: {
            required: "Please enter Customer Phone",
         },
         email: {
            required: "Please enter Customer Email",
         },
         address: {
            required: "Please enter address",
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
@extends('admin.layout.master')
@section('content')

<style type="text/css">
   .select12:invalid + .select2 .select2-selection{
       border-color: #dc3545!important;
   }
   .select12:valid + .select2 .select2-selection{
       border-color: #ced4da!important;
   }
   *:focus{
     outline:0px;
   }
</style>

<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Site Visits</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">SIte Visits Add</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Add <small>SIte Visits</small></h3>
				<a href="#" class="btn btn-info float-right" data-toggle="modal" data-target="#add_machine"><i class="fas fa-plus"></i> Add Customer </a>


                  </div>
                  	 <!-- Modal -->
             <div class="modal fade" id="add_machine">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Add Customer </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form id="quickForm" action="{{route('customers.csave')}}" method="POST" enctype="multipart/form-data">
                     {{csrf_field()}}

                     <div class="card-body">
                        <div class="form-group">
                           <label for="title">Name</label>
                           <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        
                         <div class="form-group">
                           <label for="vat_number">VAT Number</label>
                           <input type="text" name="vat_number" class="form-control" id="vat_number" placeholder="VAT Number">
                        </div>


                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" name="email" class="form-control" id="email" placeholder="Customer Email">
                        </div>

                        <div class="form-group">
                           <label for="phone">Phone</label>
                           <input type="text" name="phone" class="form-control" id="phone" placeholder="Customer Phone">
                        </div>
                        <div class="form-group">
                           <label for="company">Company</label>
                           <input type="text" name="company" class="form-control" id="company" placeholder="company name">
                        </div>
                        <div class="form-group">
                           <label for="address1">Address 1</label>
                           <textarea class="form-control" id="address1" name="address"></textarea>
                        </div>
                        <div class="form-group">
                           <label for="address2">Address 2</label>
                           <textarea class="form-control" id="address2" name="address2"></textarea>
                        </div>
                        
                        <div class="form-group">
                           <label for="town">Town </label>
                           <input type="text" name="town" class="form-control" id="town" placeholder="town">
                        </div>
                        <div class="form-group">
                           <label for="county">County</label>
                           <input type="text" name="county" class="form-control" id="county" placeholder="county name">
                        </div>
                        <div class="form-group">
                           <label for="eircode">Eircode</label>
                           <input type="text" name="eircode" class="form-control" id="eircode" placeholder="eircode name">
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
         </div>
         <!-- Modal -->
				 
                  @if (count($errors) > 0)       
                     <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        @foreach ($errors->all() as $error)
                           <span>{{ $error }}</span><br/>
                        @endforeach    
                     </div>         
                  @endif
                  <form id="quickForm" action="{{route('site_visits.save')}}" method="POST" enctype="multipart/form-data">
                     {{csrf_field()}}

                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="customer_id">Customer</label>
                           <select name="customer_id" class="customer_id select12 form-control" id="customer_id" data-placeholder="Select a Customer" style="width: 100%;" required >
                              <option value="">Select Customer</option>
                              @foreach($customers as $value)
                                 <option value="{{$value->id}}">{{$value->name}}</option>
                              @endforeach
                           </select>
                        </div>
                           </div>
                           <div class="col-md-6">
                           <div class="form-group">
                           <label for="user_id">Sales Rep</label>
                           <select name="user_id" class="user_id select12 form-control" id="user_id" data-placeholder="Select a User" style="width: 100%;" required >
                              <option value="">Select User</option>
                              @foreach($users as $value)
                                 <option value="{{$value->id}}">{{$value->name}}</option>
                              @endforeach
                           </select>
                        </div>
                           </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                           <label for="title">Date</label>
                           <input type="date" name="date" value="{{ old('date') }}" class="form-control" id="date" >
                        </div>
                        </div>
                        <div class="col-md-6">

                        <div class="form-group">
                           <label for="Source">Contact</label>
                           <input type="text" name="contact" id="contact" class="form-control" placeholder="contact">
                        </div>
                        </div></div>
                      

                        <div class="row">
                        <div class="col-md-3">

                        <div class="form-group">
                           <label for="title">Telephone</label>
                           <input type="text" name="telephone"  class="form-control" id="telephone" placeholder="telephone">
                        </div>
                        </div>
                        <div class="col-md-3">

                                    <div class="form-group">
                                       <label for="title">Phone</label>
                                       <input type="text" name="phone"  class="form-control" id="phone" placeholder="Phone">
                                    </div>
                                    </div>
                        <div class="col-md-3">

                        <div class="form-group">
                           <label for="Source">Email</label>
                           <input type="email" name="email" id="email" class="form-control" placeholder="email">
                        </div>
                        </div>
                        
                        <div class="col-md-3">

                        <div class="form-group">
                           <label for="Source">Lead Source</label>
                           <input type="text" name="lead_source" id="lead_source" class="form-control" placeholder="lead source">
                        </div>
                        </div>
                        
                        </div>

                        <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                           <label for="title">Location</label>
                           <input type="text" name="location"  class="form-control" id="location">
                        </div>
                        </div>
                        <div class="col-md-6">

                        <div class="form-group">
                           <label for="Source">Category</label>
                           <input type="text" name="category" id="category" class="form-control" placeholder="category">
                        </div>
                        </div></div>
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                           <label for="title">Model</label>
                           <input type="text" name="model"  class="form-control" id="model" >
                        </div>
                        </div>
                        <div class="col-md-6">

                        <div class="form-group">
                           <label for="Source">Notes</label>
                           <input type="text" name="notes" id="notes" class="form-control" placeholder="notes">
                        </div>
                        </div></div>

                     

                     </div>
                     <div class="card-footer">
                        <div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <a href="{{route('site_visits.index')}}" class="btn btn-default btn-secondary">Back</a>
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
        
         user_id: {
            required: true
         },
       
      },
      messages: {
      
         user_id: {
            required: "Please select User",
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
  



@extends('admin.layout.master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<style>
    ul.cus-info li:last-child {
        margin: 20px 0 0 0;
        font-size: 30px;
        font-weight: 700;
    }

    ul.custom-last li:last-child {
        font-size: initial;
        font-weight: normal;
    }

    ul.last-ul {
        background-color: #dadada;
    }

    ul.last-ul li:nth-child(even) {
        background-color: transparent;
    }

    i.pdfi {
        font-size: 35px;
        color: #ee1410;
    }
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Create Hire Quotes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Hire Quotes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add <small> Quotes</small></h3>
                            <a href="#" class="btn btn-custom float-right" data-toggle="modal" data-target="#add_machine"><i class="fas fa-plus"></i> Add Customer </a>

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
                            <span>{{ $error }}</span><br />
                            @endforeach
                        </div>
                        @endif
                        <form id="quickForm" action="{{route('hirequotes.save')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="model">Machines</label>
                                            <select class="form-control" name="product_id" id="model">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_id">Customer</label>
                                            <select name="customer_id" class="customer_id select2 select12 form-control" id="customer_id" data-placeholder="Select a Customer" style="width: 100%;" required>
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id">User</label>
                                            <select name="user_id" class="user_id select12 form-control" id="user_id" data-placeholder="Select a User" style="width: 100%;" required>
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
                                    <label for="price">Price</label>
                                    <input type="text" name="price" class="form-control" id="price" placeholder="price">
                                     </div>

                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="title">Company Name</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="title">
                                     </div>

                                    </div>
                                   
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes"></textarea>
                                 </div>
                                 </div>
                                    </div>
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{route('sales_order.index')}}" class="btn btn-default btn-secondary">Back</a>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>




    </script>
    @endsection

    @section('script')
    <script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script>
        $('#description').summernote({
            height: 300,
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

        $(function() {
            $('#quickForm').validate({
                rules: {
                    dealer_id: {
                        required: true
                    },
                    model: {
                        required: true
                    },
                    serial_no: {
                        required: true
                    }
                },
                messages: {
                    dealer_id: {
                        required: "",
                    },
                    model: {
                        required: "",
                    },
                    serial_no: {
                        required: "",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            /*Load models by make*/
            $('#dealer_id').on('change', function() {
                var id = $(this).find(':selected').val();

                $.ajax({
                    url: "{{ url('admin/sales_order/getMakes') }}" + "/" + id,
                    method: "GET",
                    success: function(response) {
                        //console.log(response); 
                        $('#model').html(response);
                    }
                });
            });

            $('#model').on('change', function() {
                var id = this.value;

                $("#serial_no").html('');
                $.ajax({
                    url: "{{ url('admin/sales_order/getSerialNumbers') }}" + "/" + id,
                    type: "GET",
                    dataType: 'json',
                    success: function(result) {
                        $('#serial_no').html(result);
                    }
                });
            });

            /*Submit form for update*/
            $('#submit').on('click', function() {



                $.ajax({
                    url: "{{ url('admin/sales_order/update') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',

                    },

                });
            });
        });
    </script>
   <script>
$(document).ready(function() {
  $(".select2").select2();
});
    </script>
    @endsection
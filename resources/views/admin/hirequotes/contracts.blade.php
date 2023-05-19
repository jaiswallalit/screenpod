@extends('admin.layout.master')
@section('content')

<style>
   ul.cus-info li:last-child{
      margin: 20px 0 0 0;
      font-size: 30px;
      font-weight: 700;
   }
</style>
<style>
   #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
   }

   #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
   }

   #customers tr:nth-child(even){background-color: #f2f2f2;}

   #customers tr:hover {background-color: #ddd;}

   #customers th {
      padding-top: 8px;
      /*padding-bottom: 8px;*/
      text-align: left;
      background-color: #d6d6d6;
      color: #000;
   }
   .head-1 {
      padding: 10px;
      margin-bottom: 0;
      /*display: flow-root;*/
   }
   .side_bar_menu ul {
      padding-left: 0;
   }
   .side_bar_menu ul li a {
      font-size: 15px;
      color: #000;
   }
   .side_bar_menu ul li {
      display: block;
      padding: 10px 0;
      border-bottom: 1px solid #f1f1f1;
   }
   .side_bar_menu {
      background: #e0e0e0;
      padding: 15px;
   }
   .add-pro-btn{
      float: right;
      border: none;
      background-color: #007aff;
      color: #fff;
      margin-bottom: 10px;
      outline: none;
      height: 34px;
      padding: 0 20px;
      border-radius: 4px;
      font-weight: 100;
      letter-spacing: .4px;
      font-size: 13px;
      margin-left: 5px;
   }
   .cus-content{
      height: 200px;
   }
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Hire Contract  Details</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Hire Contract</li>
               </ol>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
   <div class="card">
      
      <div class="card-body">
         
      @foreach($result as $key => $contract)

      <?php 
      print_r($result);
      die();
      $result = DB::table('hire_info')->where('quote_id',$contract->quote_id)->first();
      ?>
      {{$result->min_hire_period}}
      @endforeach

      </div>
   </div>
   </section>
</div>

@endsection
@extends('layouts.master')

@section('page-title')

Change Passowrd

@endsection

@section('content')

<div class="right_col" role="main">

   <div class="">

      <div class="page-title">

         <div class="title_left">

            <h3>Change Passowrd</h3>

         </div>

      </div>

      <div class="clearfix"></div>

      <div class="row">

         <div class="col-md-12  ">

            <div class="x_panel">

               @if ($message = Session::get('error'))

               <div class="alert alert-danger alert-block">

                  <button type="button" class="close" data-dismiss="alert">×</button>

                      <strong>{{ $message }}</strong>

               </div>

               @endif 

               @if ($message = Session::get('success'))

               <div class="alert alert-success alert-block">

                  <button type="button" class="close" data-dismiss="alert">×</button>

                      <strong>{{ $message }}</strong>

               </div>

               @endif 

               <div class="x_content">

                  <br />

                  <form class="form-horizontal form-label-left" action="/change-password/store" method="POST" >

                     @csrf

                     <div class="form-group row ">

                        <label class="control-label col-md-3 col-sm-3 ">Old Password*</label>

                        <div class="col-md-9 col-sm-9 ">

                           <input type="password" class="form-control" placeholder="Old Password" name="old_password">

                        </div>

                     </div>

                     <div class="form-group row ">

                        <label class="control-label col-md-3 col-sm-3 ">New Password*</label>

                        <div class="col-md-9 col-sm-9 ">

                           <input type="password" class="form-control" placeholder="New Password" name="new_password">

                        </div>

                     </div>

                     <div class="form-group row ">

                        <label class="control-label col-md-3 col-sm-3 ">Confirm Password*</label>

                        <div class="col-md-9 col-sm-9 ">

                           <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">

                        </div>

                     </div>

                     <div class="ln_solid"></div>

                     <div class="form-group">

                        <div class="col-md-9 col-sm-9  offset-md-3">

                           <button type="submit" class="btn btn-success">Submit</button>

                        </div>

                     </div>

                  </form>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

@endsection
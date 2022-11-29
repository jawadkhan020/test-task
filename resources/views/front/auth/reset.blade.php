@extends('front.layouts.app')
@section('content')
{{-- Background Image --}}
<div class="page-header align-items-start min-vh-50 m-3 border-radius-lg" style="background-image: url('https://images.unsplash.com/photo-1497996541515-6549b145cd90?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1650&q=80');">
    <span class="mask bg-gradient-dark opacity-6"></span>
  </div>
    {{-- main container --}}
  <div class="container mb-4">
    <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
 
        <div class="card mt-8">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary  border-radius-lg py-3 pe-1 text-center py-4">
              <h3 class="font-weight-bolder text-white">Reset Password</h3>
              <p class="mb-0 text-sm text-white">You will receive an e-mail in maximum 60 seconds</p>
            </div>
          </div>
          <div class="card-body py-4">
            <form role="form" action="{{route('admin.reset.post')}}" method="POST">
                @csrf
              <div class="input-group input-group-static mb-4">
                <label>Enter Email</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="john@email.com" name="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror  
            </div>
              <div class="text-center">
                <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0">Reset</button>
              </div>
            </form>
          </div>
          <div class="card-footer text-center pt-0 px-sm-4 px-1">
            <p class="mb-4 mx-auto">
               Have an account?
              <a href="{{route('admin.login.form')}}" class="text-primary text-gradient font-weight-bold">Sign in</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@extends('front.layouts.app')
@section('content')
    <div class="page-header align-items-start min-height-300 m-3 border-radius-xl bg-gray-200" style="background-image: url('https://images.unsplash.com/photo-1545569341-9eb8b30979d9?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); background-size: cover; background-position:center;">
      <span class="mask bg-gradient-dark opacity-4"></span>
    </div>
    <div class="container my-auto">
      <div class="row mt-lg-n12 mt-md-n12 mt-n11 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto ">
         <div class="card z-index-0 fadeIn3 fadeInBottom">   
          <div class="card mt-5">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center py-4">
                <h4 class="font-weight-bolder text-white mt-1">Join us today</h4>
                <p class="mb-1 text-white text-sm">Enter your email and phone number to register</p>
              </div>
            </div>
            <div class="card-body pb-3">
              <form role="form" action="{{route('admin.register.post')}}" method="POST">
                @csrf
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Contact</label>
                  <input type="text"  class="form-control @error('contact') is-invalid @enderror" name="contact"  required >
                  @error('contact')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
                {{-- <div class="form-check text-left">
                  <input class="form-check-input bg-dark border-dark" type="checkbox" value="" id="flexCheckDefault" checked>
                  <label class="form-check-label" for="flexCheckDefault">
                    I agree the <a href="../../../pages/privacy.html" class="text-dark font-weight-bolder">Terms and Conditions</a>
                  </label>
                </div> --}}
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0">Sign up</button>
                </div>
              </form>
            </div>
            <div class="card-footer text-center pt-0 px-sm-4 px-1">
              <p class="mb-4 mx-auto">
                Already have an account?
                <a href="{{route('admin.login.form')}}" class="text-primary text-gradient font-weight-bold">Sign in</a>
              </p>
            </div>
          </div>
         </div>
        </div>
      </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script> 
  @if (session('status'))
               
                      swal({
                            title: '{{ session('status') }}',
                            icon: "success",
                          });
                @endif
</script>
@endsection

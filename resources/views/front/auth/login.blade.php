@extends('front.layouts.app')
@section('content')
  <div class="page-header align-items-start min-height-300 m-3 border-radius-xl" style="background-image: url('https://images.unsplash.com/photo-1491466424936-e304919aada7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1949&q=80');">
    <span class="mask bg-gradient-dark opacity-6"></span>
  </div>
      <div class="container my-auto">
        <div class="row mt-lg-n12 mt-md-n12 mt-n11 justify-content-center">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card mt-5">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1 text-center py-4">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <p class="mb-1 text-sm text-white">Enter your email and password to Sign In</p>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" action="{{url('login')}}" method="POST">
                  @csrf
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button  type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="{{route('admin.register.index')}}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                  <p class="mt-2 text-sm text-center">
                    Don't know password?
                    <a href="{{route('admin.reset.password')}}" class="text-primary text-gradient font-weight-bold">Reset </a>
                  </p>
                </form>
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
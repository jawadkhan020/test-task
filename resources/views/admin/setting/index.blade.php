@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <ul class="nav nav-pills py-3 profile-settings" role="tablist">
                                <li class="nav-item  nav-tabs nav-item-settings">
                                    <a class="mb-0 d-flex  nav-link " data-bs-toggle="tab" href="#cam1" role="tab"
                                        aria-controls="cam1" aria-selected="true">
                                        <i class="material-icons text-lg" style="font-size: 1.5rem;">person</i>
                                        <p class="ms-4" style="font-size: 1rem;">Profile info</p>
                                        <i class="material-icons text-dark ">arrow</i>
                                    </a>
                                </li>
                                <li class="nav-item nav-tabs nav-item-settings">
                                    <a class=" mb-0  d-flex nav-link" data-bs-toggle="tab" href="#cam2" role="tab"
                                        aria-controls="cam2" aria-selected="false">
                                        <i class="material-icons text-lg " style="font-size: 1.5rem;">lock</i>

                                        <p class="px-4" style="font-size: 1rem;">Change Password</p>

                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                    <div class="col-md-9 col-12 p-2 mt-4 p-2 mt-4">
                        <div class=" p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="tab-content border-radius-lg" id="v-pills-tabContent">
                                <div class="tab-pane fade show position-relative active height-200 border-radius-lg"
                                    id="cam1" role="tabpanel" aria-labelledby="cam1">
                                    <div class="card card-body tabcontent">
                                        <div class="">
                                            <div class="d-flex justify-content-between">
                                                <h5>Profile Info</h5>
                                                <i data-bs-toggle="modal"
                                                data-bs-target="#profileinfoModal"
                                                    class="cursor-pointer material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %} ">edit</i>
                                            </div>



                                        </div>

                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-9">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-4 col-md-6 col-sm-6 mt-sm-0 mt-4">

                                                        <div class="avatar avatar-xl position-relative mt-2">
                                                            @if (auth::user()->image)
                                                            <img src="{{ asset('assets/img/user/'.auth::user()->image) }}"
                                                            alt="bruce" class="w-100 rounded shadow-sm">
                                                            @else 
                                                            <img src="{{asset('assets/img/bruce-mars.jpg')}}"
                                                            alt="bruce" class="w-100 rounded shadow-sm">
                                                            @endif                                          
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-12">

                                                        <div class="row">
                                                            <div class="col-md-4 col-4">
                                                                <p class="mb-0 font-weight-normal text-sm">
                                                                    Full Name :
                                                                </p>
                                                                <p class="mb-0 font-weight-normal text-sm">
                                                                    Email :
                                                                </p>
                                                                <p class="mb-0 font-weight-normal text-sm">
                                                                    Contact :
                                                                </p>
                                                                
                                                            </div>
                                                            <div class="col-md-8 col-8">
                                                                <p class="mb-0 font-weight-normal text-sm">
                                                                    {{auth::user()->name}}
                                                                </p>
                                                                <p class="mb-0 font-weight-normal text-sm">
                                                                    {{auth::user()->email}}
                                                                </p>
                                                             
                                                                <p class="mb-0 font-weight-normal text-sm">
                                                                    {{auth::user()->contact}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade position-relative height-550 border-radius-lg" id="cam2"
                                    role="tabpanel" aria-labelledby="cam2">
                                    <div class="card  tabcontent">
                                        <div class="card mt-4" id="password">
                                           
                                        @if (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                            <form action="{{route('admin.password.update')}}" method="POST">
                                                @csrf
                                            <div class="card-header">
                                                <h5>Change Password</h5>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="input-group input-group-outline">
                                                    <label class="form-label">Current password</label>
                                                    <input type="password" class="form-control  @error('old_password') is-invalid @enderror" id="oldPasswordInput" name="old_password">
                                                </div>
                                                <div class="input-group input-group-outline my-4">
                                                    <label  for="newPasswordInput" class="form-label">New password</label>
                                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" name="new_password">
                                                    <br>
                                                    @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                                <div class="input-group input-group-outline">
                                                    <label class="form-label" for="confirmNewPasswordInput">Confirm New password</label>
                                                    <input type="password"  name="new_password_confirmation" class="form-control" id="confirmNewPasswordInput">
                                                </div>
                                                <h5 class="mt-4">Password requirements</h5>
                                                <p class="text-muted mb-2">
                                                    Please follow this guide for a strong password:
                                                  </p>
                                                <ul class="text-muted ps-4 mb-0 float-start">
                                                  <li>
                                                    <span class="text-sm">Min 6 characters</span>
                                                  </li>
                                                </ul>
                                                <button type="submit"
                                                    class="btn bg-gradient-dark btn-sm float-end mt-3 mb-3">Update
                                                    password</button>
                                            </div>
                                        </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Profile Model --}}
    <div class="modal fade" id="profileinfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Profile Info</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.profileinfo.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{auth::user()->id}}">
            <div class="modal-body">
                <div class="row">
                    <div class=" col-md-12">

                        <div class="avatar avatar-xl position-relative mt-2  align-center">   
                            @if (auth::user()->image) 
                            <img src="{{ asset('assets/img/user/'.auth::user()->image) }}"
                                alt="bruce" class="w-100 rounded shadow-sm">
                                @else
                                <img src="{{asset('assets/img/bruce-mars.jpg')}}"
                                alt="bruce" class="w-100 rounded shadow-sm">
                                @endif
                              
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <div class="input-group input-group-outline">
                                <!-- <label class="form-label">Email</label> -->
                                <input type="file" class="form-control"   name="image">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="input-group input-group-outline">
                                    <!-- <label class="form-label">Email</label> -->
                                    <input type="text" class="form-control" placeholder="Full Name" value="{{Auth::user()->name}}" name="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="input-group input-group-outline">
                                <!-- <label class="form-label">Email</label> -->
                                <input type="text" class="form-control" placeholder="contact" value="{{auth::user()->contact}}" name="contact">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="input-group input-group-outline">
                                <!-- <label class="form-label">Email</label> -->
                                <input type="email" name="email" value="{{auth::user()->email}}" class="form-control" placeholder="email" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

          
            <div class="modal-footer">
                <button type="submit"  aria-label="Close"
                    class="btn btn-sm py-2  color-secondary">Update</button>
            </div>
        </div>
    </form>
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
<script>
       function visible() {
      var elem = document.getElementById('profileVisibility');
      if (elem) {
        if (elem.innerHTML == "Switch to visible") {
          elem.innerHTML = "Switch to invisible"
        } else {
          elem.innerHTML = "Switch to visible"
        }
      }
    }
</script>
@endsection
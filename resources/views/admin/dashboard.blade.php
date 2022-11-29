@extends('admin.layouts.app')
@section('content')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">dashboard</li>
          </ol>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="text-center">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Cars Regiatered</p>
                  <h5 class="font-weight-bolder mb-0">
                  {{totalCars();}}
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="text-center">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Categories Regiatered</p>
                  <h5 class="font-weight-bolder mb-0">
                  {{totalCategories()}}
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="text-center">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Members Regiatered</p>
                  <h5 class="font-weight-bolder mb-0">
                   {{totalUsers()}}
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 @endsection
  
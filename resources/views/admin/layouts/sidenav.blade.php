<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard-pro/pages/dashboards/analytics.html " target="_blank">
        <img src="{{asset('/assets/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Test Task</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mb-2 mt-0">
          <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
            @if (auth::user()->image)
            <img src="{{ asset('assets/img/user/'.auth::user()->image) }}" class="avatar">
            @else
            <img src="{{asset('assets/img/users/bruce-mars.jpg')}}" class="avatar">
            @endif
            <span class="nav-link-text ms-2 ps-1">{{Auth::user()->name}}</span>
          </a>
          <div class="collapse" id="ProfileNav" style="">
            <ul class="nav ">
              <li class="nav-item">
                <a class="nav-link text-white " href="{{route('admin.logout')}}">
                  <span class="sidenav-mini-icon"> L </span>
                  <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <hr class="horizontal light mt-0">
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link text-white @if(request()->is('admin/dashboard')) active @endif" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round opacity-10">dashboard</i>
            <span class="nav-link-text ms-2 ps-1">Dashboards</span>
          </a>
        </li>
        <li class="nav-item">
          <a  href="{{route('admin.category.index')}}" class="nav-link text-white  @if(request()->is('admin/dashboard/categories')) active @endif" aria-controls="applicationsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">apps</i>
            <span class="nav-link-text ms-2 ps-1">Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a  href="{{route('admin.vehicle.index')}}" class="nav-link text-white @if(request()->is('admin/dashboard/vehicle')) active @endif" aria-controls="ecommerceExamples" role="button" aria-expanded="false">
            <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">shopping_basket</i>
            <span class="nav-link-text ms-2 ps-1">Vehicle</span>
          </a>
        </li>
        <li class="nav-item">
          <a  href="{{route('admin.setting.index')}}" class="nav-link text-white  @if(request()->is('admin/dashboard/setting')) active @endif" aria-controls="authExamples" role="button" aria-expanded="false">
            <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">content_paste</i>
            <span class="nav-link-text ms-2 ps-1">Setting</span>
          </a>
        </li>

      </ul>
    </div>
  </aside>

@include('admin.layouts.header')
@include('admin.layouts.sidenav')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
@yield('content')
</main>
@include('admin.layouts.footerjs')
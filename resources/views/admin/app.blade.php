<!DOCTYPE html>
<html>
    @include('admin.partial.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.partial.topnav')

  <!-- Main Sidebar Container -->
  @include('admin.partial.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content')
  </div>


  @include('admin.partial.footer')

 
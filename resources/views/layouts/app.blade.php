<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Starter</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- toaster alert --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
    {{-- date and time picker plugin --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    {{-- icheck check box --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  {{-- alpine js --}}
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}

  @livewireStyles
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    @include('layouts.includes.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('layouts.includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{ $slot }}
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.includes.footer');
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
{{-- toaster alert js --}}
<script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
{{-- date and time picker plugin --}}
<script type="text/javascript" src="https://unpkg.com/moment"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>


<script>
    $(document).ready(function(){
        toastr.options = {
            "positionClass": "toast-top-right",
            "progressBar": true,
        }

        window.addEventListener('hide-form', event => {
        $('#form').modal('hide');

        toastr.success(event.detail.message, 'Success!');
    })


    });

</script>
<script>
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    });

    window.addEventListener('show-delete-modal', event => {
        $('#confirmationModal').modal('show');
    });

     window.addEventListener('hide-delete-modal', event => {
        $('#confirmationModal').modal('hide');

        toastr.success(event.detail.message, 'Success!');
     });

     window.addEventListener('alert', event => {
        toastr.success(event.detail.message, 'Success!');
     });

     window.addEventListener('updated', event => {
        toastr.success(event.detail.message, 'Success!');
     });

</script>

@stack('js')

@livewireScripts
</body>
</html>

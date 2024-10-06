<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>@yield('title', 'Trang Quản Trị')</title>

      <!-- Create favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/images/logo.jpg')}}" />
      <!-- Custom fonts for this template-->
      <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <script src="{{ asset('vendor/jquery.min.js') }}"></script>
      <script src="{{ asset('vendor/format/number_format.js') }}"></script>
       <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/admin.js') }}"></script> --}}
      <link href="{{asset('admin/css/sb-admin.css')}}" rel="stylesheet">
      <link href="{{asset('admin/css/admin.css')}}" rel="stylesheet">
      <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js" ></script>
    </head>

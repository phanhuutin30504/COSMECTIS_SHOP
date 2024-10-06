@include('admin.Layout_admin.header')
<div id="wrapper">
    <!-- Sidebar -->
    @include('admin.Layout_admin.sidebar')

    @yield('content-admin')
</div>
@include('admin.Layout_admin.footer')

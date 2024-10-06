@include('admin.Layout_admin.head')
   <body id="page-top">
      <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
         <a class="navbar-brand mr-1" href="{{route('admin.dashboard')}}">Quản Trị</a>
         <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
         <i class="fas fa-bars"></i>
         </button>
         <!-- Navbar Search -->
         <div class="navbar-alerts ml-auto">
            @if (session('success'))
                <div class="alert alert-success mb-0 d-inline-block">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mb-0 d-inline-block">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </div>
         <!-- Navbar -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item no-arrow text-white">
               <span >{{Auth::user()->name}}</span> |
               <a class="text-white nounderline" href="#" data-toggle="modal" data-target="#logoutModal">Thoát</a>
            </li>
         </ul>

      </nav>


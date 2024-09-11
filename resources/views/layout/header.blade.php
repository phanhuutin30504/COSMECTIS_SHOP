<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Trang chủ - Mỹ Phẩm Goda')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-5.11.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/star-rating/css/star-rating.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/star-rating/js/star-rating.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('vendor/format/number_format.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<?php global $c, $a; ?>

<body>
    <header>
        <!-- use for ajax -->
        <input type="hidden" id="reference" value="">
        <!-- Top Navbar -->
        <div class="top-navbar container-fluid">
            <div class="menu-mb">
                <a href="javascript:void(0)" class="btn-close" onclick="closeMenuMobile()">×</a>
                <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Trang chủ</a>
                <a class="{{ request()->is('product*') ? 'active' : '' }}" href="{{ route('product.index') }}">Sản
                    phẩm</a>
                <a class="{{ request()->is('information/returnPolicy') ? 'active' : '' }}"
                    href="{{ route('returnPolicy') }}">Chính sách đổi trả</a>
                <a class="{{ request()->is('information/paymentPolicy') ? 'active' : '' }}"
                    href="{{ route('paymentPolicy') }}">Chính sách thanh toán</a>
                <a class="{{ request()->is('information/deliveryPolicy') ? 'active' : '' }}"
                    href="{{ route('deliveryPolicy') }}">Chính sách giao hàng</a>
                <a class="{{ request()->is('contact-form') ? 'active' : '' }}" href="{{ route('contact.form') }}">Liên
                    hệ</a>

            </div>
            <div class="row">
                <div class="hidden-lg hidden-md col-sm-2 col-xs-1">
                    <span class="btn-menu-mb" onclick="openMenuMobile()"><i
                            class="glyphicon glyphicon-menu-hamburger"></i></span>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/tinh.huu.148/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/h.tin05/"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-10 col-xs-11">
                    <ul class="list-inline pull-right top-right">
                        <li class="account-login">
                            @if (!Auth::guard('customer')->check())
                                <!-- chưa đăng nhập -->
                                <a href="javascript:void(0)" class="btn-register">Đăng Ký</a>
                            @else
                                <!-- đã đăng nhập -->
                                <a href="{{ url('my-order', Auth::guard('customer')->user()->id) }}"
                                    class="btn-logout">Đơn hàng của tôi</a>
                            @endif
                        </li>
                        <li>

                            @if (!Auth::guard('customer')->check())
                                <!-- chưa đăng nhập -->
                                <a href="javascript:void(0)" class="btn-login">Đăng Nhập </a>
                            @else
                                <!-- đã đăng nhập -->
                                <a href="javascript:void(0)" class="btn-account dropdown-toggle" data-toggle="dropdown"
                                    id="dropdownMenu">{{ Auth::guard('customer')->user()->name }}</a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                    <li><a href="{{ route('show.customer', Auth::guard('customer')->user()->id) }}">Thông
                                            tin tài khoản</a></li>
                                    <li><a
                                            href="{{ route('shipping.customer', Auth::guard('customer')->user()->id) }} ">Địa
                                            chỉ giao hàng</a></li>
                                    <li><a href="{{ route('myOrder', Auth::guard('customer')->user()->id) }}">Đơn hàng
                                            của tôi</a></li>
                                    <li role="separator" class="divider"></li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <li class="text-center "> <button type="submit"
                                                class="btn btn-link logout">Đăng xuất</button></li>
                                    </form>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End top navbar -->
        <!-- Kiểm tra và hiển thị thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        <!-- Kiểm tra và hiển thị thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger text-center ">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Header -->
        <div class="container">
            <div class="row">
                <!-- LOGO -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 logo">
                    <a href="/"><img src="../upload/goda450x170_1.jpg" class="img-responsive"></a>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs call-action">
                    <a href="#"><img src="../upload/godakeben450x170.jpg" class="img-responsive"></a>
                </div>
                <!-- HOTLINE AND SERCH -->
                <div class="col-lg-4 col-md-4 hotline-search">
                    <div>
                        <p class="hotline-phone"><span><strong>Hotline: </strong><a
                                    href="tel:0932.538.468">0326.254.914</a></span></p>
                        <p class="hotline-email"><span><strong>Email: </strong><a
                                    href="mailto:phanhuutin3052004@gmail.com">phanhuutin3052004@gmail.com</a></span>
                        </p>
                        <form class="header-form" action="">
                            <div class="input-group">
                                <input type="search" class="form-control search" id="search" placeholder="Nhập từ khóa tìm kiếm"
                                    name="search" autocomplete="off" value="">
                                <div class="input-group-btn">
                                    <button class="btn bt-search bg-color" type="submit">
                                        <i class="fa fa-search" style="color:#fff"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="search-result "></div>
                        </form>

                </div>
            </div>
        </div>
        <!-- End header -->
    </header>

    <!-- NAVBAR DESKTOP-->
    <nav class="navbar navbar-default desktop-menu">
        <div class="container">
            <ul class="nav navbar-nav navbar-left hidden-sm hidden-xs">
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">Trang chủ</a>
                </li>
                <li class="{{ request()->is('product') ? 'active' : '' }}"><a href="{{ url('/product') }}">Sản phẩm
                    </a></li>
                <li class="{{ request()->is('information/returnPolicy') ? 'active' : '' }}"><a
                        href="{{ url('/information/returnPolicy') }}">Chính
                        sách
                        đổi trả</a></li>
                <li class="{{ request()->is('information/paymentPolicy') ? 'active' : '' }}"><a
                        href="{{ url('information/paymentPolicy') }}">Chính
                        sách
                        thanh toán</a></li>
                <li class="{{ request()->is('information/deliveryPolicy') ? 'active' : '' }}"><a
                        href="{{ url('information/deliveryPolicy') }}">Chính
                        sách
                        giao hàng</a></li>
                <li class="{{ request()->is('contact-form') ? 'active' : '' }}"> <a
                        href="{{ url('contact-form') }}">Liên hệ</a></li>
            </ul>
            {{-- @if (Auth::guard('customer')->user())
            @elseif ($cartItems->quantity > 0)
    @php
           $totalQty = $cartItems->sum('quantity');
    @endphp


            @endif --}}


            <span class="hidden-lg hidden-md experience">Trải nghiệm cùng sản phẩm của Goda</span>
            <ul class="nav navbar-nav navbar-right">
                <li class="cart"><a href="javascript:void(0)" class="btn-cart-detail" title="Giỏ Hàng"><i
                            class="fa fa-shopping-cart"></i> <span class="number-total-product">
                            @if (Auth::guard('customer')->check())
                                @php
                                    $totalQty =
                                        isset($cartItems) && !empty($cartItems) ? $cartItems->sum('quantity') : 0;
                                @endphp

                                @if ($totalQty > 0)
                                    {{ $totalQty }}
                                @else
                                    {{ '' }}
                                @endif
                            @endif

                        </span></a></li>
            </ul>
        </div>
    </nav>
    @include('layout.message')

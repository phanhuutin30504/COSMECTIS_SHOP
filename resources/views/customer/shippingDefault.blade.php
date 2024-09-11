@extends('app')
@section('title','Thông tin người dùng')
@section('content')
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>
           @include('layout.aside_info')
            <div class="col-md-9 account">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Địa chỉ giao hàng mặc định</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <form action="index.php?c=customer&amp;a=saveShippingAddress" method="POST" role="form">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input type="text" value="{{$customer->name}}" class="form-control" name="name" placeholder="Họ và tên" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')" oninput="this.setCustomValidity('')">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="tel" value="{{$customer->mobile}}" class="form-control" name="mobile" placeholder="Số điện thoại" required="" pattern="[0][0-9]{9,}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')" oninput="this.setCustomValidity('')">
                                </div>
@include('layout.information_form')
                                <div class="form-group col-sm-12">
                                    <input type="text" value="{{$customer->housenumber_street}}" class="form-control" placeholder="Địa chỉ" name="housenumber_street" required="" oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ bao gồm số nhà, tên đường')" oninput="this.setCustomValidity('')">
                                </div>
                                <div class="form-group col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

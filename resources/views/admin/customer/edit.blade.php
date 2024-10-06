@extends('admin.admin_laytout')
@section('content-admin')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Khách hàng</li>
       </ol>
       <!-- /form -->
       <form method="post" action="{{route('admin.customer.update',$customer->id)}}" enctype="multipart/form-data">
        @csrf
        @method('Put')
        <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Tên</label>
             <div class="col-md-9 col-lg-6">

                <input name="name" id="name" type="text" value="{{$customer->name}}" class="form-control">
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="email">Email</label>
             <div class="col-md-9 col-lg-6">
                <input name="email" id="email" type="text" value="{{$customer->email}}" class="form-control">
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="password">Mật Khẩu</label>
             <div class="col-md-9 col-lg-6">
                <input name="password" id="password" type="password" value="{{$customer->password}}" class="form-control">
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="mobile">Số Điện Thoại</label>
             <div class="col-md-9 col-lg-6">
                <input name="mobile" id="mobile" type="text" value="{{$customer->mobile}}" class="form-control">
             </div>
          </div>


          <div class="form-group row">
            <label class="col-md-12 control-label" for="">Địa chỉ</label>
            <div class="col-md-9 col-lg-6">
                <input type="text" class="form-control" value="{{$customer->housenumber_street}}" placeholder="Số nhà, đường" name="housenumber_street">
            </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="mobile">Tên người nhận</label>
             <div class="col-md-9 col-lg-6">
                <input name="shipping_name" id="shipping_name" type="text" value="{{$customer->shipping_name}}" class="form-control">
             </div>
          </div>

          <div class="form-group row">
             <label class="col-md-12 control-label" for="mobile">Số điện thoại người nhận</label>
             <div class="col-md-9 col-lg-6">
                <input name="shipping_mobile" id="shipping_mobile" type="tel" value="{{$customer->shipping_mobile}}" class="form-control">
             </div>
          </div>

          <div class="form-group row">
             <label class="col-md-12 control-label" for="active">Đã kích hoạt</label>
             <div class="col-md-9 col-lg-6">
                <input type="hidden" name="is_active" value="0">
                <input name="is_active" id="active" type="checkbox" value="1" {{$customer->is_active == 1 ? 'checked' : ''}}>
             </div>
          </div>

          <div class="form-action">
             <button type="submit" class="btn btn-primary btn-sm" >Cập nhật</button>
          </div>
       </form>
       <!-- /form -->
    </div>

@endsection


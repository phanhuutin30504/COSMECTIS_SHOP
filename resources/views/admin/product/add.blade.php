@extends('admin.admin_laytout')
@section('content-admin')
    <div id="content-wrapper">
        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
            <!-- /form -->
            <form action="{{ route('admin.product.store') }}" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">Tên </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="wholesale-price">Giá bán lẻ </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="price" id="price" type="text" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="inventory-number">Lượng tồn</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="inventory_qty" id="inventory-number" type="text" value=""
                            class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="category">Danh mục</label>
                    <div class="col-md-9 col-lg-6">
                        <select name="category_id" id="category" class="form-control">
                            @foreach ($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="brand">Thương hiệu</label>
                    <div class="col-md-9 col-lg-6">
                        <select name="brand_id" id="brand" class="form-control">
                            @foreach ($brands as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label">Nổi bật</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="checkbox" name="featured" value="1">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="image">Hình ảnh </label>
                    <div class="col-md-9 col-lg-6">
                        <input type="file" name="featured_image" id="image" ccept="image/*">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="description">Mô tả</label>
                    <div class="col-md-12">
                        <textarea name="description" id="editor" rows="10" cols="80"></textarea>
                    </div>

                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
                </div>
            </form>
        @endsection

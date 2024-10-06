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
                <li class="breadcrumb-item active">Sửa</li>
            </ol>
            <!-- /form -->
            <form  method="post" action="{{route('admin.product.update',$product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row form-group">
                    <label class="col-md-12 control-label" for="name">Tên </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="{{ $product->name }}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="retail-price">Giá bán lẻ </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="price" id="price" type="text"
                            value="{{ old('price', number_format($product->price, 0, '', '.')) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">

                    <label class="col-md-12 control-label" for="inventory-number">Lượng tồn</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="inventory-number" id="inventory-number" type="text"
                            value="{{ $product->inventory_qty }}" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="category">Danh mục</label>
                    <div class="col-md-9 col-lg-6">
                        {{-- @php
                    dd($product)
                @endphp --}}
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category->id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label">Ngày tạo </label>
                    <div class="col-md-9 col-lg-6">
                        {{$product->created_at}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label">Nổi bật</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="checkbox"  name="featured" value="1" {{$product->featured ==1 ?'checked' : ''}}>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 ">
                        <img class="img-fluid w-25" src="{{asset($product->featured_image)}}" alt="{{$product->name}}">
                    </div>
                    <div class="col-md-9 col-lg-6">
                        <input type="file" name="featured_image" id="image">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="description">Mô tả</label>
                    <div class="col-md-12">
                        <textarea name="description" id="editor" rows="10" cols="80">
                   {!!$product->description!!}
                   </textarea>
                    </div>

                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-primary btn-sm" >Cập nhật</button>
                </div>
            </form>


            <!-- /form -->
            <!-- /.container-fluid -->
        @endsection

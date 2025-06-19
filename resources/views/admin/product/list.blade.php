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
            <!-- DataTables Example -->
            <form id="deleteForm" action="{{ route('deleteSelected.product') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="action-bar">
                    <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                                        <th>Mã</th>
                                        <th style="width:50px">Tên </th>
                                        <th>Hình ảnh</th>
                                        <th>Giá bán lẻ</th>
                                        <th>% giảm giá</th>
                                        <th>Giá bán thực tế</th>
                                        <th>Lượng tồn</th>
                                        <th>Đánh giá</th>
                                        <th>Nội bật</th>
                                        <th>Danh mục</th>
                                        <th>Ngày tạo</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>

                                            <td><input type="checkbox" name="ids[]" value="{{ $product->id }}"></td>
                                        </form>
                                            <td>#{{ $product->sku }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td><img src="{{ asset($product->featured_image) }}"></td>
                                            <td>{{ number_format($product->price, '0', '', '.') }}₫</td>
                                            <td>{{ $product->discount_percentage }}%</td>
                                            <td> {{ number_format($product->price - ($product->price * $product->discount_percentage) / 100, 0, '', '.') }}₫
                                            </td>
                                            <td>{{ $product->inventory_qty }}</td>
                                            <td>
                                                @if ($product->star >= 1)
                                                    {{ $product->star }}
                                                    <i class="fa fa-star ml-2"></i>
                                                @else
                                                    chưa có đánh giá
                                                @endif
                                            </td>
                                            <td>{{ $product->featured ? 'Có' : 'Không' }}</td>

                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td><a href="{{route('admin.comment',$product->id)}}">Đánh giá</a></td>
                                            <td><a href="{{route('admin.products.showImages',$product->id)}}">Hình ảnh</a></td>
                                            <td><a href="{{ route('admin.product.edit', $product->id) }}"
                                                    class="btn btn-warning btn-sm">Sửa</a></td>
                                            <td>
                                                <form action="{{ route('admin.product.destroy', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>


                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
    @endsection

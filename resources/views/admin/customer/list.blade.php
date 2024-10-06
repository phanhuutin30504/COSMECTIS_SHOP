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
            <!-- DataTables Example -->
            <form action="{{route('deleteSelected.customer')}}" method="post">
                @csrf
                @method('DELETE')

            <div class="action-bar">
                <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Tên </th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Tên người nhận</th>
                                    <th>Điện thoại người nhận</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer as $customers)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="{{$customers->id}}">
                                        </td>
                                    </form>
                                        <td>{{ $customers->name }}</td>
                                        <td>{{ $customers->email }}</td>
                                        <td>{{ $customers->mobile }}</td>

                                        <td>{{ $customers->housenumber_street }}</td>
                                        <td>{{ $customers->shipping_name }}</td>
                                        <td>{{ $customers->shipping_mobile }}</td>
                                        <td>
                                            {{ $customers->is_active == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}

                                        </td>
                                        <td> <a href="{{route('admin.customer.show',$customers->id)}}"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                            </td>
                                        <td>
                                            <form action="{{ route('admin.customer.destroy', $customers->id) }}"
                                                method="post">
                                                @csrf
                                                @method('Delete')
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
        <!-- /.container-fluid -->
    @endsection

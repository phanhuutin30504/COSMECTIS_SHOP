@extends('admin.admin_laytout')
@section('content-admin')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Đơn hàng</li>
       </ol>
       <!-- DataTables Example -->
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
                      <th>
                        <input type="checkbox" onclick="checkAll(this)">
                    </th>
                                      <th>Mã</th>
                                      <th>Tên khách hàng</th>
                                      <th>Điện thoai</th>
                                      <th>Email</th>
                                      <th>Trạng Thái</th>
                                      <th>Ngày đặt hàng</th>
                              <th>Người nhận</th>
                              <th>Số điện thoại người nhận</th>
                              <th>Hình thức thanh toán</th>
                                      <th>Tạm tính</th>
                              <th>Phí giao hàng</th>
                                      <th>Tổng cộng</th>
                                      <th>Địa chỉ giao hàng</th>
                              <th>Ngày giao</th>

                                      <th></th>
                                      <th></th>
                                      <th></th>
                                   </tr>
                                </thead>
                                <tbody>
                                 @foreach ($orders as $order)

                                 <tr>
                                    <td><input type="checkbox"></td>
                                           <td >#112</td>
                                           <td>{{$order->customer->name}}</td>
                                           <td>{{$order->customer->mobile}}</td>
                                           <td>{{$order->customer->email}}</td>
                                           <td>{{$order->status->description}}</td>
                                           <td>{{$order->created_at}}</td>
                                           <td>{{$order->shipping_fullname}}</td>
                                   <td>{{$order->shipping_mobile}}</td>
                                   <td>{{$order->payment_method == 0 ? 'COD' :'Chuyển khoản'}}</td>
                                   <td>
                                    @foreach ($order->items as $item)
                                        {{ number_format($item->unit_price, 0, ',', '.') }}<br>
                                    @endforeach
                                </td>
                                   <td>{{number_format($order->shipping_fee, 0, ',', '.')}}đ</td>
                                   <td>
                                    @php
                                        $totalUnitPrice = $order->items->sum('unit_price');
                                        $totalPrice = $totalUnitPrice + $order->shipping_fee;
                                    @endphp
                                    {{ number_format($totalPrice, 0, ',', '.') }}đ
                                </td>
                                           <td>{{$order->shipping_housenumber_street}}</td>
                                   <td> {{ \Carbon\Carbon::parse($order->created_at)->addDays(7)->format('d/m/Y') }}</td>

                                   <td>
                                    <input type="button" onclick="confirmOrder({{ $order->id }});" value="Xác nhận" class="btn btn-info btn-sm">
                                </td>
                                                                           <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                                           <td > <input type="button" onclick="DELETE('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
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

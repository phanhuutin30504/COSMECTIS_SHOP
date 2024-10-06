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
       <!-- /.row -->
       <form class="spacing" method="post" action="" enctype="multipart/form-data">
           <div class="row">
               <div class="col-sm-12 ">
                   <label for="name" class="control-label">Đơn hàng: #112</label>
                   <input type="hidden" name="id" value="112">
               </div>
           </div>
           <div class="row ">
               <div class="col-sm-4 col-lg-2">
                   <label>Tên khách hàng:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <span>Nguyễn Văn A</span>
               </div>
           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Email:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <span>a@gmail.com</span>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Trạng thái:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <select name="status" class="form-control">
                        <option value="1" selected>Đã đặt hàng</option>
                        <option value="2">Đã xác nhận đơn hàng</option>
                        <option value="3">Hoàn tất đóng gói</option>
                        <option value="4">Đang giao Hàng</option>
                        <option value="5">Đã giao hàng</option>
                        <option value="6">Đơn hàng đã huy</option>
                     </select>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Ngày đặt hàng:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <span>2019-03-10 15:35:59</span>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Người nhận</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <input type="text" name="" value="Nguyễn Văn Én" class="form-control">
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Số điện thoại người nhận</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <input type="text" name="mobile" value="0932538468" class="form-control">
               </div>
           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Hình thức thanh toán</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <select name="transport" class="form-control">
                        <option selected value="0">COD</option>
                        <option value="1">Bank</option>
                     </select>
               </div>
           </div>



           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Tạm tính:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <span>2,000,000 đ</span>
               </div>
           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Phí giao hàng:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <input type="number" value="50000"> đ
               </div>
           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Tổng cộng:</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <span>2,050,000 đ</span>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2">
                   <label>Địa chỉ giao hàng</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <div class="row">
                       <div class="col-sm-4">
                           <select name="city" class="form-control">
                              <option value="">Tỉnh / thành phố</option>
                              <option value="hcm">Hồ Chí Minh</option>
                              <option value="hn">Hà Nội</option>
                          </select>
                        </div>
                       <div class="col-sm-4">
                           <select name="district" class="form-control">
                               <option value="">Quận / huyện</option>
                               <option value="q1">Quận 1</option>
                               <option value="q2">Quận 2</option>
                           </select>
                       </div>
                       <div class="col-sm-4">
                           <select name="ward" class="form-control">
                               <option value="">Phường / xã</option>
                               <option value="p1">Phường 1</option>
                               <option value="p2">Phường 2</option>
                           </select>
                       </div>
                   </div>
               </div>

           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Ngày giao hàng</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <input type="date" name="" value="2019-07-17" class="form-control">
               </div>
           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Nhân viên phụ trách</label>
               </div>
               <div class="col-sm-8 col-lg-6">
                   <select name="staff" class="form-control">
                    <option selected value="6">Nguyễn Hữu Lộc</option>
                    <option value="7">Nguyễn Thị Lệ</option>
                 </select>
               </div>
           </div>

           <label class="control-label">Sản phẩm</label>
           <div class="form-group">
                <button class="btn btn-primary btn-sm">Thêm sản phẩm</button>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa sản phẩm" name="delete">
           </div>
           <div class="card mb-3">
                 <div class="card-body">
                    <div class="table-responsive">
                       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr>
                                  <th><input type="checkbox" onclick="checkAll(this)"></th>
                                 <th>Mã sản phẩm</th>
                                 <th>Tên sản phẩm</th>
                                 <th>Hình ảnh</th>
                                 <th>Giá</th>
                                 <th>Số lượng</th>
                                 <th>Thành tiền</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                  <td><input type="checkbox"></td>
                                 <td >#7452</td>
                                 <td>Kem Chống Nắng SunDefense 80ml</td>
                                 <td><img src="../../images/kemChongNangSunDefense80ml.jpg"></td>
                                 <td>1,350,000 đ <br><del>1,500,000 đ </del><br><del>15%</del></td>
                                 <td><span>2</span></td>
                                 <td><span>2,750,000 đ</span></td>

                              </tr>
                              <tr>
                                  <td><input type="checkbox"></td>
                                 <td >#7453</td>
                                 <td>Kem Dưỡng Trắng Da UV30 15g</td>
                                 <td><img src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                                 <td>1,350,000 đ</td>
                                 <td><span>3</span></td>
                                 <td><span>4,100,000 đ</span></td>
                              </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>

           <div class="form-action">
               <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
           </div>
           <br>
       </form>
   </div>
       <!-- /.row -->
       <!-- /.row -->

      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->

@endsection



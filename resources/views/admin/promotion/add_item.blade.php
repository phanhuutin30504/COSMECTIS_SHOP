@extends('admin.admin_laytout')
@section('content-admin')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Khuyến mại</li>
       </ol>
       <!-- /form -->
       <form method="post" action="" enctype="multipart/form-data">

          <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
             <thead>
                <tr>
                   <th><input type="checkbox" onclick="checkAll(this)"></th>
                   <th >Mã sản phẩm</th>
                   <th >Tên</th>
                   <th >Hình</th>
                   <th >Tỉ lệ giảm giá</th>

                </tr>
             </thead>
             <tbody>
                <tr>
                   <td><input type="checkbox"></td>
                   <td >124</td>
                   <td >Kem làm trắng da 5 trong 1 Beaumore Secret Whitening Cream</td>
                   <td ><img class="promotion-detail-image" src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                   <td ><input type="number" max="100" value="15"> %</td>

                </tr>
                <tr>
                   <td><input type="checkbox"></td>
                   <td >125</td>
                   <td >Kem làm trắng da 6 trong 1 Beaumore Secret Whitening Cream</td>
                   <td ><img class="promotion-detail-image" src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                   <td ><input type="number" max="100" value="20"> %</td>

                </tr>
                <tr>
                   <td><input type="checkbox"></td>
                   <td >126</td>
                   <td >Kem làm trắng da 7 trong 1 Beaumore Secret Whitening Cream</td>
                   <td ><img class="promotion-detail-image" src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                   <td ><input type="number" max="100" value="25"> %</td>

                </tr>
             </tbody>
          </table>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Thêm sản phẩm" name="update">
          </div>
          <br>
       </form>
       <!-- /form -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
       <div class="container my-auto">
          <div class="copyright text-center my-auto">
             <span>Copyright © Thầy Lộc 2017</span>
          </div>
       </div>
    </footer>
 </div>
@endsection

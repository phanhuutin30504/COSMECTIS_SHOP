@extends('admin.admin_laytout')
@section('content-admin')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Danh mục</li>
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
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th >Tên</th>
                         <th>
                         </th>
                         <th>
                         </th>
                      </tr>
                   </thead>
                   <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td >{{$category->name}}</td>
                        <td > <a href="{{route('admin.category.show',$category->id)}}" class="btn btn-warning btn-sm">Sửa</a></td>
                        <td >
                            <form action="{{route('admin.category.destroy',$category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            <button type="submit"  class="btn btn-danger btn-sm">Xóa</button>

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



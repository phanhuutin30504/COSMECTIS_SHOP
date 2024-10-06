@extends('admin.admin_laytout')
@section('content-admin')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Đánh giá</li>
       </ol>
       <!-- DataTables Example -->
       <form id="deleteForm" action="{{ route('deleteSelected.comment') }}" method="POST">
        @csrf
        @method('DELETE')
       <div class="action-bar">

        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
    </div>
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th>Email</th>
                         <th>Tên </th>
                         <th>Số sao</th>
                         <th>Ngày tạo</th>
                         <th>Nội dung</th>
                         <th></th>
                      </tr>
                   </thead>
                   <tbody>
                    @foreach ($comment as $comments)

                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $comments->id }}"></td>
                        <td>{{$comments->email}}</td>
                        <td>{{$comments->fullname}}</td>
                        <td>{{$comments->star}}</td>
                        <td>{{$comments->created_at}}</td>
                        <td>{{$comments->description}}</td>
                        <td>
                            <form action="{{route('admin.comment.destroy',$comments->id)}}" method="post">
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
       </form>
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->

@endsection


@extends('admin.admin_laytout')
@section('content-admin')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Hình ảnh</li>
       </ol>
       <!-- DataTables Example -->
       <form id="deleteForm" action="{{ route('deleteSelected.image') }}" method="POST">
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
                        </form>
                            <th>Hình ảnh</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->images as $image)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{$image->id}}"></td>
                            <td><img src="{{ asset($image->image_path) }}" width="100"></td>
                            <td>
                                <form action="{{ route('admin.products.deleteImage', $image->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Xóa" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.storeImages', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label>Upload hình</label>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <input type="file" name="images[]" id="image" class="form-control" multiple>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <input type="submit" value="Upload" class="btn btn-primary btn-sm">
            </div>
        </div>
    </form>

    </div>
    <!-- /.container-fluid -->

@endsection



@extends('admin.layouts.master')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="row p-3">
            <div class="col-md-6">
                 <h4 class="m-0 font-weight-bold text-primary">Danh mục</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('category.create') }}" class="btn btn-success"> 
                    <i class="fas fa-plus"> Thêm mới</i>
                </a>
            </div>
        </div>
        <hr>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if ($item->status==1)
                                Hiển thị
                            @else
                                Không hiển thị
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary edit" data-toggle="modal" data-target="#edit" data-id="{{ $item->id }}"> 
                              <i class="fas fa-edit"> Sửa</i>
                            </button>
                            <button class="btn btn-danger delete" data-toggle="modal" data-target="#delete" data-id="{{ $item->id }}">
                              <i class="fas fa-trash-alt"> Xoá</i>
                            </button>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-end">
              {{ $category->links() }}
            </div>
          </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục: <span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">
				        <div class="col-lg-12">
				            <form role="form">
				                <fieldset class="form-group">
				                    <label>Tên danh mục</label>
				                    <input class="form-control name" name="name" placeholder="Nhập tên danh mục">
				                    <span class="error" style="color: red;font-size: 1rem;"></span>
				                </fieldset>
				                <div class="form-group">
				                    <label>Trạng thái</label><br>
				                    <label class="radio-inline ml-5">
                                <input type="radio" name="status" class="show" id="status" value="1"> Hiển thị
                            </label>
                            <label class="radio-inline ml-2">
                                <input type="radio" name="status" class="hide" id="status" value="0"> Không hiển thị
                            </label>
				                </div>
				            </form>
				        </div>
				    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success update">Lưu</button>
                    <button type="reset" class="btn btn-primary">Làm Lại</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- delete Modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 183px;">
                    <button type="button" class="btn btn-success del">Có</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                <div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="assets/admin/js/ud_category.js"></script>
@endsection
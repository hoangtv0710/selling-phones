@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="row p-3">
            <div class="col-md-6">
                 <h4 class="m-0 font-weight-bold text-primary">Sản phẩm</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-success"> 
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
                    <th width="150px">Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Promotional</th>
                    <th>Danh mục</th>
                    <th>Loại danh mục</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($product as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td><img src="images/products/{{ $item->image }}" class="img-fluid"></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ number_format($item->promotional) }}</td>
                        
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->productType->name }}</td>
                        <td>
                            @if ($item->status==1)
                                Còn hàng
                            @else
                                Hết hàng
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
                {{ $product->links() }}
            </div>
          </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm <span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">
				        <div class="col-lg-12">
				            <form role="form" id="updateProduct" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" class="idProduct">
                                <fieldset class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input class="form-control name" name="name" placeholder="Nhập tên loại sản phẩm">
                                    <span class="error errorName text-danger" style="font-size: 1rem;"></span>
                                </fieldset>
                                <div class="form-group">
                                    <label for="quantity">Số lượng</label>
                                    <input type="number" name="quantity" min="1" value="1" class="form-control quantity">
                                    <span class="error errorQuantity text-danger" style="font-size: 1rem;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Đơn giá</label>
                                    <input type="text" name="price" placeholder="Nhập đơn giá" class="form-control price">
                                    <span class="error errorPrice text-danger" style="font-size: 1rem;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá khuyến mại</label>
                                    <input type="text" name="promotional" placeholder="Nhập giá khuyến mại nếu có" class="form-control promotional">
                                    <span class="error errorPromotional text-danger" style="font-size: 1rem;"></span>
                                </div>
                                <img class="img img-thumbnail imageThum" width="100" height="100" lign="center">
                                <div class="form-group">
                                    <label for="price">Ảnh sản phẩm</label>
                                    <input type="file" name="image" class="form-control image">
                                    <span class="error errorImage text-danger" style="font-size: 1rem;"></span>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả sản phẩm</label>
                                    <textarea name="description" id="editor" cols="5" rows="5" class="form-control description"></textarea>
                                    <span class="error errorDescription text-danger" style="font-size: 1rem;"></span>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục sản phẩm</label>
                                    <select class="form-control cate_id" name="cate_id"></select>
                                </div>
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                    <select class="form-control productType_id" name="productType_id"></select>
                                </div>
                                <div class="form-group" id="radio_status">
				                    <label>Trạng thái</label><br>
				                    <label class="radio-inline ml-5">
                                        <input type="radio" name="status" class="show" value="1"> Còn hàng
                                    </label>
                                    <label class="radio-inline ml-2">
                                        <input type="radio" name="status" class="hide" value="0"> Hết hàng
                                    </label>
				                </div>
                                <input type="submit" class="btn btn-success" value="Sửa">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            </form>
				        </div>
				    </div>
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
                    <button type="button" class="btn btn-success delProduct">Có</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('editor');
        <?php if (isset($cate) || isset($key)): ?>
            $('.result').css('display', 'none');
        <?php endif ?>
    </script>
    <script src="assets/admin/js/ud_product.js"></script>
@endsection

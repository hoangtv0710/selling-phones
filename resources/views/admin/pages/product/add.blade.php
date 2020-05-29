@extends('admin.layouts.master')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')
    <div class="card-header mb-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm loại sản phẩm</h6>
    </div>
    <div class="row m-2">
        <div class="col-lg-12">
            <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                 <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Tên sản phẩm:</label>
                        <input class="form-control" name="name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </fieldset>
                    
    
                    <fieldset class="form-group">
                        <label>Số lượng:</label><br>
                        <input type="number" class="form-control" name="quantity" value="1">
                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <label>Giá tiền:</label><br>
                        <input type="number" class="form-control" name="price">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </fieldset>

                    <fieldset class="form-group">
                        <label>Giá khuyến mại:</label><br>
                        <input type="number" class="form-control" name="promotional" value="0">
                        @if ($errors->has('promotional'))
                            <span class="text-danger">{{ $errors->first('promotional') }}</span>
                        @endif
                    </fieldset>
                    
                </div>
                
                <div class="col-md-6">
                    <fieldset class="form-group">
                        <label>Ảnh sản phẩm:</label>
                        <input type="file" class="form-control" name="image">
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </fieldset>

                    <fieldset class="form-group">
                        <label>Danh mục:</label><br>
                        <select class="form-control cate_id" name="cate_id"> 
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="form-group">
                        <label>Loại sản phẩm:</label><br>
                        <select class="form-control productType_id" name="productType_id"> 
                            @foreach ($product_type as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="form-group">
                        <label>Trạng thái:</label><br>
                        <label class="radio-inline ml-5">
                            <input type="radio" name="status" id="optionsRadiosInline1" value="1" checked> Hiển thị
                        </label>
                        <label class="radio-inline ml-2">
                            <input type="radio" name="status" id="optionsRadiosInline2" value="0"> Không hiển thị
                        </label>
                    </fieldset>
                </div>

            </div>
           <div class="col-md-12">
                <fieldset class="form-group">
                    <label>Mô tả:</label><br>
                    <textarea name="description" id="editor" rows="5"></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </fieldset>
           </div>
            <div class="action mt-5 text-right">
                <button type="submit" class="btn btn-success">Submit</button>
                <a class="btn btn-primary" href="{{ route('product.index') }}">Back</a>
            </div>
                
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('editor');
    </script>
    <script src="assets/admin/js/ud_product.js"></script>
@endsection
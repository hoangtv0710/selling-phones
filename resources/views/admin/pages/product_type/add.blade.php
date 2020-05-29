@extends('admin.layouts.master')

@section('title')
    Thêm loại sản phẩm
@endsection

@section('content')
    <div class="card-header mb-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm loại sản phẩm</h6>
    </div>
    <div class="row m-2">
        <div class="col-lg-6">
            <form role="form" action="{{ route('product_type.store') }}" method="POST">
                @csrf
                <fieldset class="form-group">
                    <label>Tên loại sản phẩm:</label>
                    <input class="form-control" name="name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </fieldset>

                <fieldset class="form-group">
                    <label>Danh mục:</label><br>
                    <select class="form-control" name="cate_id"> 
                        @foreach ($category as $item)
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
                <div class="action mt-5">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-primary">Back</button>
                </div>
                
            </form>
        </div>
    </div>
@endsection
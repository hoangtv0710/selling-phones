@extends('admin.layouts.master')

@section('title')
    Thêm danh mục sản phẩm
@endsection

@section('content')
    <div class="card-header mb-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm danh mục sản phẩm</h6>
    </div>
    <div class="row m-2">
        <div class="col-lg-6">
            <form role="form" action="{{ route('category.store') }}" method="POST">
                @csrf
                <fieldset class="form-group">
                    <label>Tên danh mục:</label>
                    <input class="form-control" name="name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
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
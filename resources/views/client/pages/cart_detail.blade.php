@extends('client.layouts.master')

@section('title')
    Giỏ hàng 
@endsection

@section('content')
    <h2 class="text-center text-primary mb-5">Chi tiết giỏ hàng</h2>
    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Sản phẩm</th>
                    <th style="width:15%">Đơn giá</th>
                    <th style="width:10%">Số lượng</th>
                    <th style="width:20%" class="text-center">Tổng tiền</th>
                    <th style="width:5%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img src="images/products/{{ $item->options->img }}" class="img-fluid"/></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{ $item->name }}</h4>
                                    <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{ number_format($item->price) }} VNĐ</td>
                        <td data-th="Quantity">
                            <input type="number" name="qty" min="1" class="form-control text-center qty" value="{{ $item->qty }}" data-id="{{ $item->rowId }}">
                        </td>
                        <td data-th="Subtotal" class="text-center">{{ number_format($item->price*$item->qty) }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm delete_cart"  data-id="{{ $item->rowId }}" title="Xoá"><i class="fa fa-trash"></i></button>								
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Tổng tiền cần thanh toán: {{ Cart::subtotal() }} VNĐ</strong></td>
                    <td><a href="{{ route('checkout') }}" class="btn btn-success btn-block">Đặt hàng <i class="fa fa-angle-right"></i></a></td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- delete cart --}}
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 183px;">
                    <button type="button" class="btn btn-success delCart">Có</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="assets/client/js/ajax.js"></script>
@endsection
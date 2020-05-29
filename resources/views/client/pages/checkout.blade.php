@extends('client.layouts.master')

@section('title')
    Giỏ hàng 
@endsection

@section('content')
    <main class="page payment-page">
        <section class="payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2>Đặt hàng</h2>
                    <p>Vui lòng kiểm tra sản phẩm và điền các thông tin cần thiết để tiến hành đặt hàng</p>
                </div>
                <form action="{{ route('order') }}" method="POST">
                    @csrf
                    <div class="products">
                        <h3 class="title">Sản phẩm</h3>
                        @foreach($cart as $item)
                            <div class="row item">
                                <div class="col-md-1">
                                    <img src="images/products/{{ $item->options->img }}" class="img-fluid w-100"/>
                                </div>
                                <div class="col-md-5">
                                    <p class="item-name">{{ $item->name }}</p>
                                    <p class="item-description">Đơn giá: {{ number_format($item->price) }} VNĐ</p>
                                    <p class="item-description">Số lượng: {{ $item->qty }}</p>
                                </div>
                                <div class="col-md-6">
                                    <span class="price">Tổng tiền: {{ number_format($item->price*$item->qty) }} VNĐ</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="total">Tổng tiền cần thanh toán:<span class="price">{{ Cart::subtotal() }} VNĐ</span></div>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Thông tin đặt hàng</h3>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Tên</label>
                                <input id="name" type="text" name="name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Số điện thoại</label>
                                <input id="phone" type="text" name="phone" class="form-control">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-5">
                                <label>Email</label>
                                <input id="email" type="text" name="email" class="form-control">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-7">
                                <label>Địa chỉ nhận hàng</label>
                                <input id="address" type="text" name="address" class="form-control">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label>Ghi chú</label>
                                <textarea name="message" id="" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
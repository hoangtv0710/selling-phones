<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;

class CartController extends ClientController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content();
        return view('client.pages.cart_detail',compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->qty){
            $qty = $request->qty;
        } else {
            $qty = 1;
        }
        if($product->promotional > 0){
            $price = $product->promotional;
        } else {
            $price = $product->price;
        }
        $cart = ['id' => $id, 'name' => $product->name, 'qty' => $qty, 'price' => $price, 'options' => ['img' => $product->image]];
        Cart::add($cart);
        return back()->with('thongbao', 'Đã thêm sản phẩm '.$product->name.' vào giỏ hàng');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            if($request->qty == 0) {
                return response()->json(['error' => 'Số lượng không được phép bằng 0']);
            }
            Cart::update($id,$request->qty);
            return response()->json(['success' => 'Cập nhập số lượng thành công']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Cart::remove($id);
        return response()->json(['success' => 'Xoá sản phẩm khỏi giỏ hàng thành công']);
    }

    public function checkout(){
        $cart = Cart::content();
        return view('client.pages.checkout',compact('cart'));
    }

}

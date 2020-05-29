<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Requests\OrderRequest;
use Carbon\Carbon;
use Cart;
use Mail;
use App\Mail\ShoppingMail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Bạn đã vào trang order";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $date_time = Carbon::now('Asia/Ho_Chi_Minh');
        $total_price = str_replace(',', '', Cart::subtotal());
        $data = $request->all();
        $data['user_id'] = 0;
        $data['code_order'] = 'order'.rand();
        $data['status'] = 0;
        $data['total_price'] = $total_price;
        $data['created_at'] = $date_time;
        $order = Order::create($data);
        $order_id = $order->id;
        $order_detail = [];
        $order_details = [];
        foreach ( Cart::content() as $key => $cart ){
            $order_detail['order_id'] = $order_id;
            $order_detail['product_id'] = $cart->id;
            $order_detail['quantity'] = $cart->qty;
            $order_detail['price'] = $cart->price;
            $order_details[$key] = OrderDetail::create($order_detail);
        }
        Mail::to($order->email)->send(new ShoppingMail($order, $order_details));
        Cart::destroy();
        return redirect('/')->with('thongbao', 'Đặt hàng thành công! Chúng tôi sẽ gọi lại để xác nhận đơn hàng trong thời gian sớm nhất');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

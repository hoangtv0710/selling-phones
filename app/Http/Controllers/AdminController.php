<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\User;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $data = $request->only(['email', 'password']);
        // KIỂM TRA ĐĂNG NHẬP EMAIL VÀ PASSWWORD VỪA NHẬN
        $checkAdminLogin = Auth::attempt($data, $request->has('remember'));
        if ($checkAdminLogin == true) {
            if(Auth::user()->role === 0){
                return redirect()->route('login.admin')
                                ->with('error', 'Bạn không đủ quyền truy cập');
            } elseif (Auth::user()->status === 0) {
                return back()
                            ->with('error', 'Tài khoản chưa được kích hoạt');
            } elseif(Auth::user()->role === 1) {
                return redirect('admin/')
                                ->with('thongbao', 'Đăng nhập thành công');
            } elseif(Auth::user()->role === 2) {
                return redirect()->route('category.index'
                                )->with('thongbao', 'Đăng nhập thành công');
            } elseif(Auth::user()->role === 3) {
                return redirect()->route('product.index')
                                ->with('thongbao', 'Đăng nhập thành công');
            } elseif(Auth::user()->role === 4) {
                return redirect()->route('order.index')
                                ->with('thongbao', 'Đăng nhập thành công');
            }
        } else {
            return back()->with('error', 'Email hoặc mật khẩu không đúng vui lòng đăng nhập lại');
        }
    }

    public function logoutAdmin()
    {
        if(Auth::check()){
            Auth::logout();
            Session::flush();
            return redirect()->route('login.admin')->with('thongbao','Đăng xuất tài khoản thành công');
        }
    }
}

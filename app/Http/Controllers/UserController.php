<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Session;
use Mail;
use Carbon\Carbon;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // Auth::login($user);  đăng nhập luôn sau khi đăng ký

        // verify email
        if ($user->id) {
            $email = $user->email;

            $code_active = bcrypt(md5(time().$email));
            $url = route('verify_email', ['id' => $user->id, 'code_active' => $code_active]);

            $user->code_active = $code_active;
            $user->save();

            $data = [
                'route' => $url
            ];

            Mail::send('mail.verify_email', $data, function ($message) use ($email) {
                $message->to($email, 'Verify Email')->subject('Xác nhận email');
            });
            
            return back()->with('thongbao','Đăng ký tài khoản thành công, vui lòng check mail để xác nhận tài khoản');
        }
    }

    public function verifyEmail(Request $request)
    {
        $code_active = $request->code_active;
        $id = $request->id;

        $verifyEmail = User::where([
            'code_active' => $code_active,
            'id' => $id,
        ])->first();

        print('<pre>');
        print_r($verifyEmail);
        print('</pre>');

        if(!$verifyEmail){
            return redirect('/')->with('error', 'Đường dẫn lỗi, hoặc không tồn tại vui lòng kiểm tra lại');
        }
        $verifyEmail->status = 1;
        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $verifyEmail->email_verified_at = $today;
        $verifyEmail->save();
        return redirect('/')->with('thongbao', 'Xác minh tài khoản thành công');
    }
    // end verify email

    public function login(Request $request)
    {
        // check validate , lấy ra dữ liệu
        $data = $request->only(['email', 'password']);
        // KIỂM TRA ĐĂNG NHẬP EMAIL VÀ PASSWWORD VỪA NHẬN
        $checklogin = Auth::attempt($data, $request->has('remember'));
        
        if ($checklogin == false) {
            return back()->with('error', 'Email hoặc mật khẩu không đúng vui lòng đăng nhập lại');
        } elseif(Auth::user()->status == 0) {
            return back()->with('error', 'Tài khoản của bạn chưa được kích hoạt');
        } else{
            return back()->with('thongbao','Đăng nhập thành công');
        }
    }

    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            Session::flush();
            return back()->with('thongbao','Đăng xuất tài khoản thành công');
        }
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,
            [
                'password' => 'required|min:6|max:255',
                'confirm_password' => 'required|same:password',
            ],
            [
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải trên 6 ký tự',
                'password.max' => 'Mật khẩu không được nhiều hơn 255 ký tự',
                'confirm_password.required' => 'Vui lòng xác minh lại mật khẩu',
                'confirm_password.same' => 'Mật khẩu không trùng',
            ]
        );
        $user  = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('thongbao','Cập nhật mật khẩu thành công');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

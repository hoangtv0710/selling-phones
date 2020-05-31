<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ResetPassword;
use Hash;
use Auth;
use Session;
use Mail;
use Carbon\Carbon;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;

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
            
            return back()->with('thongbao','Đăng ký tài khoản thành công, vui lòng kiểm tra email để xác nhận tài khoản');
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

    //reset password
    public function forgetPassword(Request $request)
    {
        $result = User::where('email', $request->email)->first();
        $email = $request->email;
        if($result){
            $resetPassword = ResetPassword::firstOrCreate(['email'=>$request->email, 'token'=>Str::random(60)]);

            $token = ResetPassword::where('email', $request->email)->first();
            // $url = route('reset_password')."/".$token->token; //send it to email
            $url = route('reset_password', ['token' => $token->token]);
            $data = [
                'route' => $url
            ];
            Mail::send('mail.reset_password', $data, function ($message) use ($email) {
                $message->to($email, 'Reset Password')->subject('Đổi mật khẩu');
            });
            return redirect('/')->with('thongbao', 'Vui lòng kiểm tra email của bạn để xác minh');
        } elseif ($email == "") {
             return back()->with('error', 'Vui lòng nhập email!');
        } else {
            return back()->with('error', 'Email không tồn tại, vui lòng kiểm tra lại!');
        }
    }

    public function resetPassword(Request $request)
    {
        $result = ResetPassword::where('token', $request->token)->first();

        if($result){
            $data['info'] = $result->token;
            return view('client.pages.reset_password', $data);
        } else {
            return redirect('/')->with('error', 'Đường dẫn lỗi, hoặc không tồn tại vui lòng kiểm tra lại');
        }
    }

    public function newPassword(UpdatePasswordRequest $request)
    {
        $result = ResetPassword::where('token', $request->token)->first();
        User::where('email', $result->email)->update(['password'=>bcrypt($request->password)]);
        ResetPassword::where('token', $request->token)->delete();
        return redirect('/')->with('thongbao', 'Cập nhập mật khẩu thành công');
    }
    //end reset password

    public function logout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            Session::flush();
            return back()->with('thongbao','Đăng xuất tài khoản thành công');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
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

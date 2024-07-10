<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\DangNhapUser;
use App\Models\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Mail;
class DangNhapUserController extends Controller
{
    public function giaodienuser()
    {
        return view("user/index");
    }
    public function dangnhapuser()
    {
        return view("user/dang-nhap");
    }
    public function logout()
    {
        auth('cus')->logout();
        return redirect()->route('user.dang-nhap')->with('thong_bao','Đăng xuất thành công');
    }
    public function check_login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:user',
            'password'=>'required'
        ]);
        $data = $request->only('email', 'password');

        $check = auth('cus')->attempt($data);
        
        if ($check) {
            if (auth('cus')->user()->email_verified_at == '') {
                auth('cus')->logout();
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác nhận');
            }
            return redirect()->route('user.index')->with('thong_bao', 'Xin chào');
        }
        
        return redirect()->back()->with('error', 'Sai tài khoản hoặc mật khẩu');
        
    }
    
    public function dangky()
    {
        return view("user/dang-ky");
    }
    public function check_dangky(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:user',
            'password'=>'required|min:4',
            'so_dien_thoai'=>'required|min:10|max:10',
            'confirm_password'=>'required|min:4|same:password',
        ],[
            'ho_ten.required' => 'Họ tên không được để trống',
            'ho_ten.min'=> 'Họ tên tối thiểu kí là 6 kí tự'
        ]);
        $data = $request->only('ho_ten', 'email', 'so_dien_thoai', 'password');
        $data['password'] = bcrypt($request->password);

        if ($acc = DangNhapUser::create($data)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('user.dang-nhap')->with('thong_bao', 'Đăng ký thành công, vui lòng check mail để đăng nhập');
        }
        return redirect()->back()->with('error','Vui lòng thử lại');
    }
    
    public function verify($email)
    {
        $acc=DangNhapUser::where('email',$email)->whereNull('email_verified_at')->firstOrFail();
        DangNhapUser::where('email',$email)->update(['email_verified_at'=>date('Y-m-d')]);
        return redirect()->route('user.dang-nhap')->with('thong_bao','Bây giờ!Bạn có đăng nhập');
    }
    public function change_pass()
    {
        return view("user.change_pass");
    }
    public function check_change_pass()
    {
    
    }
    public function forgot_pass()
    {
        return view("user.forgot-pass");
    }
    public function check_forgot_pass(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:user'
        ]);
        $cus =DangNhapUser::where('email',$request->email)->first();
        $token=\Str::random(50);
        $tokenData =[
            'email' => $request->email,
            'token' => $token
        ];
        if(ResetPassword::create($tokenData)){
            Mail::to($request->email)->send(new ForgotPassword($cus,$token));
            return redirect()->route('user.dang-nhap')->with('thong_bao','Gửi mail thành công vui lòng check');
        }
        return redirect()->back()->with('error', 'Bạn chưa xác nhận email');
        //$data = $request->only('email', 'password');
    }
    public function profile()
    {
        $auth=auth('cus')->user();
        return view("user.profile",compact('auth'));
    }
    public function check_profile(Request $request)
    {
        $auth=auth('cus')->user();
        $request->validate([
            'ho_ten' => 'required|min:6|max:100',
            'so_dien_thoai'=>'required|min:10|max:10',
            'email' => 'required|email|min:6|max:100|unique:user,email,'.$auth->id,
            'password'=>['required',function($attr,$value,$fail) use($auth){
                if(!Hash::check($value,$auth->password)){
                    return $fail('Your password is not must');
                }
            }],
            
        ],[
            'ho_ten.required' => 'Họ tên không được để trống',
            'ho_ten.min'=> 'Họ tên tối thiểu kí là 6 kí tự',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
        ]);
        $data = $request->only('ho_ten', 'email', 'so_dien_thoai');

        $check=$auth->update($data);
        if($check){
            return redirect()->back()->with('thong_bao','Cập nhật thành công');
        }
        return redirect()->back()->with('error','Có lỗi vui lòng kiểm tra lại');
        
    }
    public function reset_pass($token)
    {
        $tokenData=ResetPassword::checkToken($token);
        return view("user.reset-pass");
    }
    public function check_reset_pass($token)
    {
        request()->validate([
            'password' =>'required|min:4',
            'confirm_password'=>'required|same:password',
        ]);
        $tokenData=ResetPassword::CheckToken($token);
        $cus=  $tokenData->customer();
        $data=[
            'password'=>bcrypt(request(('password'))),
        ];
        $check=$cus->update($data);
        if($check){
            return redirect()->route('user.dang-nhap')->with('thong_bao','Cập nhật mật khẩu thành công');
        }
        return redirect()->back()->with('error','Có lỗi vui lòng kiểm tra lại');
    }
}

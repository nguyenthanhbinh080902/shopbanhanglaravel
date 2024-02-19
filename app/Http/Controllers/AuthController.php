<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|max:255|unique:tbl_admin|email',
            'admin_phone' => 'required|max:255',
            'admin_password' => 'required|max:255',
        ],
        [
            'admin_email.unique' => 'Email này tồn tại, xin vui lòng điền tên khác',
            'admin_name.required' => 'Tên người dùng bắt buộc',
        ]);

        $admin = new Admin();
        $admin->admin_email = $data['admin_email'];
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();

        return Redirect('/dashboard')->with('message', 'Đăng ký thành công');
    }

    public function login_auth(){
        return view('admin.custom_auth.login_auth');
    }

    public function login(Request $request){
        $data = $request->all();
        if(Auth::attempt(['admin_email' => $data['admin_email'], 'admin_password' => $data['admin_password']])){
            return redirect('/dashboard');
        }else{
            return redirect('/login-auth')->with('message', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth')->with('message', 'Đăng xuất Authentication thành công');
    }
}

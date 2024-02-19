<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function all_users(){
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.user.all_users')->with(compact('admin'));
    }

    public function add_users(){
        return view('admin.user.add_users');
    }

    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        return Redirect::to('all-users')->with('message', 'Thêm user thành công');
    }

    public function assign_roles(Request $request){
        $data = $request->all();
        if(Auth::id() == $request->admin_id){
            return Redirect()->back()->with('message', 'Bạn không được phân quyền tài khoản của bản thân ???');
        }
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        $user->roles()->detach(); // detach() là xóa hết role của 1 tài khoản 

        if($request->author_role){
            $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request->admin_role){
            $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request->user_role){
            $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return Redirect()->back()->with('message', 'Phân quyền thành công');
    }

    public function delete_user_roles(Request $request, $admin_id){
        if(Auth::id() == $request->admin_id){
            return Redirect()->back()->with('message', 'Bạn đang tự xóa tài khoản của bản thân ???');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }

        return Redirect()->back()->with('message', 'Xóa user thành công');

    }

    public function impersionate(Request $request, $admin_id){

    }
}

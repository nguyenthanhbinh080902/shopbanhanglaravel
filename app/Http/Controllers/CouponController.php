<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class CouponController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send('bạn chưa đăng nhập!!!');
        }
    }

    public function add_coupon(){
        $this->AuthLogin();
        return view('admin.coupon.add_coupon');
    }

    public function all_coupon(){
        $this->AuthLogin();
        $all_coupon = Coupon::orderBy('coupon_id', 'DESC')->get();
        return view('admin.coupon.all_coupon')->with(compact('all_coupon'));
    }

    public function save_coupon(Request $request){
        $this->AuthLogin();

        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();
        
        return Redirect::to('all-coupon')->with('message', 'Thêm mã giảm giá thành công');
    }

    public function edit_coupon($coupon_id){
        $this->AuthLogin();

        $edit_coupon = Coupon::where('coupon_id', $coupon_id)->get();

        return view('admin.coupon.edit_coupon', compact('edit_coupon')); 
        // echo '<pre>';
        // print_r($edit_coupon);
        // echo '</pre>';
    }

    public function update_coupon(Request $request, $coupon_id){
        $this->AuthLogin();
        
        $data = $request->all();
        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();
        
        return Redirect::to('all-coupon')->with('message', 'Sửa mã giảm giá thành công');;
    }

    public function delete_coupon($coupon_id){
        $this->AuthLogin();

        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return Redirect::to('all-coupon')->with('status', 'Xóa mã giảm giá thành công');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send('bạn chưa đăng nhập!!!');
        }
    }

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.brand_product.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = Brand::orderBy('brand_id', 'DESC')->paginate(2);
        return view('admin.brand_product.all_brand_product', compact('all_brand_product'));
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->meta_keywords = $data['brand_product_keywords'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        
        return Redirect::to('all-brand-product')->with('status', 'Thêm thương hiệu sản phẩm thành công');
    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        $brand->update(['brand_status'=>0]);
        return Redirect::to('all-brand-product')->with('status', 'Cập nhật tình trạng thương hiệu thành công');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        $brand->update(['brand_status'=>1]);
        return Redirect::to('all-brand-product')->with('status', 'Cập nhật tình trạng thương hiệu thành công');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();

        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        
        return view('admin.brand_product.edit_brand_product', compact('edit_brand_product')); 
    }

    public function update_brand_product(Request $request, $brand_product_id){ // Request để lấy yêu cầu dữ liệu
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->meta_keywords = $data['brand_product_keywords'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        return Redirect::to('all-brand-product')->with('status', 'Cập nhật thương hiệu sản phẩm thành công');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        $brand->delete();
        return Redirect::to('all-brand-product')->with('status', 'Xóa thương hiệu sản phẩm thành công');
    }

    // end admin page

}

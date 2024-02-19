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

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send('bạn chưa đăng nhập!!!');
        }
    }

    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.category_product.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = Category::orderBy('category_id', 'DESC')->get();
        return view('admin.category_product.all_category_product', compact('all_category_product'));
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category = new category();
        $category->category_name = $data['category_product_name'];
        $category->category_slug = $data['category_product_slug'];
        $category->category_desc = $data['category_product_desc'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_status = $data['category_product_status'];
        $category->save();
        
        return Redirect::to('all-category-product')->with('status', 'Thêm danh mục sản phẩm thành công');;
    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        $category = Category::find($category_product_id);
        $category->update(['category_status'=>0]);
        return Redirect::to('all-category-product')->with('status', 'Cập nhật tình trạng danh mục thành công');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        $category = Category::find($category_product_id);
        $category->update(['category_status'=>1]);
        return Redirect::to('all-category-product')->with('status', 'Cập nhật tình trạng danh mục thành công');
    }

    public function edit_category_product($category_product_id){
        //$this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.category_product.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_product_id){ // Request để lấy yêu cầu dữ liệu
        $this->AuthLogin();
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_status = $data['category_product_status'];
        $category->save();
        return Redirect::to('all-category-product')->with('status', 'Cập nhật danh mục sản phẩm thành công');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        $category = Category::find($category_product_id);
        $category->delete();
        return Redirect::to('all-category-product')->with('status', 'Xóa danh mục sản phẩm thành công');
    }
}   

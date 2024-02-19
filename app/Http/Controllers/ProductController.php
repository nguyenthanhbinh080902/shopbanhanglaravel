<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send('bạn chưa đăng nhập!!!');
        }
    }

    public function add_product(){
        $this->AuthLogin();
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.product.add_product', compact('category_product_id', 'brand_product_id'));
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=' ,'tbl_product.category_id' )
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=' ,'tbl_product.brand_id' )
        ->orderBy('tbl_product.product_id', 'DESC')->get();  
        return view('admin.product.all_product', compact('all_product'));
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_price = $data['product_price'];
        $product->product_status = $data['product_status'];

        $get_image = $request->product_image;
        $path = 'upload/product/';
        $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $product->product_image = $new_image;
        $product->save();
        return Redirect::to('all-product')->with('status', 'Thêm sản phẩm thành công');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        $product = Product::find($product_id);
        $product->update(['product_status'=>0]);
        return Redirect::to('all-product')->with('status', 'Không kích hoạt sản phẩm thành công');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        $product = Product::find($product_id);
        $product->update(['product_status'=>1]);
        return Redirect::to('all-product')->with('status', 'Kích hoạt sản phẩm thành công');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        $edit_product = Product::where('product_id', $product_id)->get();
        return view('admin.product.edit_product', compact('edit_product', 'category_product_id', 'brand_product_id'));    }

    public function update_product(Request $request, $product_id){ // Request để lấy yêu cầu dữ liệu
        $this->AuthLogin();
        $data = $request->all();

        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_price = $data['product_price'];
        $product->product_status = $data['product_status'];

        $get_image = $request->product_image;
        if($get_image){
            // Xóa hình ảnh cũ
            $path_unlink = 'upload/product/'.$product->product_image;
            if (file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // Thêm mới
            $path = 'upload/product/';
            $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $product->product_image = $new_image;
        }
        $product->save();
        return Redirect::to('all-product')->with('status', 'Cập nhật sản phẩm thành công');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        $product = product::find($product_id);
        $path_unlink = 'upload/product/'.$product->product_image;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $product->delete();
        return Redirect::to('all-product')->with('status', 'Xóa sản phẩm thành công');
    }
}

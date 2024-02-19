<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request){
        //SEO
        $meta_desc = "Chuyên bán những phụ kiện game của các hãng lớn, trong đó có rất nhiều sản phẩm tốt chất lượng cao";
        $meta_keywords = "Laptop, điện thoại, PC, card";
        $meta_title = "Hai Phong PC - Nơi bán PC tốt nhất Việt Nam";
        $url_canonical = $request->url();
        $image_og = $url_canonical.'/upload/product/logo.jpg';
        //--SEO

        $category_product_id = Category::orderBy('category_id', 'DESC')->where('category_status', '1')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->where('brand_status', '1')->get();
        $product_id = Product::orderBy('product_id', 'DESC')->where('product_status', '1')->get();
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();
        
        return view('pages.home')->with(compact('category_product_id', 'brand_product_id', 'product_id', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    public function tim_kiem(Request $request){
        $category_product_id = Category::orderBy('category_id', 'DESC')->where('category_status', '1')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->where('brand_status', '1')->get();
        $product_id = Product::orderBy('product_id', 'DESC')->where('product_status', '1')->get();
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();
        $keywords = $request->keywords_submit;

        if($keywords == ''){
            return Redirect::to('/trang-chu');
        }

        foreach($product_id as $key => $value){
            $meta_desc = "Tìm kiếm sản phẩm";
            $meta_keywords = "Tìm kiếm sản phẩm";
            $meta_title = "Tìm kiếm sản phẩm";
            $url_canonical = $request->url();
            $image_og = $url_canonical.'/upload/product/logo.jpg';
        }

        $search_product = Product::where('product_name', 'like', '%'.$keywords.'%')->get();
        return view('pages.product.sreach', compact('category_product_id', 'brand_product_id', 'search_product', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    // SEO
    public function show_category_home(Request $request, $category_id){
        $category_product_id = Category::orderBy('category_id', 'DESC')->where('category_status', '1')->get();

        $category_name = Category::where('category_id', $category_id)->get();

        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->where('brand_status', '1')->get();

        $category_by_id = Product::join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->where('tbl_product.category_id', '=', $category_id)->get();

        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();

        foreach($category_product_id as $key => $value){
            $meta_desc = $value->category_desc;
            $meta_keywords = $value->meta_keywords;
            $meta_title = $value->category_name;
            $url_canonical = $request->url();
            $image_og = $url_canonical.'/upload/product/logo.jpg';
        }

        return view('pages.category.show_category', compact('category_product_id', 'brand_product_id', 'category_by_id', 'category_name', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    public function show_brand_home(Request $request, $brand_id){
        $category_product_id = Category::orderBy('category_id', 'DESC')->where('category_status', '1')->get();

        $brand_name = Brand::where('brand_id', $brand_id)->get();

        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->where('brand_status', '1')->get();

        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();
        
        $brand_by_id = Product::join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->where('tbl_product.brand_id', '=', $brand_id)->get();
        
        foreach($brand_product_id as $key => $value){
            $meta_desc = $value->brand_desc;
            $meta_keywords = $value->meta_keywords;
            $meta_title = $value->brand_name;
            $url_canonical = $request->url();
            $image_og = $url_canonical.'/upload/product/logo.jpg';
        }

        return view('pages.brand.show_brand', compact('category_product_id', 'brand_product_id', 'brand_by_id', 'brand_name', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    public function details_product(Request $request, $product_id){
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        
        $details_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=' ,'tbl_product.category_id' )
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=' ,'tbl_product.brand_id' )
        ->where('tbl_product.product_id', $product_id)->get();
        
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();
        
        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }
        
        //SomeModel::select(..)->whereNotIn('book_price', [100,200])->get();
        $related_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=' ,'tbl_product.category_id' )
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=' ,'tbl_product.brand_id' )
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get();

        foreach($details_product as $key => $value){
            $meta_desc = $value->brand_desc;
            $meta_keywords = $value->meta_keywords;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
            $image_og = $url_canonical.'/upload/product/'.$value->product_image;
        }

        return view('pages.product.show_details', compact('category_product_id', 'brand_product_id', 'details_product', 'related_product', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }
}

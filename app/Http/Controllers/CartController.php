<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    // public function update_cart_quantity(Request $request){
    //     $rowId = $request->rowId_cart;
    //     $qty = $request->cart_quantity;
    //     Cart::update($rowId, $qty);
    //     return Redirect::to('/show-cart');
    // }

    // Cart ajax
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        // khi mỗi sp dc thêm vào giỏ hàng thì tạo 1 $session_id làm vc thic dựa vào $session_id đó
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0;
            foreach($cart as $key => $value){
                if($value['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }

    public function show_cart_ajax(Request $request){
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();

        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng ajax";
        $meta_title = "Giỏ hàng ajax";
        $url_canonical = $request->url();
        $image_og = $url_canonical.'/upload/product/logo.jpg';

        return view('pages.cart.cart_ajax')->with(compact('category_product_id', 'brand_product_id', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    public function update_cart_ajax(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');

        if($cart==true){
            $message = '';
            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $value){
                    $i++;
                    if( $value['session_id'] == $key  &&  $qty < $cart[$session]['product_quantity'] ){
                        $cart[$session]['product_qty'] = $qty;
                        $message.= '<p style="color:green" >'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' thành công</p>';
                    }elseif( $value['session_id'] == $key  &&  $qty > $cart[$session]['product_quantity'] ){
                        $message.= '<p style="color:red" >'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' thất bại</p>';
                    }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', $message);
        }else{
            return Redirect()->back()->with('message', $message);
        }
    }

    public function delete_cart_ajax(Request $request, $session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $value){
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng');
        }else{
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng thất bại');
        }
    }

    public function delete_all_cart_ajax(){
        $cart = Session::get('cart');
        if($cart == true){
            // Session::destroy(); xóa hết (Session đăng nhập...)
            Session::forget('cart');
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Xóa hết sản phẩm khỏi giỏ hàng');
        }
    }

    // Coupon 
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first(); // dùng first ko cần foreach()
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,  
                            'coupon_number' => $coupon->coupon_number,  
                        );
                        Session::put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,  
                        'coupon_number' => $coupon->coupon_number,  
                    );
                    Session::put('coupon', $cou);
                }
                //Session::save();
                return Redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        }
        return Redirect()->back()->with('error', 'mã giảm giá không đúng');
    }

    public function delete_coupon_cart_ajax(){
        $coupon = Session::get('coupon');
        if($coupon){
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Xóa mã giảm giá khỏi giỏ hàng');
        }
    }
}

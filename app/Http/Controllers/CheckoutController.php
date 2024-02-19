<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send('bạn chưa đăng nhập!!!');
        }
    }

    public function login_checkout(Request $request){
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();

        $meta_desc = "Chuyên bán những phụ kiện game của các hãng lớn, trong đó có rất nhiều sản phẩm tốt chất lượng cao";
        $meta_keywords = "Laptop, điện thoại, PC, card";
        $meta_title = "Đăng nhập trước khi thanh toán";
        $url_canonical = $request->url();
        $image_og = $url_canonical.'/upload/product/logo.jpg';
        
        return view('pages.checkout.login_checkout')->with(compact('category_product_id', 'brand_product_id', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function add_customer(Request $request){
        $data = array();

        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout(Request $request){
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();

        $meta_desc = "Chuyên bán những phụ kiện game của các hãng lớn, trong đó có rất nhiều sản phẩm tốt chất lượng cao";
        $meta_keywords = "Laptop, điện thoại, PC, card";
        $meta_title = "Đăng nhập thành công";
        $url_canonical = $request->url();
        $image_og = $url_canonical.'/upload/product/logo.jpg';
       
        $city = City::orderBy('matp', 'ASC')->get();
       
        return view('pages.checkout.show_checkout')->with(compact('category_product_id', 'brand_product_id', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'))
        ->with(compact('city'));
    }

    public function save_checkout_customer(Request $request){
        $data = array();

        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment(Request $request){
        $category_product_id = Category::orderBy('category_id', 'DESC')->get();
        $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
        $slider_id = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->get();

        $meta_desc = "Chuyên bán những phụ kiện game của các hãng lớn, trong đó có rất nhiều sản phẩm tốt chất lượng cao";
        $meta_keywords = "Laptop, điện thoại, PC, card";
        $meta_title = "Trang thanh toán";
        $url_canonical = $request->url();
        $image_og = $url_canonical.'/upload/product/logo.jpg';

        return view('pages.checkout.payment')->with(compact('category_product_id', 'brand_product_id', 'slider_id'))
        ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    }

    public function login_customer(Request $request){
        $email = $request->customer_email;
        $password = md5($request->customer_password);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }

    // public function order_place(Request $request){
    //     //insert payment_method
    //     $data = array();
    //     $data['payment_method'] = $request->payment_option;
    //     $data['payment_status'] = 'Đang chờ xử lý';
    //     $payment_id = DB::table('tbl_payment')->insertGetId($data);
       
    //     // insert order
    //     $order_data = array();
    //     $order_data['customer_id'] = Session::get('customer_id');
    //     $order_data['shipping_id'] = Session::get('shipping_id');
    //     $order_data['payment_id'] = $payment_id;
    //     $order_data['order_total'] = Cart::total();
    //     $order_data['order_status'] = 'Đang chờ xử lý';
    //     $order_id = DB::table('tbl_order')->insertGetId($order_data);

    //     //SEO 
    //     $meta_desc = "Chuyên bán những phụ kiện game của các hãng lớn, trong đó có rất nhiều sản phẩm tốt chất lượng cao";
    //     $meta_keywords = "Laptop, điện thoại, PC, card";
    //     $meta_title = "Chọn hình thức thanh toán";
    //     $url_canonical = $request->url();
    //     $image_og = $url_canonical.'/upload/product/logo.jpg';

    //     $content = Cart::content();
    //     foreach($content as $v_content){
    //         $order_d_data = array();
    //         $order_d_data['order_id'] = $order_id;
    //         $order_d_data['product_id'] = $v_content->id;
    //         $order_d_data['product_name'] = $v_content->name;
    //         $order_d_data['product_price'] = $v_content->price;
    //         $order_d_data['product_sales_quantity'] = $v_content->qty;
    //         $order_d_id = DB::table('tbl_order_details')->insert($order_d_data);
    //     }

    //     if($data['payment_method'] == 1){
    //         echo 'Thanh toán thẻ ATM';
    //     }elseif($data['payment_method'] == 2){
    //         Cart::destroy();
    //         $category_product_id = Category::orderBy('category_id', 'DESC')->get();
    //         $brand_product_id = Brand::orderBy('brand_id', 'DESC')->get();
    //         return view('pages.checkout.handcash')->with(compact('category_product_id', 'brand_product_id'))
    //         ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'image_og'));
    //     }else{
    //         echo 'Thẻ ghi nợ';

    //     }

    //     //return Redirect::to('/payment');
    // }

    // admin function
    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=' ,'tbl_customer.customer_id' )
        ->select('tbl_order.*', 'tbl_customer.customer_name')
        ->orderBy('tbl_order.order_id', 'DESC')->get();  
        $manager_order = view('admin.order.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.order.manage_order', $manager_order);
    }

    public function view_order($order_id){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->select('tbl_order.*', 'tbl_customer.*', 'tbl_order_details.*', 'tbl_shipping.*')
        ->join('tbl_customer', 'tbl_order.customer_id', '=' ,'tbl_customer.customer_id' )
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=' ,'tbl_shipping.shipping_id' )
        ->join('tbl_order_details', 'tbl_order.order_id', '=' ,'tbl_order_details.order_id' )
        ->where('tbl_order.order_id', $order_id)
        ->get();

        $manager_order_by_id = view('admin.order.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.order.view_order', $manager_order_by_id);
    }

    // 
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output.='<option>--Chọn quận huyện--</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
                $output.='<option>--Chọn xã phường--</option>';
                foreach($select_wards as $key => $wards){
                    $output.='<option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $fee_feeship = Feeship::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if($fee_feeship){
                $count_feeship = $fee_feeship->count();
                if($count_feeship > 0){
                    foreach($fee_feeship as $key => $feeship){
                        Session::put('fee', $feeship->fee_feeship);
                        Session::save();
                    }
                }else{
                    Session::put('fee', 25000);
                    Session::save();
                }
            }
        }
    }

    public function delete_fee(){
        Session::forget('fee');
        return Redirect::to('/checkout');
    }

    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Shipping;
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
}

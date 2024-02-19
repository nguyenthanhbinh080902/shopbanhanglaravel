@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: auto">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
            <li><a href="{{ route('/trang-chu') }}">Trang chủ</a></li>
            <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="register-req">
            <p>Đăng ký và đăng nhập trước khi thanh toán và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin giao hàng</p>
                        <div class="form-one">
                            <form>
                                @csrf
                                <input type="text" class="shipping_email" name="shipping_email" placeholder="Email">
                                <input type="text" class="shipping_name" name="shipping_name" placeholder="Họ và tên">
                                <input type="text" class="shipping_address" name="shipping_address" placeholder="Địa chỉ">
                                <input type="text" class="shipping_phone" name="shipping_phone" placeholder="Phone">
                                <textarea name="shipping_notes" class="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="5"></textarea>
                                
                                @if (Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key => $coupon)
                                        <input type="hidden" class="order_coupon" name="order_coupon" value="{{$coupon['coupon_code']}}">
                                    @endforeach
                                @else
                                    <input type="hidden" class="order_coupon" name="order_coupon" value="no">
                                @endif
                                
                                @if (Session::get('fee'))
                                    <input type="hidden" class="order_fee" name="order_fee" value="{{ Session::get('fee') }}" >
                                @else
                                    <input type="hidden" class="order_fee" name="order_fee" value="10000">
                                @endif
                                
                                <div style="margin-top: 5px">
                                    <div class="form-group">
                                        <select name="payment_select" class="form-control input-lg m-bot15 payment_select">
                                            <option value="0" >Thanh toán tiền mặt</option>
                                            <option value="1" >Chuyển khoản</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="button" value="Xác nhận đơn hàng" name="send-order" class="btn btn-primary btn-sm send-order">
                            </form>
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-lg m-bot15 choose city">
                                        <option value="" >--Chọn thành phố--</option>
                                        @foreach ($city as $key => $city_value)
                                            <option value="{{ $city_value->matp }}" >{{ $city_value->name_city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control input-lg m-bot15 choose province">
                                        <option value="" >--Chọn quận huyện--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-lg m-bot15 wards">
                                        <option value="" >--Chọn xã phường--</option>
                                    </select>
                                </div>
                                <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                            </form>
                        </div>
                    </div>
                </div>	
                <div class="col-sm-12 clearfix">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <form action="{{ route('/update-cart-ajax') }}" method="post">
                                @csrf
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Hình ảnh</td>
                                        <td class="description">Tên sản phẩm</td>
                                        <td class="price">Giá</td>
                                        <td class="quantity">Số lượng</td>
                                        <td class="total">Thành tiền</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Session::get('cart')==true)
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach (Session::get('cart') as $key => $cart)
                                            @php
                                                $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td class="cart_product">
                                                    <a href=""><img src="{{ asset('upload/product/'.$cart['product_image']) }}" width="50px" alt="{{ $cart['product_name'] }}" /></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4><a href=""></a></h4>
                                                    <p>{{ $cart['product_name'] }}</p>
                                                </td>
                                                <td class="cart_price">
                                                    <p>{{ number_format($cart['product_price'], 0, '', '.') }}đ</p>
                                                </td>
                                                <td class="cart_quantity">
                                                        <div class="cart_quantity_button">
                                                            <input class="cart_quantity" type="number" name="cart_qty[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}" min="1" style="width: 70px; text-align:center">
                                                        </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">
                                                        {{ number_format($subtotal, 0, '', '.') }}đ
                                                    </p>
                                                </td>
                                                <td class="cart_delete">
                                                    <a style="margin-right: 5px" class="cart_quantity_delete" href="{{ route('/delete-cart-ajax', $cart['session_id']) }}" ><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out"></td>
                                            <td><a class="btn btn-default check_out" href="{{ route('/delete-all-cart-ajax') }}" >Xóa tất cả giỏ hàng</a></td>
                                            @if (Session::get('coupon'))
                                            <td><a class="btn btn-default check_out" href="{{ route('/delete-coupon-cart-ajax') }}" >Xóa mã khuyến mãi</a></td>
                                            @endif
                                            <td colspan="2">
                                                <ul>
                                                    <li>Tổng tiền :<span>{{ number_format($total, 0, '', '.') }}đ</span></li>
                                                    <li>
                                                        @if(Session::get('coupon'))
                                                            @foreach (Session::get('coupon') as $key => $cou)
                                                                @if ($cou['coupon_condition']==2)
                                                                Mã giảm giá : {{ $cou['coupon_number'] }} %
                                                                <p>
                                                                    @php
                                                                        $total_coupon = ($total*$cou['coupon_number'])/100;
                                                                    @endphp
                                                                </p>
                                                                <p>
                                                                    @php
                                                                        $total_after_coupon = $total-$total_coupon;
                                                                    @endphp
                                                                </p>
                                                                @elseif ($cou['coupon_condition']==1)
                                                                Mã giảm giá : {{ number_format($cou['coupon_number'], 0,',','.') }}đ
                                                                <p>
                                                                    @php
                                                                        $total_coupon = $total - $cou['coupon_number'];
                                                                    @endphp
                                                                </p>
                                                                <p>
                                                                    @php
                                                                        $total_after_coupon = $total_coupon;
                                                                    @endphp
                                                                </p>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </li>
                                                    @if (Session::get('fee'))
                                                        <li>
                                                            Phí vận chuyển: <span>{{ number_format(Session::get('fee'), 0,',','.') }}</span>
                                                            <a style="margin-right: 5px" class="cart_quantity_delete" 
                                                            href="{{ route('/delete-fee') }}" ><i class="fa fa-times"></i></a>
                                                            @php
                                                            $total_after_fee = $total + Session::get('fee');
                                                            @endphp
                                                        </li>
                                                    @endif
                                                    <li>Tổng còn:
                                                        @php 
                                                            if(Session::get('fee') && !Session::get('coupon')){
                                                                $total_after = $total_after_fee;
                                                                echo number_format($total_after,0,',','.').'đ';
                                                            }elseif(!Session::get('fee') && Session::get('coupon')){
                                                                $total_after = $total_after_coupon;
                                                                echo number_format($total_after,0,',','.').'đ';
                                                            }elseif(Session::get('fee') && Session::get('coupon')){
                                                                $total_after = $total_after_coupon;
                                                                $total_after = $total_after + Session::get('fee');
                                                                echo number_format($total_after,0,',','.').'đ';
                                                            }elseif(!Session::get('fee') && !Session::get('coupon')){
                                                                $total_after = $total;
                                                                echo number_format($total_after,0,',','.').'đ';
                                                            }
                                                        @endphp
                                                    </li>
                                                    {{-- <li>Thuế :<span>Free</span></li> --}}
                                                </ul>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" style="text-align: center">
                                                @php
                                                echo 'Chưa có sản phẩm trong giỏ hàng';
                                                @endphp
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </form>
                            <tr>
                                @if (Session::get('cart'))
                                <td>
                                    <form action="{{ route('/check-coupon') }}" method="POST">
                                        @csrf
                                        <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                        <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                                    </form>
                                </td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>		
            </div>
        </div>
    </div>
</section>
@endsection
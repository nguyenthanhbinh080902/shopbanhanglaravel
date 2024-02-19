@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: 980px">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('/trang-chu') }}">Trang chủ</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {!! session()->get('message') !!}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {!! session()->get('error') !!}
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
                            <td class="description">Số lượng tồn</td>
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
                                    <td class="cart_quantity">
                                        <h4><a href=""></a></h4>
                                        <p>{{ $cart['product_quantity'] }}</p>
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
                                <td>
                                    @if (Session::get('coupon'))
                                    <a class="btn btn-default check_out" href="{{ route('/delete-coupon-cart-ajax') }}" >Xóa mã khuyến mãi</a>
                                    @endif
                                </td>
                                <td>
                                    @if (Session::get('customer_id'))
                                    <a class="btn btn-default check_out" href="{{ route('/checkout') }}" >Đặt hàng</a>
                                    @else
                                    <a class="btn btn-default check_out" href="{{ route('/login-checkout') }}" >Đăng nhập</a>
                                    @endif
                                </td>
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
                                                            echo '<p>Tổng giảm: '.number_format($total_coupon, 0,',','.').'đ</p>';
                                                        @endphp
                                                    </p>
                                                    <p>Tiền sau khi giảm :  {{ number_format($total-$total_coupon, 0,',','.') }}</p>
                                                    @elseif ($cou['coupon_condition']==1)
                                                    Mã giảm giá : {{ number_format($cou['coupon_number'], 0,',','.') }}đ
                                                    <p>
                                                        @php
                                                            $total_coupon = $total - $cou['coupon_number'];
                                                        @endphp
                                                    </p>
                                                    <p><li>Tiền sau khi giảm :  {{ number_format($total_coupon, 0,',','.') }}</li></p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </li>
                                        {{-- <li>Thuế :<span>Free</span></li>
                                        <li>Phí vận chuyển :<span>Free</span></li> --}}
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
</section>
@endsection
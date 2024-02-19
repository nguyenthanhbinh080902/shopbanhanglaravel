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
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $value_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ asset('upload/product/'.$value_content->options->image) }}" width="50px" alt="" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $value_content->name }}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($value_content->price).' '.'vnđ' }}</p>
                        </td>
                        <td class="cart_quantity">
                            <form action="{{ route('/update-cart-quantity') }}" method="post">
                                {{ csrf_field() }}
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{ $value_content->qty }}" autocomplete="off" size="2">
                                    <input type="hidden" value="{{ $value_content->rowId }}" name="rowId_cart">
                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                </div>
                            </form>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php 
                                    $subtotal = $value_content->price * $value_content->qty;
                                    echo number_format($subtotal).' '.'vnđ';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a style="margin-right: 5px" class="cart_quantity_delete" href="{{ route('/delete-to-cart', [$value_content->rowId]) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>               
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container" style="width: 980px">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{ Cart::subtotal(0,',','.').' '.'vnđ' }}</span></li>
                        <li>Thuế <span>{{ Cart::tax(0).' '.'vnđ' }}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{ Cart::total(0).' '.'vnđ' }}</span></li>
                    </ul>
                    <?php
                    $customer_id = Session::get('customer_id');
                    if($customer_id != ''){
                    ?>
                    <a class="btn btn-default check_out" href="{{ route('/checkout') }}">Thanh toán</a>
                    <?php
                        }else {
                    ?>
                    <a class="btn btn-default check_out" href="{{ route('/login-checkout') }}">Thanh toán</a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
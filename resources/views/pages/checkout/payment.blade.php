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
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
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
            <h4>Chọn hình thức thanh toán</h4>
            <form action="{{ route('/order-place') }}" method="POST">
                {{ csrf_field() }}
                <div class="payment-options" style="margin-top: 5px">
                    <span>
                        <label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
                    </span>
                    <input type="submit" value="Đặt hàng" style="margin-bottom: 15px" class="btn btn-primary btn-sm">
                </div>
            </form>
        </div>
    </section>
@endsection
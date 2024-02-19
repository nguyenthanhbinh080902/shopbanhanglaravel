@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach ($search_product as $key => $search_pro)
    <a href="{{ route('/chi-tiet-san-pham', [$search_pro->product_id]) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ asset('upload/product/'.$search_pro->product_image) }}" alt="" />
                        <h2>{{ number_format($search_pro->product_price).' '.'VNĐ' }}</h2>
                        <p>{{ $search_pro->product_name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div><!--features_items-->
@endsection
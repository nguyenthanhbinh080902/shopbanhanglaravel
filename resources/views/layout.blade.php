<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- SEO --}}
	<meta name="description" content="{{ $meta_desc }}">
	<meta name="keywords" content="{{ $meta_keywords }}">
	<meta name="robots" content="INDEX,FOLLOW">
    <meta name="author" content="{{ $url_canonical }}">
	<title>{{ $meta_title }}</title>
	<link rel="icon" href="{{ asset('frontend/images/cart/logo.jpg') }}" type="image/x-icon">

	{{-- <meta property="og:image" content="{{ $image_og }}"> --}}
	<meta property="og:image" content="{{ $image_og }}">
	<meta property="og:site_name" content="http://127.0.0.1:8000">
	<meta property="og:description" content="{{ $meta_desc }}">
	<meta property="og:title" content="{{ $meta_title }}">
	<meta property="og:url" content="{{ $url_canonical }}">
	<meta property="og:type" content="website">
	{{-- SEO end here --}}
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet" >
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    {{-- frontend/images/ico/apple-touch-icon-144-precomposed.png --}}
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/home/gallery1.jpg') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
	<script type="text/javascript" src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
</head><!--/head-->

<body>

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ route('/trang-chu') }}"><img src="{{ asset('frontend/images/home/logo.png') }}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								{{-- Thanh toán --}}
								<?php
									$shipping_id = Session::get('shipping_id');
									$customer_id = Session::get('customer_id');
									if($customer_id != '' && $shipping_id == ''){
								?>
								<li><a href="{{ route('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}elseif($customer_id != '' && $shipping_id != ''){
								?>
								<li><a href="{{ route('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}else{
								?>
								<li><a href="{{ route('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}
								?>	
								<li><a href="{{ route('/show-cart-ajax') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								{{-- Đăng xuất/ Đăng nhập --}}								
								<?php
									$customer_id = Session::get('customer_id');
									if($customer_id != ''){
								?>
									<li><a href="{{ route('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php
									}else {
								?>
									<li><a href="{{ route('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php
									}
								?>								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('/trang-chu') }}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Sản phẩm</a></li>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                </li> 
								<li><a href="{{ route('/show-cart-ajax') }}">Giỏ hàng</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{ route('/tim-kiem') }}" method="GET">
							{{ csrf_field() }}
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm kiếm"/>
								<input style="width: 50px" type="submit" name="search_items" class="btn btn-success btn-sm" value="find">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner" style="height: 550px;">
							@foreach ($slider_id as $key => $slider)
							<div class="item {{ $key+1==1 ? 'active' : '' }}">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>{{ $slider->slider_name }}</h2>
									<p>{{ $slider->slider_desc }}</p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{ asset('upload/slider/'.$slider->slider_image) }}" style="height: 315px; width: 288px" class="girl img-responsive" alt="" />
									<img src="{{ asset('frontend/images/home/pricing.png') }}"  class="pricing" alt="" />
								</div>
							</div>
							@endforeach
						</div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($category_product_id as $key => $cate_pro)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ route('/danh-muc-san-pham', [$cate_pro->category_id] ) }}">{{ $cate_pro->category_name }}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach ($brand_product_id as $key => $brand_pro)
									<li><a href="{{ route('/thuong-hieu-san-pham', [$brand_pro->brand_id] ) }}"> <span class="pull-right">(50)</span>{{ $brand_pro->brand_name }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ asset('frontend/images/home/iframe1.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
	<script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
	{{-- ko nằm trong file --}}
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0" nonce="oVVsIgqr"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_quantity = $('.cart_product_quantity_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				
				if( parseInt(cart_product_qty) > parseInt(cart_product_quantity) ){
					//alert(cart_product_qty);
					//alert(cart_product_quantity);
					alert('Số lượng đặt hàng vượt quá số lượng trong kho: ' + cart_product_quantity);
				}else{
					$.ajax({
						url: '{{ route('/add-cart-ajax') }}',
						method: 'POST',
						data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
						cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
						success:function(data){
							swal({
								title: "Đã thêm sản phẩm vào giỏ hàng",
								text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
								
								showCancelButton: true,
								cancelButtonText: "Xem tiếp",
								confirmButtonClass: "btn-success",
								confirmButtonText: "Đi đến giỏ hàng",
								closeOnConfirm: false
								},
							function() {
								window.location.href = "{{ url('/show-cart-ajax') }}";
							});
						}
					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{ route('/select-delivery-home') }}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
	});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp = $('.city').val();
				var maqh = $('.province').val();
				var xaid = $('.wards').val();
				var _token = $('input[name="_token"]').val();
				if(matp == '' && maqh == '' && xaid == ''){
					alert('Chọn địa điểm để tính phí vận chuyển');
				}else{
					$.ajax({
					url: '{{ url('/calculate-fee') }}',
					method: 'POST',
					data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
					success:function(data){
						location.reload();
					}
				});
			}
		});
	});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.send-order').click(function(){
				swal({
					title: "Xác nhận đơn hàng",
					text: "Đơn hàng sẽ sẽ không được hoàn trả khi đặt, bạn muốn tiếp tục ??",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "OK, Mua hàng!",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						var shipping_email = $('.shipping_email').val();
						var shipping_name = $('.shipping_name').val();
						var shipping_address = $('.shipping_address').val();
						var shipping_phone = $('.shipping_phone').val();
						var shipping_notes = $('.shipping_notes').val();
						var shipping_method = $('.payment_select').val();
						var order_fee = $('.order_fee').val();
						var order_coupon = $('.order_coupon').val();
						var _token = $('input[name="_token"]').val();

						$.ajax({
							url: '{{url('/confirm-order')}}',
							method: 'POST',
							data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
							success:function(){
								swal("Đơn hàng", "Đơn hàng của bạn được gửi thành công.", "success");
							}
						});
						window.setTimeout(function(){
							location.reload();
						}, 1000);
					}else {
						swal("Đóng", "Hoàn tất đơn hàng", "error");
					}				
				});
			});
		});
	</script>
</body>
</html>
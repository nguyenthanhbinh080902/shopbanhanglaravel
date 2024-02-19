@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
            <?php
                $message = Session::get('status');
                if ($message) {
                    echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    @foreach ($edit_product as $key => $edit_value)
                    <form role="form" action="{{ Route('/update-product', [$edit_value->product_id]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{ $edit_value->product_name }}" class="form-control" name="product_name" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-lg m-bot15">
                            @foreach ($category_product_id as $key => $cate_pro)
                                @if ($edit_value->category_id == $cate_pro->category_id)
                                    <option selected value="{{ $cate_pro->category_id }}" >{{ $cate_pro->category_name }}</option>
                                @else
                                    <option value="{{ $cate_pro->category_id }}" >{{ $cate_pro->category_name }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-lg m-bot15">
                                @foreach ($brand_product_id as $key => $brand_pro)
                                @if ($edit_value->brand_id  == $brand_pro->brand_id)
                                    <option selected value="{{ $brand_pro->brand_id }}" >{{ $brand_pro->brand_name }}</option>
                                @else
                                    <option value="{{ $brand_pro->brand_id }}" >{{ $brand_pro->brand_name }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" value="{{ $edit_value->product_quantity }}" class="form-control" name="product_quantity" placeholder="Số lượng sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" value="" rows="5" class="form-control" name="product_desc" placeholder="Mô tả sản phẩm">{{ $edit_value->product_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" value="" rows="5" class="form-control" name="product_content" placeholder="Nội dung sản phẩm">{{ $edit_value->product_content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" value="{{ $edit_value->product_price }}" class="form-control" name="product_price" placeholder="Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control-file" name="product_image">
                            <img src="{{ asset('upload/product/'.$edit_value->product_image) }}" height="100px" width="150px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái sản phẩm</label>
                            <select name="product_status" class="form-control input-lg m-bot15">
                            @if ($edit_value->product_status == '1')
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                            </select>
                        </div>
                        <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
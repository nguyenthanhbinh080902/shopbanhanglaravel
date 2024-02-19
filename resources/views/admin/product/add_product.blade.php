@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span style="margin-left: 5px;font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ Route('/save-product') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control input-lg m-bot15">
                                @foreach ($category_product_id as $key => $cate_pro)
                                    <option value="{{ $cate_pro->category_id }}">{{ $cate_pro->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thương hiệu sản phẩm</label>
                            <select name="brand_id" class="form-control input-lg m-bot15">
                                @foreach ($brand_product_id as $key => $brand_pro)
                                    <option value="{{ $brand_pro->brand_id }}">{{ $brand_pro->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" class="form-control" name="product_quantity" placeholder="Số lượng sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea id="editor1" style="resize: none" rows="4" class="form-control" name="product_desc" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea id="editor2" style="resize: none" rows="8" class="form-control" name="product_content" placeholder="Nội dung sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn hình ảnh</label>
                            <input type="file" class="form-control" name="product_image" placeholder="Hình ảnh sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái sản phẩm</label>
                            <select name="product_status" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
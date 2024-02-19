@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
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
                    <form role="form" action="{{ Route('/save-brand-product') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="brand_product_name" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea id="editor1" style="resize: none" rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa thương hiệu</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="brand_product_keywords" placeholder="Từ khóa thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái thương hiệu</label>
                            <select name="brand_product_status" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
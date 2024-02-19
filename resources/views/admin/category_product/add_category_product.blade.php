@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form role="form" action="{{ Route('/save-category-product') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_product_name" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="category_product_slug" placeholder="Slug"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="category_product_keywords" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái danh mục</label>
                            <select name="category_product_status" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
            </header>
            <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    @foreach ($edit_category_product as $key => $edit_value)
                    <form role="form" action="{{ Route('/update-category-product', [$edit_value->category_id]) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $edit_value->category_name }}" class="form-control" name="category_product_name" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{ $edit_value->category_slug }}" class="form-control" name="category_product_slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" value="" rows="5" class="form-control" name="category_product_desc" placeholder="Mô tả danh mục">{{ $edit_value->category_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            <textarea style="resize: none" value="" rows="5" class="form-control" name="category_product_keywords" placeholder="Từ khóa danh mục">{{ $edit_value->meta_keywords }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái danh mục</label>
                            <select name="category_product_status" class="form-control input-lg m-bot15">
                            @if ($edit_value->category_status == '1')
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                            </select>
                        </div>
                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
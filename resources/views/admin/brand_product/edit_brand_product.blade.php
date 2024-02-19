@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thương hiệu sản phẩm
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
                    @foreach ($edit_brand_product as $key => $edit_value)
                    <form role="form" action="{{ Route('/update-brand-product', [$edit_value->brand_id]) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{ $edit_value->brand_name }}" class="form-control" name="brand_product_name" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea id="editor2" style="resize: none" value="" rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả thương hiệu">{{ $edit_value->brand_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa thương hiệu</label>
                            <textarea id="editor2" style="resize: none" value="" rows="5" class="form-control" name="brand_product_keywords" placeholder="Từ khóa thương hiệu">{{ $edit_value->brand_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái thương hiệu</label>
                            <select name="brand_product_status" class="form-control input-lg m-bot15">
                            @if ($edit_value->brand_status == '1')
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                            </select>
                        </div>
                        <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật thương hiệu</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm slider
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
                    <form role="form" action="{{ Route('/save-slider') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slider</label>
                            <input type="text" class="form-control" name="slider_name" placeholder="Tên slider">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả slider</label>
                            <textarea id="editor1" style="resize: none" rows="4" class="form-control" name="slider_desc" placeholder="Mô tả slider"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn hình ảnh</label>
                            <input type="file" class="form-control" name="slider_image" placeholder="Hình ảnh slider">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái slider</label>
                            <select name="slider_status" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
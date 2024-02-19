@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật slider
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
                    @foreach ($edit_slider as $key => $edit_value)
                    <form role="form" action="{{ Route('/update-slider', [$edit_value->slider_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slider</label>
                            <input type="text" value="{{ $edit_value->slider_name }}" class="form-control" name="slider_name" placeholder="Tên slider">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả slider</label>
                            <textarea style="resize: none" value="" rows="8" class="form-control" name="slider_desc" placeholder="Mô tả slider">{{ $edit_value->slider_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control-file" name="slider_image">
                            <img src="{{ asset('upload/slider/'.$edit_value->slider_image) }}" height="100px" width="150px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái slider</label>
                            <select name="slider_status" class="form-control input-lg m-bot15">
                            @if ($edit_value->slider_status == '1')
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                            </select>
                        </div>
                        <button type="submit" name="update_slider" class="btn btn-info">Cập nhật slider</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
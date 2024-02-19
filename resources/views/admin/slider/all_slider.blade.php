@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liêt kê slider
      </div>
      <div class="table-responsive">
        <?php
            $message = Session::get('status');
            if ($message) {
                echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$message.'</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>STT</th>
              <th>Tênslider</th>
              <th>Hình ảnh</th>
              <th>Mô tả</th>
              <th>Hiển thị</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_slider as $key => $slider)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $key+1 }}</td>
              <td>{{ $slider->slider_name }}</td>
              <td><img src="{{ asset('upload/slider/'.$slider->slider_image) }}" height="100px" width="150px"></td>
              <td>{{ $slider->slider_desc }}</td>
              <td><span class="text-ellipsis">
                <?php
                if ($slider->slider_status == 1){
                ?>
                  <a href="{{ route('/unactive-slider', [$slider->slider_id]) }}" ><span style="font-size: 28px; color: green; content: /f164;" class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                  <a href="{{ route('/active-slider', [$slider->slider_id]) }}" ><span style="font-size: 28px; color: red; ; content: /f164;" class="fa-thumb-styling-down fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
              </span></td>
              <td>
                <a href="{{ route('/edit-slider', [$slider->slider_id]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa thương hiệu {{ $slider->slider_name }} này không?')" href="{{ route('/delete-slider', [$slider->slider_id]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
</div>
@endsection
@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liêt kê mã giảm giá
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <?php
            $message = Session::get('message');
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
              <th>Tên mã giảm giá</th>
              <th>Mã giảm giá</th>
              <th>Số lượng</th>
              <th>Tính năng</th>
              <th>Số tiền | Phần trămm giảm</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_coupon as $key => $coupon)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $key+1 }}</td>
              <td>{{ $coupon->coupon_name }}</td>
              <td>{{ $coupon->coupon_code }}</td>
              <td>{{ $coupon->coupon_time }}</td>
              <td>
                <?php
                if ($coupon->coupon_condition == 1){
                ?>
                  Giảm theo tiền
                <?php
                }else{
                ?>
                  Giảm theo %
                <?php
                }
                ?>
              </td>
              </td>
              <td>
                <?php
                if ($coupon->coupon_condition == 1){
                ?>
                  Giảm {{ number_format($coupon->coupon_number).''.''.'' }}đ
                <?php
                }else{
                ?>
                  Giảm {{ number_format($coupon->coupon_number)}}%
                <?php
                }
                ?>
              </td>
              <td>
                <a href="{{ route('/edit-coupon', $coupon->coupon_id) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa mã giảm giá {{ $coupon->coupon_name }} này không?')" href="{{ route('/delete-coupon', [$coupon->coupon_id]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
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
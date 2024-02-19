@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liêt kê đơn hàng
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
              <th>STT</th>
              <th>Mã đơn hàng</th>              
              <th>Ngày tháng đặt hàng</th>
              <th>Tình trạng đơn hàng</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $key => $order)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $order->order_code }}</td>
              <td>{{ $order->created_at }}</td>
              <td>
                @if ($order->order_status == 1)
                  Đơn hàng mới
                @else
                  Đã xử lý
                @endif
              </td>
              <td>
                <a href="{{ route('/view-order', $order->order_code) }}" ><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a href="" onclick="return confirm('Bạn có muốn xóa thương hiệu {{ $order->brand_name }} này không?')" ><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liêt kê thương hiệu sản phẩm
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
              <th>Tên thương hiệu</th>
              <th>Mô tả thương hiệu</th>
              <th>Từ khóa thương hiệu</th>
              <th>Hiển thị</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_brand_product as $key => $brand_pro)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{ $key+1 }}</td>
              <td>{{ $brand_pro->brand_name }}</td>
              <td>{{ $brand_pro->brand_desc }}</td>
              <td>{{ $brand_pro->meta_keywords }}</td>
              <td><span class="text-ellipsis">
                <?php
                if ($brand_pro->brand_status == 1){
                ?>
                  <a href="{{ route('/unactive-brand-product', $brand_pro->brand_id) }}" ><span 
                    style="font-size: 28px; color: green; content: \f164" class="fa-solid fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                  <a href="{{ route('/active-brand-product', $brand_pro->brand_id) }}" ><span 
                    style="font-size: 28px; color: red; ; content: \f164" class="fa-thumb-styling-down fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
              </span></td>
              <td>
                <a href="{{ route('/edit-brand-product', $brand_pro->brand_id) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa thương hiệu {{ $brand_pro->brand_name }} này không?')" href="{{ route('/delete-brand-product', [$brand_pro->brand_id]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
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
              {!!$all_brand_product->links()!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
</div>
@endsection
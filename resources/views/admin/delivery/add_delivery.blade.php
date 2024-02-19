@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm vận chuyển
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
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn thành phố</label>
                            <select name="city" id="city" class="form-control input-lg m-bot15 choose city">
                                <option value="" >--Chọn thành phố--</option>
                                @foreach ($city as $key => $city_value)
                                    <option value="{{ $city_value->matp }}" >{{ $city_value->name_city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn quận huyện</label>
                            <select name="province" id="province" class="form-control input-lg m-bot15 choose province">
                                <option value="" >--Chọn quận huyện--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn xã phường</label>
                            <select name="wards" id="wards" class="form-control input-lg m-bot15 wards">
                                <option value="" >--Chọn xã phường--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="text" class="form-control fee_ship" name="fee_ship" placeholder="Tên phí vận chuyển">
                        </div>
                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                    </form>
                </div>
                <div id="load_delivery">
                    
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
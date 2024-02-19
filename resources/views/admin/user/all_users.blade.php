@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê phân quyền người dùng
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
              <th>Tên người dùng</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Author</th>
              <th>Admin</th>
              <th>User</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($admin as $key => $each_user)
            <form action="{{ route('/assign-roles') }}" method="POST">
                @csrf
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $each_user->admin_name }}</td>
                    <td>
                        {{ $each_user->admin_email }} 
                        <input type="hidden" name="admin_email" value="{{ $each_user->admin_email }}"> 
                        <input type="hidden" name="admin_id" value="{{ $each_user->admin_id }}"> 
                      </td>
                    <td>{{ $each_user->admin_phone }}</td>
                    <td><input type="checkbox" name="author_role" {{ $each_user->hasRoles('author') ? 'checked' : '' }} ></td>
                    <td><input type="checkbox" name="admin_role" {{ $each_user->hasRoles('admin') ? 'checked' : '' }} ></td>
                    <td><input type="checkbox" name="user_role" {{ $each_user->hasRoles('user') ? 'checked' : '' }} ></td>
                    <td>
                      <input type="submit" value="Assign roles" placeholder="Assign roles" class="btn btn-sm btn-default">
                      <a style="margin: 5px 0" href="{{ route('/delete-user-roles', [$each_user->admin_id]) }}" class="btn btn-sm btn-danger">Xóa user</a>
                      <a style="margin: 5px 0" href="{{ route('/impersionate', [$each_user->admin_id]) }}" class="btn btn-sm btn-warning">Chuyển quyền</a>
                    </td>
                </tr>
            </form>
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
                {!!$admin->links()!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
</div>
@endsection
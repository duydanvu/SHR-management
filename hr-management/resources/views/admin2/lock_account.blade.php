@csrf
<div class="row">
    <input id = "id_users1" name="id_users1" value="{{$user->id}}" hidden></input>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <label for="name">Tên người dùng : {{$user->last_name}}</label>
        </div>
        <div class="form-group">
            <label for="name">Email : {{$user->email}}</label>
        </div>
        <div class="form-group">
            <label for="name">Bạn có chắc chắn muốn khóa tài khoản này ?</label>
        </div>
    </div>
</div>

@csrf
<div class="row">
    <input id = "id_users1" name="id_users1" value="{{$user->id}}" hidden></input>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <label for="name" style="font-size: larger">Tên người dùng : </label>
            <label for="name" style="font-size: larger;color: #ff9999">{{$user->last_name}} </label>
        </div>
        <div class="form-group">
            <label for="name" style="font-size: large">Email : <u style="color: blue">{{$user->email}}</u></label>
        </div>
        <div class="form-group">
            <label for="name">Bạn có chắc chắn muốn khóa tài khoản này ?</label>
        </div>
    </div>
</div>

@csrf
<div class="row">
    <input id = "id_users1" name="id_users1" value="{{$user->id}}" hidden></input>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <label for="name">Tên</label>
            <input id="lName" type="text" class="form-control @error('txtLName') is-invalid @enderror" name="txtLName" value="{{$user->last_name}}}"  autocomplete="number" required>
            @error('txtLName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input id="email" type="text" class="form-control @error('txtEmail') is-invalid @enderror" name="txtEmail" value="{{$user->email}}"  autocomplete="number" required>
            @error('txtEmail')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Hạn Mức Thu Tiền</label>
            <input id="phone" type="number" class="form-control @error('txtLimit') is-invalid @enderror" name="txtLimit" value="{{$user->han_muc}}"  autocomplete="number" required>
            @error('txtLimit')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>

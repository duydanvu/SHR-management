@csrf
<div class="row">
    <input name="id_user" value="{{$user->id}}" hidden>
    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="name">Tên tài khoản</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$user->login}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Tên</label>
            <input id="lName" type="text" class="form-control @error('txtLName') is-invalid @enderror" name="txtLName" value="{{$user->last_name}}"  autocomplete="number" required>
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
            <label for="name">Phone</label>
            <input id="phone" type="number" class="form-control @error('txtPhone') is-invalid @enderror" name="txtPhone" value="{{$user->phone}}"  autocomplete="number" required>
            @error('txtPhone')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Ngày Sinh</label>
            <input id="bod" type="date" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value="{{$user->dob}}"  autocomplete="number" required>
            @error('txtDob')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Người Dùng</label>
            <div class="form-check">
                <input id="user1" type="radio" class="form-check-input" name="txtAccUser" value="user1"  autocomplete="number" @if($user->position_name == 'ASM') checked @endif required>
                <label class="form-check-label " for="user1">
                    ASM
                </label>
                <input id="user2" type="radio" class="form-check-input ml-4" name="txtAccUser" value="user2"  autocomplete="number" @if($user->position_name != 'ASM') checked @endif required>
                <label class="form-check-label ml-5 " for="user2">
                    Người Dùng Cấp 2
                </label>
            </div>
        </div>
    </div>
</div>


@csrf
    <div class="row">
        <div class="col-lg-12 col-sm-12">

            <div class="card-body col-lg-6 float-left">
                <div class="form-group">
                    <label for="name">Tên tài khoản</label>
                    <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName"  value="{{$user->login}}"  autocomplete="number" required>
                    @error('txtName')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Mật Khẩu</label>
                    <input id="txtPassword" type="password" class="form-control @error('txtPassword') is-invalid @enderror" name="txtPassword" value="{{$user->password}}"  autocomplete="number" required>
                    @error('txtPassword')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input id="fName" type="text" class="form-control @error('txtFName') is-invalid @enderror" name="txtFName" value="{{$user->first_name}}"  autocomplete="number" required>
                    @error('txtFName')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label>
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
                    <input id="bod" type="date" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value=""  autocomplete="number" required>
                    @error('txtDob')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Chuyên ngành</label>
                    <input id="line" type="text" class="form-control @error('txtLine') is-invalid @enderror" name="txtLine" value="{{$user->line}}"  autocomplete="number" required>
                    @error('txtLine')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Số Hợp Đồng</label>
                    <input id="NContract" type="text" class="form-control @error('txtNContract') is-invalid @enderror" name="txtNContract" value="{{$user->contract_number}}"  autocomplete="number" required>
                    @error('txtNContract')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-body col-lg-6 float-left">
                <div class="form-group">
                    <label for="name">Giới Tính</label>
                    <div class="form-check">
                        <input id="male" type="radio" class="form-check-input" name="txtGender" value="male"  autocomplete="number" required>
                        <label class="form-check-label " for="male">
                            Male
                        </label>
                        <input id="female" type="radio" class="form-check-input ml-4" name="txtGender" value="female"  autocomplete="number" required>
                        <label class="form-check-label ml-5 " for="female">
                            Female
                        </label>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <label class="pt-1"for="name">Cửa hàng</label>
                    <div class="col-sm-10 p-0">
                        <select id="store" name = "store" class="form-control select2"  value="{{ old('store') }}" autocomplete="store" style="width: 100%;">
                            @foreach ($store as $store)
                                <option value="{{$store['store_id']}}">{{$store['store_name']}}-{{$store['store_address']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Chức Vụ</label>
                    <div class="col-sm-10 p-0 ">
                        <select id="position" name = "position" class="form-control select2"  value="{{ old('position') }}" autocomplete="position" style="width: 100%;">
                            @foreach ($position as $position)
                                <option value="{{$position['position_id']}}">{{$position['position_name']}}-{{$position['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Hợp Đồng</label>
                    <div class="col-sm-10 p-0">
                        <select id="contract" name = "contract" class="form-control select2"  value="{{ old('contract') }}" autocomplete="contract" style="width: 100%;">
                            @foreach ($contract as $contract)
                                <option value="{{$contract['contract_id']}}">{{$contract['name']}}-{{$contract['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Bộ Phận</label>
                    <div class="col-sm-10 p-0">
                        <select id="department" name = "department" class="form-control select2"  value="{{ old('department') }}" autocomplete="department" style="width: 100%;">
                            @foreach ($department as $department)
                                <option value="{{$department['id']}}">{{$department['name']}}-{{$department['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Dịch Vụ</label>
                    <div class="col-sm-10 p-0">
                        <select id="service" name = "service" class="form-control select2"  value="{{ old('service') }}" autocomplete="service" style="width: 100%;">
                            @foreach ($service as $service)
                                <option value="{{$service['id']}}">{{$service['name']}}-{{$service['description']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Ngày bắt đầu</label>
                    <input id="txtStart" type="date" class="form-control @error('txtStart') is-invalid @enderror" name="txtStart" value=""  autocomplete="number" required>
                    @error('txtStart')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Ngày kết thúc</label>
                    <input id="txtEnd" type="date" class="form-control @error('txtEnd') is-invalid @enderror" name="txtEnd" value=""  autocomplete="number" required>
                    @error('txtEnd')
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

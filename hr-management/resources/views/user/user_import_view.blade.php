@csrf
<div class="row">
    <div class="col-lg-12 col-sm-12">
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
                <label for="name">Cửa hàng</label>
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
        </div>
    </div>
</div>

@csrf
<div class="row">
    <input name="id_spl" value="{{$spl->id}}" hidden>
    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="name">Tên Nhà Cung Cấp</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$spl->name}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Mã Nhà Cung Cấp</label>
            <input id="txtMaCungCap" type="text" class="form-control @error('txtMaCungCap') is-invalid @enderror" name="txtMaCungCap" value="{{$spl->supply_code}}"  autocomplete="number"  readonly>
            @error('txtMaCungCap')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Địa Chỉ</label>
            <input id="txtAddress" type="text" class="form-control @error('txtAddress') is-invalid @enderror" name="txtAddress" value="{{$spl->address}}"  autocomplete="number" required>
            @error('txtAddress')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Số Điện Thoại</label>
            <input id="phone" type="number" class="form-control @error('txtPhone') is-invalid @enderror" name="txtPhone" value="{{$spl->phone}}"  autocomplete="number" required>
            @error('txtPhone')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Hợp Đồng Tham Chiếu</label>
            <input id="txtContract" type="text" class="form-control @error('txtContract') is-invalid @enderror" name="txtContract" value="{{$spl->contract_tc}}"  autocomplete="number" required>
            @error('txtContract')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>

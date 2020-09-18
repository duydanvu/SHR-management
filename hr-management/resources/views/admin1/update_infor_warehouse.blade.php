@csrf
<div class="row">
    <input name="id_wh" value="{{$wh->id}}" hidden>
    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="name">Tên Kho</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$wh->name}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Mã Kho</label>
            <input id="warehouse" type="text" class="form-control @error('txtWarehouseCode') is-invalid @enderror" name="txtWarehouseCode" value="{{$wh->warehouse_code}}"  autocomplete="number" required readonly>
            @error('txtWarehouseCode')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Địa Chỉ</label>
            <input id="address" type="text" class="form-control @error('txtAddress') is-invalid @enderror" name="txtAddress" value="{{$wh->address}}"  autocomplete="number" required>
            @error('txtAddress')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>

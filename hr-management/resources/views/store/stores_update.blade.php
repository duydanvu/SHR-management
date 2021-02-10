@csrf
<input name="store_id" value="{{$data->store_id}}" hidden/>
<div class="row">
    <div class="col-sm-12">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên Cửa Hàng</label>
                <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$data->store_name}}"  autocomplete="number" required>
                @error('txtName')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Địa Chỉ Cửa Hàng</label>
                <input id="fName" type="text" class="form-control @error('txtAddress') is-invalid @enderror" name="txtAddress" value="{{$data->store_address}}"  autocomplete="number" required>
                @error('txtAddress')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Phone</label>
                <input id="lName" type="number" class="form-control @error('txtPhone') is-invalid @enderror" name="txtPhone" value="{{$data->phone}}"  autocomplete="number" required>
                @error('txtPhone')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Khu vực</label>
                <div class="col-sm-10">
                    <select id="area_id" name = "area_id" class="form-control select2"  value="{{ old('area_id') }}" autocomplete="area_id" style="width: 100%;">
                        @foreach ($area as $area)
                            @if($area->id == $data->area_id)
                            <option value="{{$area->id}}" selected>{{$area->area_name}}</option>
                            @else
                            <option value="{{$area->id}}">{{$area->area_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>

</script>


@csrf
<input name="area_id" value="{{$data->id}}" hidden/>
<div class="row">
    <div class="col-sm-12">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Tên Khu Vực</label>
                <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$data->area_name}}"  autocomplete="number" required>
                @error('txtName')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Thông tin chi tiết</label>
                <input id="description" type="text" class="form-control @error('txtDescription') is-invalid @enderror" name="txtDescription" value="{{ $data->area_description}}"  autocomplete="number" required>
                @error('txtDescription')
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                @enderror
            </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>

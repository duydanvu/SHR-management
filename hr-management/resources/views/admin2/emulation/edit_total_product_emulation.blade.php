
@csrf
@foreach($product_emulation as $value)
    <div class="row">
        <div id = "url_image1"><input name="id_emulation_pdu" value="{{$x['id_tt']}}" hidden></div>
        <div class="col-lg-12 col-sm-12">
            <div class="form-group">
                <label for="name">Tên Sản Phẩm</label>
                <input id="name" type="text" class="form-control @error('txtName') is-invalid
                @enderror" name="txtName" value="{{$value['name']}}"  autocomplete="number" required>
                @error('txtName')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Số Lượng sản Phẩm</label>
                <input id="total" type="text" class="form-control @error('txtTotal') is-invalid
                @enderror" name="txtTotal" value="{{$value['total']}}"  autocomplete="number" required>
                @error('txtTotal')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
        </div>
    </div>
@endforeach

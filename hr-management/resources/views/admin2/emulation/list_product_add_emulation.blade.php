@csrf
<!-- /.card-header -->
<input name="id_emulation_product" value="{{$id}}_id"  hidden>
<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="name">Sản Phẩm</label>
            <select id="total" name = "txtProduct" class="form-control select2"
                    value="{{ old('txtProduct') }}" autocomplete="txtTotal"
                    style="width: 100%;">
                @foreach ($product as $product)
                    <option value="{{$product->id}}">{{$product->name}}-{{$product->product_code}}</option>
                @endforeach
            </select>
        </div>
            <div class="form-group">
                <label for="name">Số Lượng</label>
                <input id="name" type="number" class="form-control @error('txtName') is-invalid
                @enderror" name="txtTotal"  autocomplete="number" required>
                @error('txtTotal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
    </div>
</div>
<!-- /.card-body -->


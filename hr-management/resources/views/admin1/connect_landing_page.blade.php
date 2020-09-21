@csrf
<div class="row">
    <div id = "url_image1"></div>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <input name="id_product" value="{{$product->id}}" hidden>
            <label for="name">Tên Sản Phẩm</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$product->name}}"  autocomplete="number" required>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Đường dẫn kết nối</label>
            <input id="name" type="text" class="form-control @error('txtLink') is-invalid @enderror" name="txtLink" value="{{$product->landing_page}}"  autocomplete="number" required>
            @error('txtLink')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>

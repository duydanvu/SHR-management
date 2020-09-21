@csrf
<div class="row">
    <div id = "url_image1"><input name="id_product" value="{{$product->id}}" hidden></div>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName"
                   value="{{$product->name}}"  autocomplete="number" required readonly>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Mã Sản Phẩm</label>
            <input id="name" type="text" class="form-control @error('txtCodeName') is-invalid @enderror"
                   name="txtCodeName" value="{{$product->product_code}}"  autocomplete="number" required readonly>
            @error('txtCodeName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <label for="exampleInputEmail1">Kho</label>
            <select id="txtWarehouse" name = "txtWarehouse" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                @foreach ($warehouse as $warehouse)
                    <option value="{{$warehouse['id']}}">{{$warehouse['name']}}-{{$warehouse['address']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Hợp Đồng Tham Chiếu</label>
            <input id="lName" type="text" class="form-control @error('txtContract_tc') is-invalid @enderror" name="txtContract_tc" value=""  autocomplete="number" required>
            @error('txtContract_tc')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Số Lượng Nhập</label>
            <input id="phone" type="number" class="form-control @error('txtTotalExport') is-invalid @enderror" name="txtTotalExport" value=""  autocomplete="number" required>
            @error('txtTotalExport')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Ngày Nhập</label>
            <input id="name" type="datetime-local" class="form-control @error('txtDate') is-invalid @enderror" name="txtDate" value="{{$date}}"  autocomplete="number" required>
            @error('txtDate')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Hình Thức Hợp Tác</label>
            <div class="form-check">
                <input id="muaban" type="radio" class="form-check-input" name="txtTypeHT" value="muaban"  autocomplete="number" required>
                <label class="form-check-label " for="muaban">
                    Mua bán
                </label>
                <input id="kigui" type="radio" class="form-check-input ml-4" name="txtTypeHT" value="kigui"  autocomplete="number" required>
                <label class="form-check-label ml-5 " for="kigui">
                    Kí Gửi
                </label>
            </div>
        </div>
    </div>
</div>

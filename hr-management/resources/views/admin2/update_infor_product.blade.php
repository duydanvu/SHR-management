@csrf
<div class="row">
    <input name="id_product" value="{{$product->id}}" hidden>
    <div class="col-lg-12 col-sm-12">
        <div class="col-lg-6 float-left">
            <div class="form-group">
                <label for="name">Tên Sản Phẩm</label>
                <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$product->name}}"  autocomplete="number" required>
                @error('txtName')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Loại Sản Phẩm</label>
                <div class="form-check">
                    <input id="hanghoa" type="radio" class="form-check-input" name="txtType" value="hanghoa" @if($product->type == 'hanghoa') checked @endif autocomplete="number" required>
                    <label class="form-check-label " for="hanghoa">
                        Hàng Hóa
                    </label>
                    <input id="dichvu" type="radio" class="form-check-input ml-4" name="txtType" value="dichvu" @if($product->type == 'dichvu') checked @endif  autocomplete="number" required>
                    <label class="form-check-label ml-5 " for="dichvu">
                        Dịch Vụ
                    </label>
                </div>
            </div>
            <div class="form-group">
                <meta name="csrf-token2" content="{{ csrf_token() }}">
                <label for="exampleInputEmail1">Nhà Cung Cấp</label>
                <select id="supplier" name = "txtSupplier" class="form-control select2"  autocomplete="txtSupplier" style="width: 100%;">
                    @foreach ($supplier as $supplier)
                        <option value="{{$supplier->id}}" @if($supplier->id == $product->id_supplier) selected @endif>{{$supplier->name}}-{{$supplier->address}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Loại Hình Hợp Tác</label>
                <div class="form-check">
                    <input id="muaban" type="radio" class="form-check-input" name="txtTypeHT" value="muaban" @if($product->cooperation == 'muaban') checked @endif  autocomplete="number" required>
                    <label class="form-check-label " for="muaban">
                        Mua bán
                    </label>
                    <input id="kigui" type="radio" class="form-check-input ml-4" name="txtTypeHT" value="kigui" @if($product->cooperation == 'kigui') checked @endif  autocomplete="number" required>
                    <label class="form-check-label ml-5 " for="kigui">
                        Kí Gửi
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Hợp Đồng Tham Chiếu</label>
                <input id="contract" type="text" class="form-control @error('txtContract') is-invalid @enderror" name="txtContract" value="{{$product->contract}}"  autocomplete="number" required>
                @error('txtContract')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Giá Nhập</label>
                <input id="PriceIn" type="number" class="form-control @error('txtPriceIn') is-invalid @enderror" name="txtPriceIn" value="{{$product->price_in}}"  autocomplete="number" required>
                @error('txtPriceIn')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Giá bán</label>
                <input id="PriceOut" type="number" class="form-control @error('txtPriceIn') is-invalid @enderror" name="txtPriceOut" value="{{$product->price_out}}"  autocomplete="number" required>
                @error('txtPriceIn')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Giá Khuyến Mại</label>
                <input id="PriceSale" type="number" class="form-control @error('txtPriceSale') is-invalid @enderror" name="txtPriceSale" value="{{$product->price_sale}}"  autocomplete="number" required>
                @error('txtPriceSale')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 float-left">
            <div class="form-group">
                <label for="name">Hình Thức Hoa Hồng</label>
                <div class="form-check">
                    <input id="codinh" type="radio" class="form-check-input" name="txtHH" value="codinh"@if($product->hh_default != null) checked @endif autocomplete="number" required>
                    <label class="form-check-label " for="codinh">
                        Mức Cố Định
                    </label>
                    <input id="tile" type="radio" class="form-check-input ml-4" name="txtHH" value="tile"@if($product->hh_percent != null) checked @endif  autocomplete="number" required>
                    <label class="form-check-label ml-5 " for="tile">
                        Theo Tỉ lệ
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Mức Hoa Hồng</label>
                <input id="priceHH" type="number" class="form-control @error('txtPriceHH') is-invalid @enderror" name="txtPriceHH"
                       @if($product->hh_default != null) value="{{$product->hh_default}}"
                       @elseif($product->hh_percent != null) value="{{$product->hh_percent}}" @endif  autocomplete="number" required>
                @error('txtPriceHH')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Chi tiết Sản Phẩm</label>
                <textarea name="editor1" id="editor1" rows="10" cols="80">
                    {{$product->detail}}
                 </textarea>
            </div>
        </div>
    </div>
</div>

<script src="{{asset("../ckeditor/ckeditor.js")}}"></script>
<script>
    CKEDITOR.replace( 'editor1' );
</script>

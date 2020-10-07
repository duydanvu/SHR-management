@csrf
@foreach($list as $value)
<div class="row">
    <div id = "url_image1"><input name="id_sale" value="{{$value->id}}" hidden></div>
    <div id = "url_image2"><input name="id_pdu" value="{{$value->id_product}}" hidden></div>
    <div id = "url_image3"><input name="id_grp" value="{{$value->id_group}}" hidden></div>
    <div class="col-lg-12 col-sm-12">
        <div class="col-lg-6 float-left">
            <div class="form-group">
                <label for="name">Tên Khuyến Mại</label>
                <input id="name" type="text" class="form-control @error('txtName') is-invalid
                @enderror" name="txtName" value="{{$value->name}}"  autocomplete="number" required>
                @error('txtName')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Tên Sản Phẩm</label>
                <select id="name_product" name = "txtNameProduct" class="form-control select2"
                        value="{{ old('txtNameProduct') }}" autocomplete="txtNameProduct"
                        style="width: 100%;">
                    @foreach ($product as $product)
                        <option value="{{$product->id}}" @if($product->name === $value->name_product)selected @endif>{{$product->name}}-{{$product->product_code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Quyết định tham chiếu</label>
                <input id="qdtc" type="text" class="form-control @error('txtQdtc') is-invalid
                 @enderror" name="txtQdtc" value="{{$value->qdtc}}"  autocomplete="number" required>
                @error('txtQdtc')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Giá Bán</label>
                <input id="Price" type="number" class="form-control @error('txtPrice') is-invalid @enderror"
                       name="txtPrice" value="{{$value->sal_price}}"  autocomplete="number" required>
                @error('txtPrice')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6 float-left">
            <div class="form-group">
                <meta name="csrf-token2" content="{{ csrf_token() }}">
                <label for="exampleInputEmail1">Nhóm Áp Dụng</label>
                <select id="group" name = "txtGroup" class="form-control select2"  value="{{ old('txtGroup') }}" autocomplete="txtGroup" style="width: 100%;">
                    @foreach ($group as $group)
                        <option value="{{$group->id}}" @if($group->name === $value->name_group) selected @endif>{{$group->name}}-{{$group->id_group}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Hình Thức Khuyến Mại</label>
                <div class="form-check">
                    <input id="giamgia" type="radio" class="form-check-input" name="txtType" value="giamgia"
                           @if($value->sale_type == "giamgia") checked @endif autocomplete="number" required>
                    <label class="form-check-label " for="giamgia">
                        Giảm Giá
                    </label>
                    <input id="tangqua" type="radio" class="form-check-input ml-4" name="txtType" value="tangqua"
                           @if($value->sale_type == "tangqua") checked @endif autocomplete="number" required>
                    <label class="form-check-label ml-5 " for="tangqua">
                        Tặng Quà
                    </label>
                </div>
            </div>
            <div class="form-group" id="gia_tri" @if($value->sale_off == null) style="display: none" @endif>
                <label for="name">Giá trị khuyến mại</label>
                <input id="PriceSale" type="number" class="form-control @error('txtPriceSale') is-invalid @enderror"
                       name="txtPriceSale" value="{{$value->sale_off}}"  autocomplete="number">
                @error('txtPriceSale')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
            <div class="form-group" id="gift_1" @if($value->id_gifts == null) style="display: none" @endif>
                <meta name="csrf-token2" content="{{ csrf_token() }}">
                <label for="exampleInputEmail1">Quà Tặng 1</label>
                <select id="gift_r1" name = "txtGift_r1" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                    <option value="no_choice" selected>Quà Tặng 1</option>
                    @foreach ($product_1 as $product_1)
                        <option value="{{$product_1->id}}">{{$product_1->name}}-{{$product_1->product_code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="gift_2" @if($value->id_gifts == null) style="display: none" @endif>
                <meta name="csrf-token2" content="{{ csrf_token() }}">
                <label for="exampleInputEmail1">Quà Tặng 2</label>
                <select id="gift_r2" name = "txtGift_r2" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                    <option value="no_choice" selected>Quà Tặng 2</option>
                    @foreach ($product_2 as $product_2)
                        <option value="{{$product_2->id}}">{{$product_2->name}}-{{$product_2->product_code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="gift_3" @if($value->id_gifts == null) style="display: none" @endif>
                <meta name="csrf-token2" content="{{ csrf_token() }}">
                <label for="exampleInputEmail1">Quà Tặng 3</label>
                <select id="gift_r3" name = "txtGift_r3" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                    <option value="no_choice" selected>Quà Tặng 3</option>
                    @foreach ($product_3 as $product_3)
                        <option value="{{$product_3->id}}">{{$product_3->name}}-{{$product_3->product_code}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
@endforeach


<script>
    $(document).ready(function () {
        $("#giamgia").change(function () {
            document.getElementById("gia_tri").style.display = "block";
            document.getElementById("gift_1").style.display = "none";
            document.getElementById("gift_2").style.display = "none";
            document.getElementById("gift_3").style.display = "none";
        });
        $("#tangqua").change(function () {
            document.getElementById("gia_tri").style.display = "none";
            document.getElementById("gift_1").style.display = "block";
            document.getElementById("gift_2").style.display = "block";
            document.getElementById("gift_3").style.display = "block";
        })
    })
</script>

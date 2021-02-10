@csrf
<div class="row">
    <input name="id_hoan_ung" value="{{$order_hoan_ung->id}}" hidden>
    <div class="col-lg-12 col-sm-12">
        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName"
                    value="{{$product->name}}"
                   autocomplete="number" required readonly>
        </div>
        <div class="form-group">
            <label for="name">Số Lượng Sản Phẩm</label>
            <input id="warehouse" type="text" class="form-control @error('txtWarehouseCode') is-invalid @enderror"
                   name="txtWarehouseCode" value="{{$order_hoan_ung->total_product}}"  autocomplete="number" required readonly>
        </div>
        <div class="form-group">
            <label for="name">Tổng Tiền</label>
            <input id="txtTotalPrice" type="text" class="form-control @error('txtTotalPrice') is-invalid @enderror"
                   name="txtTotalPrice" value="{{$order_hoan_ung->total_price}}"  autocomplete="number" required readonly>
        </div>
        <div class="form-group">
            <label for="name">Thời gian ứng</label>
            <input id="address" type="text" class="form-control @error('txtAddress') is-invalid @enderror"
                   name="txtAddress" value="{{$order_hoan_ung->time}}"  autocomplete="number" required readonly>
        </div>
    </div>
</div>


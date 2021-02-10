@csrf
<div class="row">
    <input name="id_product" value="{{$product->id}}" hidden>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$product->name}}"  autocomplete="number" required readonly>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Kết Nối Nhà Cung Cấp</label>
            <select id="supplier" name = "txtSupplier" class="form-control select2"  value="{{ old('txtSupplier') }}" autocomplete="txtSupplier" style="width: 100%;">
                @foreach ($supplier as $supplier)
                    <option value="{{$supplier->id}}" @if($supplier->id == $product->link_supplier) selected @endif>{{$supplier->name}}-{{$supplier->address}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Kết Nối Đối Tác Vận Chuyển</label>
            <select id="transport" name = "txtTransport" class="form-control select2"  value="" autocomplete="txtSupplier" style="width: 100%;">
                @foreach ($transport as $transport)
                    <option value="{{$transport->id}}" @if($transport->id == $product->link_transport) selected @endif>{{$transport->name}}-{{$transport->address}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Cổng Thanh Toán</label>
            <select id="payment" name = "txtPayment" class="form-control select2"  value="" autocomplete="txtSupplier" style="width: 100%;">
                <option value="payment live" @if($product->payment == 'payment live') selected @endif>Thanh toán trực tuyến</option>
                <option value="payment ship" @if($product->payment == 'payment ship') selected @endif>Thanh toán khi nhận</option>
            </select>
        </div>
    </div>
</div>

@csrf
<div class="row">
    <div id = "url_image1"><input id="id_w2w" name="id_w2w" value="{{$list_w2w->id}}" hidden></div>
    <div class="col-lg-12 col-sm-12">

        <div class="form-group">
            <label for="name">Tên Sản Phẩm</label>
            <input id="id_product" name="id_product" value="{{$list_w2w->id_pdu}}" hidden>
            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName"
                   value="{{$list_w2w->name}}"  autocomplete="number" required readonly>
            @error('txtName')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <label for="exampleInputEmail1">Kho chuyển</label>
            <input id="id_product" name="id_WarehouseFrom" value="{{$list_w2w->id_from}}" hidden>
            <input id="txtWarehouseFrom" type="text" class="form-control @error('txtWarehouseFrom') is-invalid @enderror"
                   name="txtWarehouseFrom" value="{{$list_w2w->name_from1}}"  autocomplete="number" required readonly>
            @error('txtTotalWarehouse')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Số Lượng Chuyển</label>
            <input id="totalWarehouse" type="number" class="form-control @error('txtTotalWarehouse') is-invalid @enderror"
                   name="txtTotalWarehouse" value="{{$list_w2w->quatity}}"  autocomplete="number" required readonly>
            @error('txtTotalWarehouse')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <label for="exampleInputEmail1">Kho Nhận</label>
            <input id="id_product" name="id_WarehouseTo" value="{{$list_w2w->id_to}}" hidden>
            <input id="txtWarehouseTo" type="text" class="form-control @error('txtWarehouseTo') is-invalid @enderror"
                   name="txtWarehouseTo" value="{{$list_w2w->name_to1}}"  autocomplete="number" required readonly>
            @error('txtTotalWarehouse')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Ngày Chuyển</label>
            <input id="name" type="text" class="form-control @error('txtDate') is-invalid @enderror" name="txtDate"
                   value="{{$list_w2w->time}}"  autocomplete="number" required readonly>
            @error('txtDate')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>


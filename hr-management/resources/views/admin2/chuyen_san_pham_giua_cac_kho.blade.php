@csrf
<div class="row">
    <div id = "url_image1"><input id="id_product" name="id_product" value="{{$product->id}}" hidden></div>
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
            <label for="exampleInputEmail1">Kho chuyển</label>
            <select id="txtWarehouse" name = "txtWarehouseFrom" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                @foreach ($warehouse as $warehouse)
                    <option value="{{$warehouse['id']}}">{{$warehouse['name']}}-{{$warehouse['address']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Số Lượng Tồn</label>
            <input id="totalWarehouse" type="number" class="form-control @error('txtTotalWarehouse') is-invalid @enderror" name="txtTotalWarehouse" value="{{$total}}"  autocomplete="number" required readonly>
            @error('txtTotalWarehouse')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <meta name="csrf-token2" content="{{ csrf_token() }}">
            <label for="exampleInputEmail1">Kho Nhận</label>
            <select id="txtWarehouseto" name = "txtWarehouseTo" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                @foreach ($warehouse1 as $warehouse1)
                    <option value="{{$warehouse1['id']}}">{{$warehouse1['name']}}-{{$warehouse1['address']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Số Lượng Chuyển</label>
            <input id="phone" type="number" class="form-control @error('txtTotalExport') is-invalid @enderror" name="txtTotalExport" value=""  autocomplete="number" required>
            @error('txtTotalExport')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Ngày Chuyển</label>
            <input id="name" type="datetime-local" class="form-control @error('txtDate') is-invalid @enderror" name="txtDate" value=""  autocomplete="number" required>
            @error('txtDate')
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
            @enderror
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#txtWarehouse").change(function () {
            var id_wh = $("#txtWarehouse").val();
            var id_product = $("#id_product").val();
            $.ajax({
                headers:{'X-CSRF-Token':$('meta[name="csrf-token2"]').attr('content')},
                url:"{{url('admin2/warehouse/total_product')}}",
                type:"POST",
                data: {
                    id_wh: id_wh,
                    id_product: id_product,
                },
                success:function (data) {
                    console.log(data);
                    $("#totalWarehouse").val(data)
                }
            })
        })
    })
</script>

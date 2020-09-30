@csrf
<!-- /.card-header -->
<input name="id_emulation_product" value="{{$id}}_id"  hidden>
<div class="card-body">
    <table id="example2" class="table table-bordered table-striped" style="text-align: center">
        <thead>
        <tr>
            <th style="width:10%">#</th>
            <th style="width:10%" class="noSort">Action</th>
            <th style="width:30%">Tên Sản Phẩm</th>
            <th style="width:20%">Mã Sản Phẩm</th>
            <th style="width:30%">Nhà Cung Cấp</th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(count($product) > 0)
            @foreach($product as $key => $value)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><input type="checkbox" name="addtoEmulation{{$key}}" value="{{$value->id}}"
                               @foreach($arr as $value_arr) @if($value_arr == $value->id) checked @endif @endforeach></td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->product_code}}</td>
                    @foreach($supplier as $values)
                        @if($values->id == $value->id_supplier)
                            <td>{{$values->name}}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @else
            <td colspan="8" style="text-align: center">
                <h3>Không có Sản Phẩm</h3>
            </td>
        @endif

        </tbody>
    </table>
</div>
<!-- /.card-body -->


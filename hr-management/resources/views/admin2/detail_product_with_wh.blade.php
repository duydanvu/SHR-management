<div class="card-body">
    <table id="example1" class="table table-bordered table-striped" style="text-align: center">
        <thead>
        <tr>
            <th style="width:5%">#</th>
            <th style="width:25%" >Tên Kho</th>
            <th style="width:20%" >Mã Kho</th>
            <th style="width:35%" >Địa chỉ kho</th>
            <th style="width:15%">Tổng</th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(count($arr) > 0)
            @foreach($arr as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    <td>@foreach($list_wh as $value_wh) @if($value_wh->id == $key) {{$value_wh->name}} @endif @endforeach</td>
                    <td>@foreach($list_wh as $value_wh) @if($value_wh->id == $key) {{$value_wh->warehouse_code}} @endif @endforeach</td>
                    <td>@foreach($list_wh as $value_wh) @if($value_wh->id == $key) {{$value_wh->address}} @endif @endforeach</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        @else
            <td colspan="8" style="text-align: center">
                <h3>Không có Thông Tin</h3>
            </td>
        @endif

        </tbody>
    </table>
</div>

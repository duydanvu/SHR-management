@csrf
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped" style="text-align: center">
        <thead>
        <tr>
            <th style="width:5%">#</th>
            <th style="width:10%">Tên Sản Phẩm</th>
            <th style="width:10%">Thời Gian Bắt Đầu</th>
            <th style="width:10%">Thời Gian Kết Thức</th>
            <th style="width:10%">Tỷ lệ hoàn thành</th>
            <th style="width:10%">Số lượng bán</th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(count($list_product) > 0)
            @foreach($list_product as $key => $value)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$start_time}}</td>
                    <td>{{$end_time}}</td>
                    <td>{{$arr[$value->id]/$total_goal}} %</td>
                    <td>{{$arr[$value->id]}}</td>
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

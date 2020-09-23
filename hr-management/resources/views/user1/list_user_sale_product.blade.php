@csrf
<!-- /.card-header -->
<input name="id_product" value="{{$id}}_id"  hidden>
<div class="card-body">
    <table id="example2" class="table table-bordered table-striped" style="text-align: center">
        <thead>
        <tr>
            <th style="width:5%">#</th>
            <th style="width:5%" class="noSort">Action</th>
            <th style="width:10%">Tên Nhân Viên</th>
            <th style="width:10%">Email Nhân Viên</th>
            <th style="width:10%">Nhóm</th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(count($list_user) > 0)
            @foreach($list_user as $key => $value)
                <tr>
                    <td>{{$key+1}}</td>
                    @if($value->status == 'active')
                    <td><a href="{{route('update_user_to_sale_product',['id'=>$value->id])}}" class="btn btn-danger">
                            <i class="fas fa-street-view"> Tạm Dừng</i>
                        </a></td>
                    @elseif($value->status == 'stop')
                            <td><a href="{{route('update_user_to_sale_product',['id'=>$value->id])}}" class="btn btn-primary">
                                    <i class="fas fa-street-view"> Kích Hoạt</i>
                                </a></td>
                    @endif
                    <td>{{$value->last_name}}</td>
                    <td>{{$value->email}}</td>
                    @foreach($list_group as $values)
                        @if($values->id == $value->id_group)
                            <td>{{$values->name}}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        @else
            <td colspan="8" style="text-align: center">
                <h3>Không có Nhân Viên</h3>
            </td>
        @endif

        </tbody>
    </table>
</div>
<!-- /.card-body -->

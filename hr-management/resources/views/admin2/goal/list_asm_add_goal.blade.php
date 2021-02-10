@csrf
<!-- /.card-header -->
<input name="id_emulation_product" value="{{$id}}_id"  hidden>
<div class="card-body">
    <table id="example2" class="table table-bordered table-striped" style="text-align: center">
        <thead>
        <tr>
            <th style="width:10%">#</th>
            <th style="width:10%" class="noSort">Action</th>
            <th style="width:30%">Tên Nhóm</th>
            <th style="width:20%">Mã Nhóm</th>
            <th style="width:30%">Chi tiết Nhóm</th>
        </tr>
        </thead>
        <tbody id="table_body">
        @if(count($asm_result) > 0)
            @foreach($asm_result as $key => $value)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><input type="checkbox" name="addtoEmulation{{$key}}" value="{{$value->id}}"
                        @foreach($arr as $value_arr) @if($value_arr == $value->id) checked @endif @endforeach></td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->id_group}}</td>
                    <td>{{$value->description}}</td>
                </tr>
            @endforeach
        @else
            <td colspan="8" style="text-align: center">
                <h3>Không có người quản lý</h3>
            </td>
        @endif
        </tbody>
    </table>
</div>
<!-- /.card-body -->

<script>
    // $(function () {
    //     $("#example2").DataTable({
    //         aoColumnDefs: [
    //             {
    //                 bSortable: false,
    //                 aTargets: ['noSort']
    //             } // Disable sorting on columns marked as so
    //         ]
    //     });
    //     // fix table
    //     $("#example1").parent().css({"overflow": "auto"});
    // });

</script>

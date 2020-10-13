@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Tài khoản người dùng {{\Illuminate\Support\Facades\Auth::user()->last_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home1">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a >Quản lý Hoàn Ứng</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                <label class="ml-3">Danh Sách</label>
                {{--                @if($role_use_number == 1)--}}
                {{--                @endif--}}
                {{--<a href="{{route('export_to_file_csv')}}" class="btn btn-success btn-xs offset-lg-10" style="float: right;">export</a>--}}
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:10%">Thời gian</th>
                    <th style="width: 10%">Chi tiết</th>
                    <th style="width:10%">Tên Sản Phẩm</th>
                    <th style="width:10%">Mã Sản Phẩm</th>
                    <th style="width:10%">Giá Sản Phẩm</th>
                    <th style="width:10%">Số Lượng Sản Phẩm</th>
                    <th style="width:10%">Tổng số Tiền ứng </th>
                    <th style="width:10%">Tên NV bán hàng</th>
                    <th style="width:10%">Email</th>
                    <th style="width:10%">Hoàn ứng</th>
                </tr>
                </thead>
                <thead>
                <tr>
                    <td>Tổng</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td> <a style="color: blue">{{number_format($list_sum)}}</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($list_hoan_ung) > 0)
                    @foreach($list_hoan_ung as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->time}}</td>
                            <td><a href="{{route('view_detail_hoan_ung_admin2',['id'=>$value->id_order])}}" data-remote="false"
                                   data-toggle="modal" data-target="#modal-admin-action-update">Chi tiết</a></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->product_code}}</td>
                            <td>{{number_format($value->price_sale)}}</td>
                            <td>{{$value->total_product}}</td>
                            <td>{{number_format($value->total_price)}}</td>
                            <td>{{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            @if($value->status_kt === 'wait' && $value->status_payment === 'done')
                                <td style="background-color: #3FF52F;color: white">Chờ xác nhận hoa hồng</td>
                            @elseif($value->status_kt === 'wait' && $value->status_payment === 'wait')
                                <td style="background-color: #DE55FA;color: white">Chờ duyệt hoa hồng</td>
                            @elseif($value->status_kt === 'done' && $value->status_admin2 === 'done')
                                <td style="background-color: blue;color: white">Đã Hoàn Thành</td>
                            @endif
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
        <!-- /.card-body -->
    </div>

    {{--    --}}{{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin Hóa Đơn</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('action_update_hoan_ung_admin2')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
{{--                        <button type="submit" class="btn btn-primary">Hoàn ứng</button>--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--     modal --}}

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $("#modal-admin-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-image").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });

        $(function () {
            $("#example1").DataTable({
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: ['noSort']
                    } // Disable sorting on columns marked as so
                ],
            });

            var  table = $('#example1').DataTable();
            table
                .order( [ 0, 'desc' ] )
                .draw();
            // fix table
            $("#example1").parent().css({"overflow": "auto"});
        });

    </script>

    <script>
        $(document).ready(function(){
            $('#fillter_date').click(function () {
                let area_search = $('#area_search').val();
                let name_user = $('#name_user').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                var dt = {_token,area_search,name_user};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_list_acc_with_area_name')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        $('#table_body').html(resultData);
                        // $('#sum_result').html(resultData['sum']);
                        // console.log(resultData);
                    }
                });
            });
        });
    </script>

@stop



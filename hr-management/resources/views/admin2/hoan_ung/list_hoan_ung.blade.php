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
    <div class="card card-outline card-primary-dashboard">
        <meta name="csrf-token-2" content="{{ csrf_token() }}">
        <div class="card-header">
            <h3 class="card-title">Tìm Kiếm</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Khu vực</label>
                        <select id="area" name = "txtArea" class="form-control select2"  value="{{ old('txtArea') }}" autocomplete="txtArea" style="width: 100%;">
                            @foreach ($list_area as $list_area)
                                <option value="{{$list_area->id}}">{{$list_area->area_name}}-{{$list_area->area_description}}</option>
                            @endforeach
                            <option value="all" selected>Tất Cả</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Nhóm</label>
                        <select id="group" name = "txtGroup" class="form-control select2"  value="{{ old('txtGroup') }}" autocomplete="txtGroup" style="width: 100%;">
                            @foreach ($list_group as $list_group)
                                <option value="{{$list_group->id}}">{{$list_group->name}}-{{$list_group->id_group}}</option>
                            @endforeach
                            <option value="all" selected>Tất Cả</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                        <input id="name_product" type="text" class="form-control @error('txtNameUser') is-invalid @enderror" name="txtFName" value=""  autocomplete="number" required>
                        @error('txtNameUser')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Tên Nhân Viên</label>
                        <input id="name_user" type="text" class="form-control @error('txtNameUser') is-invalid @enderror" name="txtFName" value=""  autocomplete="number" required>
                        @error('txtNameUser')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Trạng Thái</label>
                        <select id="trangthai" name = "txtTrangThai" class="form-control select2"  value="{{ old('txtTrangThai') }}" autocomplete="txtTrangThai" style="width: 100%;">
                            <option value="done" selected>Đã Hoàn Thành</option>
                            <option value="wait" selected>Chờ Duyệt</option>
                            <option value="all" selected>Tất Cả</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Thời Gian Bắt Đầu</label>
                        <input id="start_time" type="date" class="form-control @error('txtStartTime') is-invalid @enderror" name="txtStartTime" value=""  autocomplete="number" required>
                        @error('txtStartTime')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Thời Gian Kết Thúc </label>
                        <input id="end_time" type="date" class="form-control @error('txtEndTime') is-invalid @enderror" name="txtEndTime" value=""  autocomplete="number" required>
                        @error('txtEndTime')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 ml-4 mt-md-2">
                    <button type="submit" id="fillter_date" class="btn btn-primary mt-4" style="float: left"><i class="fas fa-search-minus">Tìm Kiếm</i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                <label class="ml-3">Danh Sách</label>
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
                    <td id="total_product" style="color: blue"></td>
                    <td> <a id="total_price" style="color: blue">{{number_format($list_sum)}}</a></td>
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
                let area_search = $('#area').val();
                let group_search = $('#group').val();
                let name_product = $('#name_product').val();
                let name_user = $('#name_user').val();
                let trangthai = $('#trangthai').val();
                let end_time = $('#end_time').val();
                let start_time = $('#start_time').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                var dt = {_token,area_search,group_search,name_user,trangthai,name_product,end_time,start_time};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_report_hoan_ung')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        console.log(resultData)
                        $('#table_body').html(resultData[0]);
                        $('#total_product').html(resultData[2]);
                        $('#total_price').html(resultData[1]);
                        // $('#total_bonus').html(resultData[3]);
                        // console.log(resultData);
                    }
                });
            });
        });
    </script>

@stop



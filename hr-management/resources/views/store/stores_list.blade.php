@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cửa Hàng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a href="#">Quản Lý Nhân Sự</a></li>
                    <li class="breadcrumb-item active">Cửa Hàng</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div class="col-md-3 ml-4">
                    <div class="form-group float-left">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Khu Vực</label>
                        <select id="area_search" name = "area_search" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                            @foreach ($area as $area)
                                <option value="{{$area['id']}}">{{$area['area_name']}}-{{$area['area_description']}}</option>
                            @endforeach
                            <option value="all" selected>All</option>
                        </select>
                        <button type="submit" id="fillter_date" class="btn btn-primary mt-2" style="float: left"><i class="fas fa-search-minus">Tìm Kiếm</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
{{--                @if($role_use_number == 1)--}}
                    <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-store"><i class="fas fa-plus-circle"></i> Tạo Cửa Hàng Mới</button>
{{--                @endif--}}
                <a href="{{route('export_report_stores')}}" class="btn btn-success" type="button"><i class="fas fa-file-download"></i>Xuất File</a>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead style="width: 100%">
                <tr>
                    <th style="width:10%">#</th>
                    <th style="width:20%">Tên Cửa Hàng</th>
                    <th style="width:20%">Địa Chỉ Cửa Hàng</th>
                    <th style="width:20%">Khu Vực</th>
                    <th style="width:15%">Số Nhân Viên</th>
                    <th style="width:15%" class="noSort">Action</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

{{--     modal --}}
    <div class="modal fade" id="modal-admin-action-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cập Nhật ThôngTin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_information_store')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

{{--     modal --}}
    <div class="modal fade" id="modal-create-store">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tạo Mới Cửa Hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('add_new_store')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Tên Cửa Hàng</label>
                                        <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value=""  autocomplete="number" required>
                                        @error('txtName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Địa Chỉ Cửa Hàng</label>
                                        <input id="fName" type="text" class="form-control @error('txtAddress') is-invalid @enderror" name="txtAddress" value=""  autocomplete="number" required>
                                        @error('txtAddress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone</label>
                                        <input id="lName" type="number" class="form-control @error('txtPhone') is-invalid @enderror" name="txtPhone" value=""  autocomplete="number" required>
                                        @error('txtPhone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Khu vực</label>
                                        <div class="col-sm-10">
                                            <select id="area_id" name = "area_id" class="form-control select2"  value="{{ old('area') }}" autocomplete="type" style="width: 100%;">
                                                @foreach ($area1 as $area)
                                                    <option value="{{$area['id']}}">{{$area['area_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button id="create_member" type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
{{--    --}}{{-- modal --}}
@stop

@section('css')
{{--    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}

{{--    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $("#modal-admin-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-member-project").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
        });

        $(function () {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            fill_datatable();

            function fill_datatable(area = '') {
                var table = $('#example1').DataTable({
                    processing: true,

                    serverSide: true,

                    ajax: {
                        url: "{{ route('ajaxstores.index') }}",
                        data:{area:area}
                    },
                    columns: [

                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                        {data: 'store_name', name: 'store_name'},

                        {data: 'store_address', name: 'store_address'},

                        {data: 'area_name', name: 'area_name'},

                        {data: 'sum', name: 'sum'},

                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ],
                    "oLanguage": {
                        "sSearch": "Tìm Kiếm",
                        "sLengthMenu": "Hiển Thị _MENU_ Bản Ghi",
                    },
                    "language": {
                        "info": "Đang hiển thị _START_ tới _END_ trong _TOTAL_ kết quả",
                    },
                    "bDestroy": true
                });
            }

            $('#fillter_date').click(function () {
                let area = $("#area_search").val();

                if(area != ''){
                    $('#example1').DataTable().destroy();
                    fill_datatable(area);
                }
            });
            $("#example1").parent().css({"overflow": "auto"});
        });

    </script>
@stop


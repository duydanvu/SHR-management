@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý khu vực</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a href="#">Quản Lý Nhân Sự</a></li>
                    <li class="breadcrumb-item active">Khu Vực</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                {{--                @if($role_use_number == 1)--}}
                <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-store"><i class="fas fa-plus-circle"></i> Create Area New </button>
                {{--                @endif--}}
{{--                <a href="{{route('export_report_area')}}" class="btn btn-success" type="button"><i class="fas fa-file-download"></i>Export</a>--}}
{{--                <button id = "" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-file-download"></i> Export </button>--}}
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:10%">Tên Khu Vực</th>
                    <th style="width:15%">Thông tin Chi tiết</th>
                    <th style="width:10%">Tổng số cửa hàng</th>
                    <th style="width:10%">GDV</th>
                    <th style="width:10%">AM</th>
                    <th style="width:10%">KAM</th>
                    <th style="width:10%">Chính Thức</th>
                    <th style="width:10%">Thử Việc</th>
                    <th style="width:10%">Tổng số Nhân Viên</th>
                    <th style="width:5%" class="noSort">Sửa Thông tin Khu Vực</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($area) > 0)
                    @foreach($area as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->area_name}}</td>
                            <td>{{$value->area_description}}</td>
                            <td><a href="{{route('view_store_of_area',['id'=>$value->id])}}">{{$value->sum}}</a></td>
                            <td>{{$value->GDV}}</td>
                            <td>{{$value->AM}}</td>
                            <td>{{$value->KAM}}</td>
                            <td>{{$value->CT}}</td>
                            <td>{{$value->TV}}</td>
                            <td>{{($value->CT)+($value->TV)}}</td>
                            <td class="text-center">
{{--                                @if($role_use_number == 1)--}}
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="{{route('admin_list_update_area',['id'=> $value->id])}}" data-remote="false"
                                           data-toggle="modal" data-target="#modal-area-action-update" class="btn dropdown-item">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                        <a href="{{route('delete_information_area',['id'=> $value->id])}}"  class="btn dropdown-item">
                                            <i class="fas fa-users"> Delete</i>
                                        </a>
                                    </div>

                                </div>
{{--                                @endif--}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="8" style="text-align: center">
                        <h3>Empty Data</h3>
                    </td>
                @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

{{--         modal--}}
        <div class="modal fade" id="modal-area-action-update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Action</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="{{route('update_information_area')}}" method="post">
                        <div class="modal-body">
                            @csrf

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

{{--         modal--}}
    <div class="modal fade" id="modal-create-store">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Area </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{ route('add_new_area') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Tên Khu Vực</label>
                                        <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value=""  autocomplete="number" required>
                                        @error('txtName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Thông tin Chi tiết</label>
                                        <input id="fName" type="text" class="form-control @error('txtDescription') is-invalid @enderror" name="txtDescription" value=""  autocomplete="number" required>
                                        @error('txtDescription')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="create_member" type="submit" class="btn btn-primary">Save changers</button>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $("#modal-area-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-member-project").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
        });

        $(function () {
            $("#example1").DataTable({
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: ['noSort']
                    } // Disable sorting on columns marked as so
                ]
            });
            // fix table
            $("#example1").parent().css({"overflow": "auto"});
        });

    </script>
@stop



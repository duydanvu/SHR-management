@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chấm Công</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Quản lý chấm công</a></li>
                    <li class="breadcrumb-item active">Chấm Công</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary-dashboard">
        <div class="card-header">
            <h3 class="card-title">Tháng {{$month_now}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <button style="height: 15px;width: 5px; background-color: red; margin-left: 20px; margin-top: 20px"></button>
                <a>Nghỉ Không Phép</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <button style="height: 15px;width: 5px; background-color: orange;margin-left: 20px;margin-top: 20px"></button>
                <a>Nghỉ Có Phép</a>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-6">
                <button style="height: 15px;width: 5px; background-color: green;margin-left: 20px;margin-top: 20px"></button>
                <a>Đi Làm</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <button style="height: 15px;width: 5px; background-color: gray;margin-left: 20px;margin-top: 20px"></button>
                <a>Chưa Chấm Công</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
{{--            <div class="row">--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1"></label>--}}
{{--                        <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-plus-circle"></i> Add New Request </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <table id="example1" class="table table-bordered table-striped " style="width: 100%">
                <thead>
                <tr>
                    <th style="width:5%" >#</th>
                    <th style="width:15%" >Tên </th>
                    @foreach($date_of_week as $key=>$value)
                    <th style="width:2%">{{$value}} ({{$key}})</th>
                    @endforeach
                </tr>
                </thead>
                <tbody id="table_body">
                @if ( count($staff) > 0)
                    @foreach($staff as $key => $value)
                        <tr >
                            <td>{{$key}}</td>
                            <td>{{$value->last_name}}</td>
                            @for($i = $date_now;$i >0;$i--)
                                @if($i <10 )@php($item = 'D0'.$i)
                                @else @php($item = 'D'.$i)
                                @endif
                                <td ><a href="{{route('show_view_update_time_sheet',['id'=>$value->id,'date'=>$i])}}"
                                        data-toggle="modal" data-target="#modal-admin-update-request-timesheet" type="button"
                                        style="width: 40px;height: 40px;
                                    @if($value->$item == 3) background-color: red;
                                    @elseif($value->$item == 2) background-color: orange;
                                        @elseif($value->$item == 1) background-color: green;
                                        @else background-color: gray;
                                    @endif"></a></td>
                            @endfor
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

    {{-- modal --}}
    <div class="modal fade" id="modal-admin-view-request-timesheet">
        <div class="modal-dialog" style="max-width: 600px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Request</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('add_request_with_log_time_sheet')}}" method="post">
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
    {{--     modal --}}

    {{-- modal --}}
    <div class="modal fade" id="modal-admin-update-request-timesheet">
        <div class="modal-dialog" style="max-width: 600px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chấm Công</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_request_with_log_time_sheet')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <input name="id_submit" hidden/>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button id="btn_accept" type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--     modal --}}
    {{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update-timesheet-staff">
        <div class="modal-dialog" style="max-width: 600px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View User and Add Timesheet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_time_sheet_for_store_manage')}}" method="post">
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
    {{--     modal --}}

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('.date_range').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('month'),
            endDate: moment(),
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        $("#modal-admin-view-request-timesheet").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-timesheet-staff").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-update-request-timesheet").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        // Datatable
        $(function () {
            // $("#example1").DataTable({
            //     aoColumnDefs: [
            //         {
            //             bSortable: false,
            //             aTargets: ['noSort']
            //         } // Disable sorting on columns marked as so
            //     ]
            // });
            // fix table
            $("#example1").parent().css({"overflow": "auto"});
        });


    </script>

    <script>
    </script>

@stop




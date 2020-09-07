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
            <h3 class="card-title">Danh sách Chấm Công</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thời Gian : </label>
                        <input  type="date" id="datePicker"  value="" name="date_now" >
                    </div>
                </div>
{{--                @if($roles->position_id == 2)--}}
{{--                <div class="col-2 offset-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1"></label>--}}
{{--                        <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-time-sheet-cht">--}}
{{--                            <i class="fas fa-plus-circle"></i> Add Time Sheet </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endif--}}
{{--                <div class="col-2 offset-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1"></label>--}}
{{--                        <button id = "" type="submit" class="btn btn-info" >--}}
{{--                            <i class="fas fa-plus-circle"></i> Thêm Chấm Công</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <table id="example1" class="table table-bordered table-striped " style="width: 100%">
                <thead>
                <tr>
                    <th style="width:5%" >#</th>
{{--                    <th style="width:5%" >STT</th>--}}
                    <th style="width:25%" >Tên Nhân Viên</th>
                    <th style="width:25%">Email</th>
                    <th style="width:15%">Ngày Sinh</th>
                    <th style="width:10%">Giới tính</th>
                    <th style="text-align: center;width:15%">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if ( count($staff) > 0)
                    @php($i = 1)
                  @foreach($staff as $value)
                      <tr>
{{--                          <td><input type="checkbox" id="{{$value->id}}"></td>--}}
                          <td>{{$i++}}</td>
                          <td>{{$value->first_name}} {{$value->last_name}}</td>
                          <td>{{$value->email}}</td>
                          <td>{{$value->dob}}</td>
                          <td>{{$value->gender}}</td>
                          <td>
                              <a type="button" href="{{route('show_view_add_time_sheet',['id'=>$value->id])}}" data-remote="false"
                                 data-toggle="modal" data-target="#modal-admin-action-add-timesheet" class="btn dropdown-item">
                                  <i class="fas fa-plus-circle"> Chấm Công</i>
                              </a>
                              @if($roles->position_id == 1)
{{--                              <a href="{{route('show_view_update_time_sheet',['id'=>$value->id_timesheet])}}" data-remote="false"--}}
{{--                                 data-toggle="modal" data-target="#modal-admin-action-update-timesheet-staff" class="btn dropdown-item">--}}
{{--                                  <i class="fas fa-info-circle">update</i>--}}
{{--                              </a>--}}
                              @endif
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
            </form>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal-admin-action-add-timesheet">
        <div class="modal-dialog" style="max-width: 600px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View User and Add Timesheet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('add_time_sheet_for_staff')}}" method="post">
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

    {{--     modal --}}
    <div class="modal fade" id="modal-create-time-sheet-cht">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Time Sheet</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('add_logtime_cht')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body">

                                    <div class="form-group">
                                        <input name="txtIDCht" value="{{$roles->id}}" hidden>
                                        <label for="name">Tên Nhân Viên</label>
                                        <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$roles->first_name}}{{$roles->last_name}}"  autocomplete="number" required readonly>
                                        @error('txtName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày</label>
                                        <input id="date_logtime" type="date" class="form-control @error('txtdate') is-invalid @enderror" name="txtdate" value=""  autocomplete="number" required >
                                        @error('txtdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Time sheet</label>
                                        <select id="status_timesheet" name = "status_timesheet" class="form-control select2"  value="{{ old('status_timesheet') }}" autocomplete="status_timesheet" style="width: 100%;">
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Comment</label>
                                        <input id="fName" type="text" class="form-control @error('txtDescription') is-invalid @enderror" name="txtDescription" value=""  autocomplete="number">
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
        $("#modal-admin-action-add-timesheet").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-timesheet-staff").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });

        $('.date_range').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('month'),
            endDate: moment(),
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        var today = moment().format('YYYY-MM-DD');
        $('#datePicker').val(today);
        // Datatable
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



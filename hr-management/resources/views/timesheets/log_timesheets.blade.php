@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report</h1>
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
            <h3 class="card-title">List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Today : </label>
                        <input  type="text" id="datePicker"  value="" name="date_now" readonly>
                    </div>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped " style="width: 100%">
                <thead>
                <tr>
                    <th style="width:5%" >#</th>
                    <th style="width:25%" >Tên Nhân Viên</th>
                    <th style="width:25%">Email</th>
                    <th style="width:15%">Ngày Sinh</th>
                    <th style="width:10%">Giới tính</th>
                    <th style="text-align: center;width:15%">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if ( count($staff) > 0)
                  @foreach($staff as $key => $value)
                      <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$value->first_name}} {{$value->last_name}}</td>
                          <td>{{$value->email}}</td>
                          <td>{{$value->dob}}</td>
                          <td>{{$value->gender}}</td>
                          <td><a href="{{route('show_view_add_time_sheet',['id'=>$value->id])}}" data-remote="false"
                                 data-toggle="modal" data-target="#modal-admin-action-add-timesheet" class="btn dropdown-item">
                                  <i class="fas fa-info-circle">detail</i>
                              </a>
                              <a href="{{route('show_view_update_time_sheet',['id'=>$value->id_timesheet])}}" data-remote="false"
                                 data-toggle="modal" data-target="#modal-admin-action-add-timesheet" class="btn dropdown-item">
                                  <i class="fas fa-info-circle">update</i>
                              </a>
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



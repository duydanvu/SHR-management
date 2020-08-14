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
                    <th style="width:30%">Email</th>
                    <th style="width:15%">Ngày Sinh</th>
                    <th style="width:10%">Giới tính</th>
                    <th style="text-align: center;width:15%">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                {{--                @if ( count($total) > 0)--}}
                {{--                    @foreach($total as $key => $value)--}}
                {{--                        <tr>--}}
                {{--                            <td>{{$key+1}}</td>--}}
                {{--                            <td>{{$value->date}}</td>--}}
                {{--                            <td>{{$value->acc_sub}}</td>--}}
                {{--                            <td>{{$value->acc_unsub_pp}}</td>--}}
                {{--                            <td>{{$value->acc_unsub_stm}}</td>--}}
                {{--                            <td>{{$value->acc_psc}}</td>--}}
                {{--                            <td>{{$value->acc_active}}</td>--}}
                {{--                            <td>{{round( ($value->acc_gh/$sum)*100 ,3) }} %</td>--}}
                {{--                            <td>{{$value->acc_dk_sms}}</td>--}}
                {{--                            <td>{{$value->acc_dk_vasgate}}</td>--}}
                {{--                            <td>{{$value->acc_dk_wap}}</td>--}}
                {{--                            <td>{{$value->acc_dk_sms + $value->acc_dk_vasgate + $value->acc_dk_wap}}</td>--}}
                {{--                            <td>{{$value->revenue_day}}</td>--}}
                {{--                        </tr>--}}
                {{--                    @endforeach--}}
                {{--                @else--}}
                {{--                    <td colspan="8" style="text-align: center">--}}
                {{--                        <h3>Empty Data</h3>--}}
                {{--                    </td>--}}
                {{--                @endif--}}

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

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

        var today = moment().format('YYYY-MM-DD');
        $('#datePicker').val(today);

        {{--$('#export_data').click(function () {--}}
        {{--    var datetimes = $('#date_range').val();--}}
        {{--    datetimes = datetimes.split('/').join('.');--}}
        {{--    datetimes = datetimes.split(' ').join('');--}}
        {{--    console.log(datetimes);--}}
        {{--    var url = "{{ route ('export_to_file_csv',['datetime' => ":datetime"])}}";--}}
        {{--    url = url.replace(':datetime', datetimes);--}}
        {{--    console.log(url);--}}
        {{--    window.location.href = url;--}}
        {{--})--}}

        {{--$(document).ready(function(){--}}
        {{--    $('#fillter_date').click(function () {--}}
        {{--        let date_range = $('#date_range').val();--}}
        {{--        let _token = $('meta[name="csrf-token"]').val();--}}
        {{--        var startEnd = $("#date_range").val();--}}
        {{--        var dt = {_token, startEnd};--}}
        {{--        $.ajaxSetup({--}}
        {{--            headers: {--}}
        {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--            }--}}
        {{--        });--}}
        {{--        $.ajax({--}}
        {{--            type:'POST',--}}
        {{--            url:'{{route('search_date_time')}}',--}}
        {{--            data:dt,--}}
        {{--            success:function(resultData){--}}
        {{--                // // $('.effort').val(resultData);--}}
        {{--                $('#table_body').html(resultData);--}}
        {{--                // console.log(resultData);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}
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



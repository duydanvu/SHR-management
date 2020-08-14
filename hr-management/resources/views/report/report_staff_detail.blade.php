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
                    <li class="breadcrumb-item "><a href="#">Thống kê báo cáo</a></li>
                    <li class="breadcrumb-item active">Report Staff Detail</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary-dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="card-header">
            <h3 class="card-title">Search</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Time</label>
                        <input  type="text" id="date_range" class="form-control date_range @error('idear_start_end') is-invalid @enderror" value="" name="idear_start_end">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Store</label>
                        <select class="browser-default custom-select">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Staff with Store</label>
                        <select class="browser-default custom-select">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" style="background: transparent;">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                    <a href=" " type="submit" class="btn btn-default" >Refresh</a>
                    <a type="submit" id="export_data"  class="btn btn-success btn-xs offset-lg-10" style="margin: auto" >Export</a>
                    <button type="submit" id="fillter_date" class="btn btn-primary" style="float: right;">Filter</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped " style="width: 100%">
                <thead>
                <tr>
                    <th style="width:3%" >#</th>
                    <th style="width:10%" >Tên Cửa Hàng</th>
                    <th >Tên Nhân Viên</th>
                    <th >Ngày </th>
                    <th >Status</th>
                    <th >Comment</th>
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


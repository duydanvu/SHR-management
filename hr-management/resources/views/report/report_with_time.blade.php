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
                    <li class="breadcrumb-item "><a href="/home">Trang chủ</a></li>
                    <li class="breadcrumb-item "><a href="#">Quản Lý Nhân Sự</a></li>
                    <li class="breadcrumb-item active">Chi tiết Nhân Sự</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary-dashboard">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="card-header">
            <h3 class="card-title">Tìm Kiếm</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <meta name="csrf-token-2" content="{{ csrf_token() }}">
{{--                <div class="col-md-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="col-12" for="exampleInputEmail1">Search by Time</label>--}}
{{--                        <input  type="month" id="date_month"  value="" name="idear_date_month">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Khu vực</label>
                        <select id="area_search" name = "area_search" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                            @foreach ($area as $area)
                                <option value="{{$area['id']}}">{{$area['area_name']}}-{{$area['area_description']}}</option>
                            @endforeach
                                <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cửa Hàng</label>
                        <select id="store_search" name = "store_search" class="form-control select2"  value="{{ old('store_search') }}" autocomplete="store_search" style="width: 100%;">
                            @foreach ($store as $store2)
                                <option value="{{$store2['store_id']}}">{{$store2['store_name']}}-{{$store2['store_address']}}</option>
                            @endforeach
                                <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Chức Vụ</label>
                        <select id="position_search" name = "position_search" class="form-control select2"  value="{{ old('position_search') }}" autocomplete="position_search" style="width: 100%;">
                            @foreach ($position as $position)
                                <option value="{{$position['position_id']}}">{{$position['position_name']}}-{{$position['description']}}</option>
                            @endforeach
                                <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phòng Ban</label>
                        <select id="department_search" name = "department_search" class="form-control select2"  value="{{ old('department_search') }}" autocomplete="department_search" style="width: 100%;">
                            @foreach ($department as $department)
                                <option value="{{$department['id']}}">{{$department['name']}}-{{$department['description']}}</option>
                            @endforeach
                                <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dịch Vụ</label>
                        <select id="service_search" name = "service_search" class="form-control select2"  value="{{ old('service_search') }}" autocomplete="service_search" style="width: 100%;">
                            @foreach ($service as $service)
                                <option value="{{$service['id']}}">{{$service['name']}}-{{$service['description']}}</option>
                            @endforeach
                                <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" >Hợp Đồng</label>
                        <select id="contract_search" name = "contract_search" class="form-control select2"  value="{{ old('contract_search') }}" autocomplete="contract_search" style="width: 100%;">
                            @foreach ($contract as $contract)
                                <option value="{{$contract['contract_id']}}">{{$contract['name']}}-{{$contract['description']}}</option>
                            @endforeach
                                <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thời Gian Bắt đầu</label>
                        <input id="start_date" type="date" class="form-control @error('txtComment') is-invalid @enderror"  name="txtStartDate"  autocomplete="number" required >
                        @error('txtComment')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thời Gian Kết Thúc</label>
                        <input id="end_date" type="date" class="form-control @error('txtComment') is-invalid @enderror"  name="txtEndDate"  autocomplete="number" required >
                        @error('txtComment')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" style="background: transparent;">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12">
                    <a href=" " type="submit" class="btn btn-default" >Làm Mới</a>
                    <button id = "import_user" type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modal-admin-export-user"><i class="fas fa-plus-circle"></i> Xuất File </button>
                    <button type="submit" id="fillter_date" class="btn btn-primary" style="float: right;">Tìm Kiếm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh Sách</h3>
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
                    <th style="width:5%" >#</th>
                    <th style="width:10%" >Tên Cửa Hàng</th>
                    <th style="text-align: center;width: 10%">Tên Nhân Viên</th>
{{--                    <th style="text-align: center;width: 10%">Email</th>--}}
{{--                    <th style="text-align: center;width: 5%">Phone</th>--}}
                    <th style="text-align: center;width: 10%">Ngày Sinh</th>
{{--                    <th style="text-align: center;width: 10%">Trình Độ Chuyên Môn</th>--}}
                    <th style="text-align: center;width: 5%">Chức Danh</th>
{{--                    <th style="text-align: center;width: 5%">Bộ Phận</th>--}}
{{--                    <th style="text-align: center;width: 5%">Dịch Vụ</th>--}}
                    <th style="text-align: center;width: 5%">Hợp Đồng</th>
                    <th style="text-align: center;width: 10%">Số Hợp Đồng</th>
                    <th style="text-align: center;width: 10%">Ngày Ký Hợp Đồng</th>
                    <th style="text-align: center;width: 10%">Ngày Hết Hạn Hợp Đồng</th>
                    <th style="text-align: center;width: 10%">View Detail</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if ( count($user) > 0)
                    @foreach($user as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->store_name}}</td>
                            <td>{{$value->first_name}} {{$value->last_name}}</td>
{{--                            <td style="width:10%">{{str_replace("@","@ ",$value->email)}}</td>--}}
{{--                            <td>{{str_replace("/","-",$value->phone)}}</td>--}}
                            <td>{{$value->dob}}</td>
{{--                            <td>{{$value->line}}</td>--}}
                            <td>{{$value->position_name}}</td>
{{--                            <td>{{$value->dp_name}}</td>--}}
{{--                            <td>{{$value->sv_name}}</td>--}}
                            <td>{{$value->ct_name}}</td>
                            <td>{{$value->contract_number}}</td>
                            <td>{{$value->start_time}}</td>
                            <td>{{$value->end_time}}</td>
                            <td class="text-center">
                                {{--                                @if($role_use_number == 1)--}}
                                <a href="{{route('view_user_detail_report',['id'=>$value->id])}}" data-remote="false"
                                   data-toggle="modal" data-target="#modal-admin-action-update-detail" class="btn dropdown-item">
                                    <i class="fas fa-info-circle">detail</i>
                                </a>
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
            {{ $user->links() }}
        </div>
        <!-- /.card-body -->
    </div>
    {{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update-detail">
        <div class="modal-dialog" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--     modal --}}
    {{--    modal--}}
    <div class="modal fade" id="modal-admin-export-user">
        <div class="modal-dialog col-lg-8" style="max-width: 800px">
            <div class="modal-content col-lg-12 ">
                <div class="modal-header">
                    <h4 class="modal-title">Export User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('export_report_user')}}" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="col-6 float-left">
                                        <div class="form-group ">
                                    <label for="name">Khu Vực</label>
                                    <div class="col-sm-10 p-0">
                                        <select id="area_export" name = "area_export" class="form-control select2"  value="{{ old('area_export') }}" autocomplete="area_export" style="width: 100%;">
                                            @foreach ($area1 as $area)
                                                <option value="{{$area['id']}}">{{$area['area_name']}}-{{$area['area_description']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                        <div class="form-group ">
                                        <label for="name">Cửa hàng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="store_export" name = "store_export" class="form-control select2"  value="{{ old('store') }}" autocomplete="store_export" style="width: 100%;">
                                                @foreach ($store1 as $store1)
                                                    <option value="{{$store1['store_id']}}">{{$store1['store_name']}}-{{$store1['store_address']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label for="name">Chức Vụ</label>
                                        <div class="col-sm-10 p-0 ">
                                            <select id="position_export" name = "position_export" class="form-control select2"  value="{{ old('position') }}" autocomplete="position_export" style="width: 100%;">
                                                @foreach ($position1 as $position1)
                                                    <option value="{{$position1['position_id']}}">{{$position1['position_name']}}-{{$position1['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="name_ex" name="name_ex">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Họ và Tên
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="email_ex" name="email_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Email
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="phone_ex" name="phone_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Phone
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="dob_ex" name="dob_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Ngày sinh
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="gender_ex" name="gender_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Giới tính
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="line_ex" name="line_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Trình độ chuyên môn
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="NContract_ex" name="NContract_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Số hợp đồng
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="start_time_ex" name="start_time_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Ngày bắt đầu ký hợp đồng
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="true" id="end_time_ex" name="end_time_ex">
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Ngày kết thúc ký hợp đồng
                                                </label>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Hợp Đồng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="contract_export" name = "contract_export" class="form-control select2"  value="{{ old('contract') }}" autocomplete="contract_export" style="width: 100%;">
                                                @foreach ($contract1 as $contract1)
                                                    <option value="{{$contract1['contract_id']}}">{{$contract1['name']}}-{{$contract1['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bộ Phận</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="department_export" name = "department_export" class="form-control select2"  value="{{ old('department') }}" autocomplete="department_export" style="width: 100%;">
                                                @foreach ($department1 as $department1)
                                                    <option value="{{$department1['id']}}">{{$department1['name']}}-{{$department1['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Dịch Vụ</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="service_export" name = "service_export" class="form-control select2"  value="{{ old('service') }}" autocomplete="service_export" style="width: 100%;">
                                                @foreach ($service1 as $service1)
                                                    <option value="{{$service1['id']}}">{{$service1['name']}}-{{$service1['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="idNumber_ex" name="idNumber_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Số CMT
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="tin_ex" name="tin_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Mã số thuế cá nhân
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="idDate_ex" name="idDate_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Ngày cấp CMT
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="idAddress_ex" name="idAddress_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Nơi cấp CMT
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="sscNumber_ex" name="sscNumber_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Số bảo hiểm xã hội
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="hospital_ex" name="hospital_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Nơi đăng ký khám chữa bệnh
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="ban_ex" name="ban_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Số tài khoản ngân hàng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="bank_ex" name="bank_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Ngân hàng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="noi_add_ex" name="noi_add_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Địa chỉ thường trú
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="true" id="add_now_ex" name="add_now_ex">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Địa chỉ hiện tại
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="import_member" type="submit" class="btn btn-primary" >Export</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    {{--    modal--}}
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $("#modal-admin-action-update-detail").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#area_search").change(function () {
                var area = $("#area_search").val();
                $.ajax({
                    headers:{'X-CSRF-Token':$('meta[name="csrf-token-2"]').attr('content')},
                    url:"{{url('admin/user/area_store')}}",
                    type:"POST",
                    data: {
                        area : area
                    },
                    success:function (data) {

                        $('#store_search').empty();
                        $.each(data.stores,function(index,store){
                            // console.log(index);
                            // console.log(store);
                            $('#store_search').append('<option value="'+store.store_id+'">'+store.store_name+'-'+store.store_address+'</option>');
                        })
                    }
                })
            })
        })
    </script>
    <script>
        $('.date_range').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('month'),
            endDate: moment(),
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        $(document).ready(function(){
            $('#fillter_date').click(function () {
                // let date_range = $('#date_month').val();
                let store_search = $('#store_search').val();
                let area_search = $('#area_search').val();
                let position_search = $('#position_search').val();
                let department_search = $('#position_search').val();
                let service_search = $('#service_search').val();
                let contract_search = $('#contract_search').val();
                let start_date = $('#start_date').val();
                let end_date = $('#end_date').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                // console.log(date_range);
                // console.log(store_seach);
                // console.log(position_search);
                // console.log(department_search);
                // console.log(service_search);
                // console.log(contract_search);
                var dt = {_token,area_search,store_search,position_search,department_search,service_search,contract_search,start_date,end_date};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_date_time')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        $('#table_body').html(resultData);
                        // console.log(resultData);
                    }
                });
            });
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

@stop


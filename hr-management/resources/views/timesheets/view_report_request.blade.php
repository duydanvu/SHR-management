@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report Timesheet</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Timesheets</a></li>
                    <li class="breadcrumb-item active">Report</li>
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
            <form action="{{route('export_report_timesheet')}}" method="post">
            <div class="row">
                @csrf
                <div class="col-md-3">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Search by Area</label>
                        <select id="area_search" name = "area_search" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                            @foreach ($area as $area)
                                <option value="{{$area['id']}}">{{$area['area_name']}}-{{$area['area_description']}}</option>
                            @endforeach
                                <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Store</label>
                        <select id="store_search" name = "store_search" class="form-control select2"  value="{{ old('store_search') }}" autocomplete="store_search" style="width: 100%;">
                            @foreach ($store as $store2)
                                <option value="{{$store2['store_id']}}">{{$store2['store_name']}}-{{$store2['store_address']}}</option>
                            @endforeach
                                <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Position</label>
                        <select id="position_search" name = "position_search" class="form-control select2"  value="{{ old('position_search') }}" autocomplete="position_search" style="width: 100%;">
                            @foreach ($position as $position)
                                <option value="{{$position['position_id']}}">{{$position['position_name']}}-{{$position['description']}}</option>
                            @endforeach
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Department</label>
                        <select id="department_search" name = "department_search" class="form-control select2"  value="{{ old('department_search') }}" autocomplete="department_search" style="width: 100%;">
                            @foreach ($department as $department)
                                <option value="{{$department['id']}}">{{$department['name']}}-{{$department['description']}}</option>
                            @endforeach
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Service</label>
                        <select id="service_search" name = "service_search" class="form-control select2"  value="{{ old('service_search') }}" autocomplete="service_search" style="width: 100%;">
                            @foreach ($service as $service)
                                <option value="{{$service['id']}}">{{$service['name']}}-{{$service['description']}}</option>
                            @endforeach
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Search by Contract</label>
                        <select id="contract_search" name = "contract_search" class="form-control select2"  value="{{ old('contract_search') }}" autocomplete="contract_search" style="width: 100%;">
                            @foreach ($contract as $contract)
                                <option value="{{$contract['contract_id']}}">{{$contract['name']}}-{{$contract['description']}}</option>
                            @endforeach
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Start time</label>
                        <input id="start_date" type="date" class="form-control @error('txtComment') is-invalid @enderror"  name="txtStartDate"  autocomplete="number" required >
                        @error('txtComment')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">End time</label>
                        <input id="end_date" type="date" class="form-control @error('txtComment') is-invalid @enderror"  name="txtEndDate"  autocomplete="number" required >
                        @error('txtComment')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background: transparent;">
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <a href=" " type="submit" class="btn btn-default" >Refresh</a>
                        <button id = "import_user" type="submit" class="btn btn-success" data-toggle="modal"
                                data-target="#modal"><i class="fas fa-plus-circle"></i> Export Report</button>
                        <button type="button" id="fillter_date" class="btn btn-primary" style="float: right;">Filter</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
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
                <tr style="text-align: center">
                    <th style="width:5%" rowspan="2">#</th>
                    <th style="width:15%" rowspan="2">Họ Tên</th>
                    <th style="width:15%" rowspan="2">Email</th>
                    <th style="width:10%" rowspan="2">Cửa Hàng</th>
                    <th style="width:5%" rowspan="2">Chức Danh</th>
                    <th style="width:10%" rowspan="2">Bộ Phận</th>
                    <th style="width:10%" rowspan="2">Dịch Vụ</th>
                    <th style="width:10%" rowspan="2">Số Ngày Làm</th>
                    <th style="width:20%" class="noSort" colspan="2">Số Ngày Nghỉ</th>
                </tr>
                <tr>
                    <th>Có phép</th>
                    <th>Không Phép</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($user) > 0)
                    @foreach($user as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->store_name}}</td>
                            <td>{{$value->position_name}}</td>
                            <td>{{$value->dp_name}}</td>
                            <td>{{$value->sv_name}}</td>
                            <td>{{$value->present}}</td>
                            <td>{{$value->absent_yes}}</td>
                            <td>{{$value->absent_no}}</td>
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

    {{--    --}}{{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update">
        <div class="modal-dialog" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Action</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_information_user')}}" method="post">
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

    {{--    --}}{{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update-detail">
        <div class="modal-dialog" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Action</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_information_user_detail')}}" method="post">
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
    <div class="modal fade" id="modal-admin-action-update-image">
        <div class="modal-dialog" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Action</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_information_user_image')}}" method="post">
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
    {{--    modal--}}
    <div class="modal fade" id="modal-admin-import-user">
{{--        <div class="modal-dialog col-lg-8" style="max-width: 800px">--}}
{{--            <div class="modal-content col-lg-12 ">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title">Import User</h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form class="form-horizontal" action="{{route('import')}}" enctype="multipart/form-data" method="post">--}}
{{--                    <div class="modal-body">--}}
{{--                        @csrf--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-12 col-sm-12">--}}
{{--                                <div class="card-body col-lg-6 float-left">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Giới Tính</label>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input id="male_import" type="radio" class="form-check-input" name="txtGender" value="male"  autocomplete="number" required>--}}
{{--                                            <label class="form-check-label " for="male">--}}
{{--                                                Male--}}
{{--                                            </label>--}}
{{--                                            <input id="female_import" type="radio" class="form-check-input ml-4" name="txtGender" value="female"  autocomplete="number" required>--}}
{{--                                            <label class="form-check-label ml-5 " for="female">--}}
{{--                                                Female--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group mt-4">--}}
{{--                                        <label class="pt-1"for="name">Cửa hàng</label>--}}
{{--                                        <div class="col-sm-10 p-0">--}}
{{--                                            <select id="store_import" name = "store_import" class="form-control select2"  value="{{ old('store') }}" autocomplete="store_import" style="width: 100%;">--}}
{{--                                                @foreach ($store1 as $store)--}}
{{--                                                    <option value="{{$store['store_id']}}">{{$store['store_name']}}-{{$store['store_address']}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Chức Vụ</label>--}}
{{--                                        <div class="col-sm-10 p-0 ">--}}
{{--                                            <select id="position_import" name = "position_import" class="form-control select2"  value="{{ old('position') }}" autocomplete="position_import" style="width: 100%;">--}}
{{--                                                @foreach ($position1 as $position)--}}
{{--                                                    <option value="{{$position['position_id']}}">{{$position['position_name']}}-{{$position['description']}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Hợp Đồng</label>--}}
{{--                                        <div class="col-sm-10 p-0">--}}
{{--                                            <select id="contract_import" name = "contract_import" class="form-control select2"  value="{{ old('contract') }}" autocomplete="contract_import" style="width: 100%;">--}}
{{--                                                @foreach ($contract1 as $contract)--}}
{{--                                                    <option value="{{$contract['contract_id']}}">{{$contract['name']}}-{{$contract['description']}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Bộ Phận</label>--}}
{{--                                        <div class="col-sm-10 p-0">--}}
{{--                                            <select id="department_import" name = "department_import" class="form-control select2"  value="{{ old('department') }}" autocomplete="department_import" style="width: 100%;">--}}
{{--                                                @foreach ($department1 as $department)--}}
{{--                                                    <option value="{{$department['id']}}">{{$department['name']}}-{{$department['description']}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Dịch Vụ</label>--}}
{{--                                        <div class="col-sm-10 p-0">--}}
{{--                                            <select id="service_import" name = "service_import" class="form-control select2"  value="{{ old('service') }}" autocomplete="service_import" style="width: 100%;">--}}
{{--                                                @foreach ($service1 as $service)--}}
{{--                                                    <option value="{{$service['id']}}">{{$service['name']}}-{{$service['description']}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <div class="col-sm-10 p-0">--}}
{{--                                            <input type="file" name="file" required="true">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer justify-content-between">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button id="import_member" type="submit" class="btn btn-primary" >Import</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <!-- /.modal-content -->--}}
{{--        </div>--}}
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

        $("#modal-admin-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-image").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-detail").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });

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
        $(document).ready(function () {
            $("#area_search").change(function () {
                var area = $("#area_search").val();
                $.ajax({
                    headers:{'X-CSRF-Token':$('meta[name="csrf-token2"]').attr('content')},
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
                        $('#store_search').append('<option value="all">All</option>');
                    }
                })
            })
        })
    </script>
    <script>
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
                let end_date = $('#end_date').val()
                let _token = $('meta[name="csrf-token2"]').attr('content');
                var dt = {_token,area_search,store_search,position_search,department_search,service_search,contract_search,start_date,end_date};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_date_timesheet')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        $('#table_body').html(resultData);
                        // console.log(resultData);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            $('#select_file').on('change',function(event){
                console.log("da vao day");
                var reader = new FileReader();

                var filedata = this.files[0];
                var imgtype = filedata.type;

                var match = ['image/jpeg','image/jpg','image/png']

                if(!(imgtype == match[0])||(imgtype == match[1])||(imgtype == match[2])){
                    $('#mgs_ta').html('<p style = "color:red">Chọn đúng kiểu cho ảnh ... chỉ có jpeg, jpg và png</p>');
                }
                else {
                    $('#mgs_ta').empty();
                    //preview image
                    reader.onload = function (event) {
                        $('#img_prv1').attr('src', event.target.result).css('width', '150').css('height', '200');
                    }
                    reader.readAsDataURL(this.files[0]);
                    //end preview

                    // upload file
                    var postData = new FormData();
                    postData.append('file',this.files[0]);

                    var url = "{{url('file/upload_file')}}";

                    $.ajax({
                        headers:{'X-CSRF-Token':$('meta[name="csrf-token1"]').attr('content')},
                        url:url,
                        type:"post",
                        async:true,
                        contentType: false,
                        data: postData,
                        processData: false,
                        success:function(dataresult)
                        {
                            console.log(dataresult);
                            $("#url_image1").html(dataresult['url']);
                        }
                    })

                }

            });

        });
    </script>
@stop



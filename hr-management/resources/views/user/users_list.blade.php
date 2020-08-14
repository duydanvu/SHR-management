@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Admin User</a></li>
                    <li class="breadcrumb-item active">User</li>
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
                <label for="exampleInputEmail1" style="font-size: 20px; margin-left: 1%">List of Stores</label>
                <div class="col-md-8"  style="float: left">
                    <div class="form-group col-4" style="float: left;font-size: 20px">
                        <select class="mdb-select md-form colorful-select dropdown-primary col-12">
                            <option value="1">Stores 1</option>
                            <option value="2">Stores 2</option>
                            <option value="3">Stores 3</option>
                        </select>
                    </div>
                    <div style="float: left">
                        <button type="submit" id="fillter_date" class="btn btn-primary" style="float: left"><i class="fas fa-search-minus">Search</i></button>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="card-footer" style="background: transparent;">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 col-md-12 col-sm-12">--}}
{{--                    <a href=" " type="submit" class="btn btn-default" >Refresh</a>--}}
{{--                    <a type="submit" id="export_data"  class="btn btn-success btn-xs offset-lg-10" style="margin: auto" >Export</a>--}}
{{--                    <button type="submit" id="fillter_date" class="btn btn-primary" style="float: right;">Filter</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
{{--                @if($role_use_number == 1)--}}
                    <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-plus-circle"></i> Create Account </button>
{{--                @endif--}}
                {{--<a href="{{route('export_to_file_csv')}}" class="btn btn-success btn-xs offset-lg-10" style="float: right;">export</a>--}}
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
                    <th style="width:20%">Image</th>
                    <th style="width:10%">Tên Đăng Nhập</th>
                    <th style="width:10%">Họ Tên</th>
                    <th style="width:10%">Email</th>
                    <th style="width:10%">Phone</th>
                    <th style="width:10%">DOB</th>
                    <th style="width:10%">Gender</th>
                    <th style="width:10%">Address</th>
                    <th style="width:5%" class="noSort">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($user) > 0)
                    @foreach($user as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td></td>
                            <td>{{$value->login}}</td>
                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->dob}}</td>
                            <td>{{$value->gender}}</td>
                            <td>{{$value->address}}</td>
                            <td class="text-center">
{{--                                @if($role_use_number == 1)--}}
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" data-remote="false"
                                               data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                                <i class="fas fa-edit"> Edit</i>
                                            </a>
                                            <a href="#"  class="btn dropdown-item">
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

{{--    --}}{{-- modal --}}
{{--    <div class="modal fade" id="modal-admin-action-update">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title">Update Action</h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form action="{{route('admin_list_update_post_user')}}" method="post">--}}
{{--                    <div class="modal-body">--}}
{{--                        @csrf--}}

{{--                    </div>--}}
{{--                    <div class="modal-footer justify-content-between">--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <!-- /.modal-content -->--}}
{{--        </div>--}}
{{--        <!-- /.modal-dialog -->--}}
{{--    </div>--}}

{{--     modal --}}
    <div class="modal fade" id="modal-create-member">
        <div class="modal-dialog col-lg-8" style="max-width: 1200px">
            <div class="modal-content col-lg-12 ">
                <div class="modal-header">
                    <h4 class="modal-title">Create Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="card-body col-lg-2 float-left">
                                <span id="uploaded_image"><img src="{{URL::to('/')}}/upload/shih_tzu_beds.jpg" style="max-width: 150px;max-height: 200px; width: 150px;height: 200px"></span>
                                <div class="form-group">
                                    <label for="name">Upload Ảnh</label>
                                    <form action="#" id="upload_form" enctype="multipart/form-data" method="POST">
                                        {{ csrf_field() }}
                                        <input id="select_file" type="file" name="select_file" required="true">
                                    </form>
                                </div>
                                <span id="uploaded_image"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" action="#" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card-body col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Tên tài khoản</label>
                                        <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value=""  autocomplete="number" required>
                                        @error('txtName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Mật Khẩu</label>
                                        <input id="txtPassword" type="password" class="form-control @error('txtPassword') is-invalid @enderror" name="txtPassword" value=""  autocomplete="number" required>
                                        @error('txtPassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input id="fName" type="text" class="form-control @error('txtFName') is-invalid @enderror" name="txtFName" value=""  autocomplete="number" required>
                                        @error('txtFName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input id="lName" type="text" class="form-control @error('txtLName') is-invalid @enderror" name="txtLName" value=""  autocomplete="number" required>
                                        @error('txtLName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input id="email" type="text" class="form-control @error('txtEmail') is-invalid @enderror" name="txtEmail" value=""  autocomplete="number" required>
                                        @error('txtEmail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone</label>
                                        <input id="email" type="text" class="form-control @error('txtPhone') is-invalid @enderror" name="txtPhone" value=""  autocomplete="number" required>
                                        @error('txtPhone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày Sinh</label>
                                        <input id="email" type="date" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value=""  autocomplete="number" required>
                                        @error('txtDob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-body col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Địa Chỉ</label>
                                        <input id="email" type="text" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value=""  autocomplete="number" required>
                                        @error('txtDob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Giới Tính</label>
                                        <div class="form-check">
                                            <input id="male" type="radio" class="form-check-input" name="txtGender" value="male"  autocomplete="number" required>
                                            <label class="form-check-label " for="male">
                                                Male
                                            </label>
                                            <input id="female" type="radio" class="form-check-input ml-4" name="txtGender" value="Female"  autocomplete="number" required>
                                            <label class="form-check-label ml-5 " for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="pt-1"for="name">Cửa hàng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="type" name = "type" class="form-control select2"  value="{{ old('type') }}" autocomplete="type" style="width: 100%;">
                                                {{--                                                @foreach ($roles as $role)--}}
                                                {{--                                                    <option value="{{$role['id']}}">{{$role['role']}}</option>--}}
                                                {{--                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Chức Vụ</label>
                                        <div class="col-sm-10 p-0 ">
                                            <select id="type" name = "type" class="form-control select2"  value="{{ old('type') }}" autocomplete="type" style="width: 100%;">
                                                {{--                                                @foreach ($roles as $role)--}}
                                                {{--                                                    <option value="{{$role['id']}}">{{$role['role']}}</option>--}}
                                                {{--                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Hợp Đồng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="type" name = "type" class="form-control select2"  value="{{ old('type') }}" autocomplete="type" style="width: 100%;">
                                                {{--                                                @foreach ($roles as $role)--}}
                                                {{--                                                    <option value="{{$role['id']}}">{{$role['role']}}</option>--}}
                                                {{--                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày bắt đầu</label>
                                        <input id="email" type="date" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value=""  autocomplete="number" required>
                                        @error('txtDob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày kết thúc</label>
                                        <input id="email" type="date" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value=""  autocomplete="number" required>
                                        @error('txtDob')
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
        $("#modal-member-project").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
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
        $(document).ready(function(){

            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"{{ route('upload_file_image') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                    }
                })
            });

        });
    </script>
@stop


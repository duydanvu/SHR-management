@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{$store_name}}</h1>
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
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                {{--                @if($role_use_number == 1)--}}
{{--                <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-plus-circle"></i> Create Account </button>--}}
                {{--                <button id = "import_user" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-admin-import-user"><i class="fas fa-plus-circle"></i> Import User </button>--}}
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
                    <th style="width:10%">Họ Tên</th>
                    <th style="width:10%; text-overflow: ellipsis; overflow: hidden;white-space: nowrap">Email</th>
                    <th style="width:10%">Phone</th>
                    <th style="width:10%">DOB</th>
                    <th style="width:10%">Gender</th>
                    <th style="width:10%">Cửa Hàng</th>
                    <th style="width:10%">Ngày bắt đầu</th>
                    <th style="width:10%">Ngày kết thúc</th>
                    <th style="width:5%" class="noSort">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($user) > 0)
                    @foreach($user as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            {{--                            <td><img id="img_prv" src="{{URL::to('/')}}{{$value->url_image}}" style="max-width: 50px;max-height: 50px; width: 50px;height: 50px"></td>--}}
                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                            <td>{{str_replace('@','@ ',$value->email)}}</td>
                            <td>{{str_replace('/','-',$value->phone)}}</td>
                            <td>{{$value->dob}}</td>
                            <td>{{$value->gender}}</td>
                            <td>{{$value->store_name}}</td>
                            <td>{{$value->start_time}}</td>
                            <td>{{$value->end_time}}</td>
                            <td class="text-center">
                                {{--                                @if($role_use_number == 1)--}}
                                <div class="btn-group">
                                    {{--                                        <button type="button" class="btn btn-primary">Action</button>--}}
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="{{route('view_update_user',['id'=>$value->id])}}" data-remote="false"
                                           data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                        <a href="{{route('delete_information_user',['id'=>$value->id])}}"  class="btn dropdown-item">
                                            <i class="fas fa-users"> Delete</i>
                                        </a>
                                        <a href="{{route('view_update_user_detail',['id'=>$value->id])}}" data-remote="false"
                                           data-toggle="modal" data-target="#modal-admin-action-update-detail" class="btn dropdown-item">
                                            <i class="fas fa-info-circle"> View detail</i>
                                        </a>
{{--                                        <a href="{{route('view_update_user_image',['id'=>$value->id])}}" data-remote="false"--}}
{{--                                           data-toggle="modal" data-target="#modal-admin-action-update-image" class="btn dropdown-item">--}}
{{--                                            <i class="fas fa-image"> View Image</i>--}}
{{--                                        </a>--}}
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

    {{-- modal --}}
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
    <div class="modal fade"  id="modal-create-member" >
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
                            <div class="card-body col-lg-6 float-left">
                                <span id="uploaded_image"><img id="img_prv1" src="{{URL::to('/')}}/upload/man.png" style="max-width: 150px;max-height: 200px; width: 150px;height: 200px"></span>
                                <div class="form-group col-8 float-right">
                                    <label for="name">Upload Ảnh</label>
                                    {{--                                    <form id="upload_form" enctype="multipart/form-data" method="post">--}}
                                    <meta name="csrf-token1" content="{{ csrf_token() }}">
                                    <input id="select_file" type="file" name="select_file" required="true" class="pb-3">
                                    {{--                                        <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload Image">--}}
                                    {{--                                    </form>--}}
                                    <span id="mgs_ta"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" action="{{route('add_new_user')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div id = "url_image1"></div>
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
                                        <input id="phone" type="number" class="form-control @error('txtPhone') is-invalid @enderror" name="txtPhone" value=""  autocomplete="number" required>
                                        @error('txtPhone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày Sinh</label>
                                        <input id="bod" type="date" class="form-control @error('txtDob') is-invalid @enderror" name="txtDob" value=""  autocomplete="number" required>
                                        @error('txtDob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Chuyên ngành</label>
                                        <input id="line" type="text" class="form-control @error('txtLine') is-invalid @enderror" name="txtLine" value=""  autocomplete="number" required>
                                        @error('txtLine')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Số Hợp Đồng</label>
                                        <input id="NContract" type="text" class="form-control @error('txtNContract') is-invalid @enderror" name="txtNContract" value=""  autocomplete="number" required>
                                        @error('txtNContract')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-body col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Giới Tính</label>
                                        <div class="form-check">
                                            <input id="male" type="radio" class="form-check-input" name="txtGender" value="male"  autocomplete="number" required>
                                            <label class="form-check-label " for="male">
                                                Male
                                            </label>
                                            <input id="female" type="radio" class="form-check-input ml-4" name="txtGender" value="female"  autocomplete="number" required>
                                            <label class="form-check-label ml-5 " for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="pt-1"for="name">Cửa hàng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="store" name = "store" class="form-control select2"  value="{{ old('store') }}" autocomplete="store" style="width: 100%;">
                                                @if(count($store) > 0)
                                                    @foreach ($store as $store)
                                                        <option value="{{$store['store_id']}}">{{$store['store_name']}}-{{$store['store_address']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Chức Vụ</label>
                                        <div class="col-sm-10 p-0 ">
                                            <select id="position" name = "position" class="form-control select2"  value="{{ old('position') }}" autocomplete="position" style="width: 100%;">
                                                @foreach ($position as $position)
                                                    <option value="{{$position['position_id']}}">{{$position['position_name']}}-{{$position['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Hợp Đồng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="contract" name = "contract" class="form-control select2"  value="{{ old('contract') }}" autocomplete="contract" style="width: 100%;">
                                                @foreach ($contract as $contract)
                                                    <option value="{{$contract['contract_id']}}">{{$contract['name']}}-{{$contract['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bộ Phận</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="department" name = "department" class="form-control select2"  value="{{ old('department') }}" autocomplete="department" style="width: 100%;">
                                                @foreach ($department as $department)
                                                    <option value="{{$department['id']}}">{{$department['name']}}-{{$department['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Dịch Vụ</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="service" name = "service" class="form-control select2"  value="{{ old('service') }}" autocomplete="service" style="width: 100%;">
                                                @foreach ($service as $service)
                                                    <option value="{{$service['id']}}">{{$service['name']}}-{{$service['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày bắt đầu</label>
                                        <input id="txtStart" type="date" class="form-control @error('txtStart') is-invalid @enderror" name="txtStart" value=""  autocomplete="number" required>
                                        @error('txtStart')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày kết thúc</label>
                                        <input id="txtEnd" type="date" class="form-control @error('txtEnd') is-invalid @enderror" name="txtEnd" value=""  autocomplete="number" required>
                                        @error('txtEnd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <h3 class="ml-5">Detail</h3>
                                <hr style="width: 90%">
                                <div class="card-body col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Số CMT</label>
                                        <input id="cmt" type="number" class="form-control @error('txtIdentity') is-invalid @enderror" name="txtIdentity" value=""  autocomplete="number" required>
                                        @error('txtIdentity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Mã Số Thuế Cá Nhân</label>
                                        <input id="MST" type="number" class="form-control @error('txtTIN') is-invalid @enderror" name="txtTIN" value=""  autocomplete="number">
                                        @error('txtTIN')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ngày Cấp CMT</label>
                                        <input id="date_CMT" type="date" class="form-control @error('txtIdndate') is-invalid @enderror" name="txtIdndate" value=""  autocomplete="number" required>
                                        @error('txtIdndate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nơi Cấp CMT</label>
                                        <input id="address_CMT" type="text" class="form-control @error('txtIdnAdd') is-invalid @enderror" name="txtIdnAdd" value=""  autocomplete="number" required>
                                        @error('txtIdnAdd')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Chỗ ở hiện tại</label>
                                        <input id="txtAddr_Now" type="text" class="form-control @error('txtAddr_Now') is-invalid @enderror" name="txtAddr_Now" value=""  autocomplete="number" required>
                                        @error('txtAddr_Now')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-body col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Số Bảo Hiểm Xã Hội</label>
                                        <input id="txtSSC" type="number" class="form-control @error('txtNssc') is-invalid @enderror" name="txtNssc" value=""  autocomplete="number" >
                                        @error('txtNssc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nơi Đăng ký Khám chữa bệnh</label>
                                        <input id="txtHospital" type="text" class="form-control @error('txtHospital') is-invalid @enderror" name="txtHospital" value=""  autocomplete="number" >
                                        @error('txtHospital')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Số Tài Khoản Ngân Hàng</label>
                                        <input id="txtBan" type="number" class="form-control @error('txtBan') is-invalid @enderror" name="txtBan" value=""  autocomplete="number" >
                                        @error('txtBan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên Ngân Hàng</label>
                                        <input id="txtBank" type="text" class="form-control @error('txtBank') is-invalid @enderror" name="txtBank" value=""  autocomplete="number" >
                                        @error('txtBank')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nơi đăng ký Hộ Khẩu</label>
                                        <input id="txtAdd_Noi" type="text" class="form-control @error('txtAdd_Noi') is-invalid @enderror" name="txtAdd_Noi" value=""  autocomplete="number" >
                                        @error('txtAdd_Noi')
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
                        <button id="create_member" type="submit" class="btn btn-primary" >Save changers</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
        <div class="modal-dialog col-lg-8" style="max-width: 800px">
            <div class="modal-content col-lg-12 ">
                <div class="modal-header">
                    <h4 class="modal-title">Import User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('import')}}" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card-body col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Giới Tính</label>
                                        <div class="form-check">
                                            <input id="male_import" type="radio" class="form-check-input" name="txtGender" value="male"  autocomplete="number" required>
                                            <label class="form-check-label " for="male">
                                                Male
                                            </label>
                                            <input id="female_import" type="radio" class="form-check-input ml-4" name="txtGender" value="female"  autocomplete="number" required>
                                            <label class="form-check-label ml-5 " for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="pt-1"for="name">Cửa hàng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="store_import" name = "store_import" class="form-control select2"  value="{{ old('store') }}" autocomplete="store_import" style="width: 100%;">
                                                @foreach ($store1 as $store)
                                                    <option value="{{$store['store_id']}}">{{$store['store_name']}}-{{$store['store_address']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Chức Vụ</label>
                                        <div class="col-sm-10 p-0 ">
                                            <select id="position_import" name = "position_import" class="form-control select2"  value="{{ old('position') }}" autocomplete="position_import" style="width: 100%;">
                                                @foreach ($position1 as $position)
                                                    <option value="{{$position['position_id']}}">{{$position['position_name']}}-{{$position['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Hợp Đồng</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="contract_import" name = "contract_import" class="form-control select2"  value="{{ old('contract') }}" autocomplete="contract_import" style="width: 100%;">
                                                @foreach ($contract1 as $contract)
                                                    <option value="{{$contract['contract_id']}}">{{$contract['name']}}-{{$contract['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bộ Phận</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="department_import" name = "department_import" class="form-control select2"  value="{{ old('department') }}" autocomplete="department_import" style="width: 100%;">
                                                @foreach ($department1 as $department)
                                                    <option value="{{$department['id']}}">{{$department['name']}}-{{$department['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Dịch Vụ</label>
                                        <div class="col-sm-10 p-0">
                                            <select id="service_import" name = "service_import" class="form-control select2"  value="{{ old('service') }}" autocomplete="service_import" style="width: 100%;">
                                                @foreach ($service1 as $service)
                                                    <option value="{{$service['id']}}">{{$service['name']}}-{{$service['description']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10 p-0">
                                            <input type="file" name="file" required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="import_member" type="submit" class="btn btn-primary" >Import</button>
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
        $(document).ready(function(){
            $('#fillter_date').click(function () {
                let store_search = $('#store_search').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                var dt = {_token,store_search};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_user_with_store')}}',
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
                    }
                })
            })
        })
    </script>
@stop




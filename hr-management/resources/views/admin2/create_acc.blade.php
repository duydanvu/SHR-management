@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tài Khoản Admin Cấp 2</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home1">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a >Tạo Tài Khoản</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary-dashboard">
        <meta name="csrf-token-2" content="{{ csrf_token() }}">
        <div class="card-header">
            <h3 class="card-title">Tìm Kiếm</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Khu Vực</label>
                        <select id="area_search" name = "area_search" class="form-control select2"  value="{{ old('area_search') }}" autocomplete="area_search" style="width: 100%;">
                            @foreach ($area as $area)
                                <option value="{{$area['id']}}">{{$area['area_name']}}-{{$area['area_description']}}</option>
                            @endforeach
                            <option value="all" selected>All</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 ml-4">
                    <div class="form-group">
                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                        <label for="exampleInputEmail1">Tên Tài Khoản</label>
                        <input id="name_user" type="text" class="form-control @error('txtNameUser') is-invalid @enderror" name="txtFName" value=""  autocomplete="number" required>
                        @error('txtNameUser')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 ml-4 mt-md-2">
                    <button type="submit" id="fillter_date" class="btn btn-primary mt-4" style="float: left"><i class="fas fa-search-minus">Tìm Kiếm</i></button>
                </div>
                <div class="col-md-3 ml-4 mt-md-2 " style="float: left">
                    <button id = "" type="button" class="btn btn-info mt-4" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-plus-circle"></i> Thêm Tài Khoản</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                <label class="ml-3">Danh Sách</label>
                {{--                @if($role_use_number == 1)--}}
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
                    <th style="width:5%" class="noSort">Action</th>
                    {{--                    <th style="width:20%">Image</th>--}}
                    <th style="width:10%">Họ Tên</th>
                    {{--                    <th style="width:10%">Email</th>--}}
                    {{--                    <th style="width:10%">Phone</th>--}}
                    <th style="width:10%">Email</th>
                    {{--                    <th style="width:10%">Gender</th>--}}
                    {{--                    <th style="width:10%">Chuyên Môn</th>--}}
                    <th style="width:10%">Ngày Sinh</th>
                    <th style="width:10%">Số Điện Thoại</th>
                    <th style="width:10%">Người Dùng</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($list_user) > 0)
                    @foreach($list_user as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td class="text-center">
                                        <a href="{{route('search_view_update_user',['id'=>$value->id])}}" data-remote="false"
                                           data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                                <i class="fas fa-edit"> Sửa</i>
                                        </a>
                            </td>
                            <td>{{$value->last_name}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->dob}}</td>
                            <td>{{$value->phone}}</td>
                            @if($value->position_name == 'ASM')
                            <td>{{$value->position_name}}</td>
                            @else
                            <td>UserLV2</td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <td colspan="8" style="text-align: center">
                        <h3>Không có Thông Tin</h3>
                    </td>
                @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{--    --}}{{-- modal --}}
    <div class="modal fade" id="modal-admin-action-update">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_account_user_sts')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--     modal --}}

    {{--    --}}{{-- modal --}}

    {{--     modal --}}
    <div class="modal fade"  id="modal-create-member" >
        <div class="modal-dialog col-lg-8" >
            <div class="modal-content col-lg-12 ">
                <div class="modal-header">
                    <h4 class="modal-title">Tạo Tài Khoản</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('add_new_acc_user')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div id = "url_image1"></div>
                            <div class="col-lg-12 col-sm-12">

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
                                        <label for="name">Tên</label>
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
                                        <label for="name">Người Dùng</label>
                                        <div class="form-check">
                                            <input id="user1" type="radio" class="form-check-input" name="txtAccUser" value="user1"  autocomplete="number" required>
                                            <label class="form-check-label " for="user1">
                                                ASM
                                            </label>
                                            <input id="user2" type="radio" class="form-check-input ml-4" name="txtAccUser" value="user2"  autocomplete="number" required>
                                            <label class="form-check-label ml-5 " for="user2">
                                                Người Dùng Cấp 2
                                            </label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button id="create_member" type="submit" class="btn btn-primary" >Lưu</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
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
                let area_search = $('#area_search').val();
                let name_user = $('#name_user').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                var dt = {_token,area_search,name_user};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_list_acc_with_area_name')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        $('#table_body').html(resultData);
                        // $('#sum_result').html(resultData['sum']);
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


@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Tài khoản người dùng {{\Illuminate\Support\Facades\Auth::user()->last_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home1">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a >Quản lý Sản Phẩm</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
{{--    <div class="card card-outline card-primary-dashboard">--}}
{{--        <meta name="csrf-token-2" content="{{ csrf_token() }}">--}}
{{--        <div class="card-header">--}}
{{--            <h3 class="card-title">Tìm Kiếm</h3>--}}
{{--            <div class="card-tools">--}}
{{--                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
{{--                    <i class="fas fa-minus"></i></button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-3 ml-4">--}}
{{--                    <div class="form-group">--}}
{{--                        <meta name="csrf-token2" content="{{ csrf_token() }}">--}}
{{--                        <label for="exampleInputEmail1">Tên Sản Phẩm</label>--}}
{{--                        <input id="name_user" type="text" class="form-control @error('txtNameUser') is-invalid @enderror" name="txtFName" value=""  autocomplete="number" required>--}}
{{--                        @error('txtNameUser')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-2 ml-4 mt-md-2">--}}
{{--                    <button type="submit" id="fillter_date" class="btn btn-primary mt-4" style="float: left"><i class="fas fa-search-minus">Tìm Kiếm</i></button>--}}
{{--                </div>--}}
{{--                <div class="col-md-2 ml-4 mt-md-2 " style="float: left">--}}
{{--                    <button id = "" type="button" class="btn btn-info mt-4" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-plus-circle"></i> Thêm Sản Phẩm</button>--}}
{{--                </div>--}}
{{--                <div class="col-md-2 ml-2 mt-md-2 " style="float: left">--}}
{{--                    <button id = "" type="button" class="btn btn-info mt-4" data-toggle="modal" data-target="#modal-nhap-san-pham"><i class="fas fa-plus-circle"></i> Nhập Sản Phẩm</button>--}}
{{--                </div>--}}
{{--                <div class="col-md-2 ml-2 mt-md-2 " style="float: left">--}}
{{--                    <button id = "" type="button" class="btn btn-info mt-4" data-toggle="modal" data-target="#modal-tra-san-pham"><i class="fas fa-plus-circle"></i> Trả Sản Phẩm</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
            <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:10%">Tên Sản Phẩm</th>
                    <th style="width:10%">Mã Sản Phẩm</th>
                    <th style="width:10%">Loại Sản Phẩm</th>
{{--                    <th style="width:10%">Giá Nhập</th>--}}
                    <th style="width:10%">Giá Bán</th>
                    <th style="width:10%">Giá Khuyến Mại</th>
                    <th style="width:10%">Hình Thức Hoa Hồng</th>
                    <th style="width:10%">Mức Hoa Hồng</th>
{{--                    <th style="width:10%">Nhà Cung Cấp</th>--}}
{{--                    <th style="width:10%">Loại Hình Hợp Tác</th>--}}
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($product) > 0)
                    @foreach($product as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">{{$value->name}}</a></td>
                            <td>{{$value->product_code}}</td>
                            <td>{{$value->type}}</td>
{{--                            <td>{{number_format($value->price_in)}}</td>--}}
                            <td>{{number_format($value->price_out)}}</td>
                            <td>{{number_format($value->price_sale)}}</td>
                            @if($value->hh_default == null)
                                <td>Tỉ Lệ</td>
                                <td>{{$value->hh_percent}} %</td>
                                @elseif($value->hh_default != null)
                                <td>Mức Cố Định</td>
                                <td>{{number_format($value->hh_default)}}</td>
                            @endif
{{--                            @foreach($supplier as $value_sup)--}}
{{--                                @if($value_sup->id == $value->id_supplier)--}}
{{--                                    <td>{{$value_sup->name}}</td>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                            <td>{{$value->cooperation}}</td>--}}
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
                <form action="{{route('update_product')}}" method="post">
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
        $("#modal-nhap-san-pham").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-tra-san-pham").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });

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

    <script>
        $(document).ready(function () {
            @foreach($product as $value)
            console.log('{{$value->name}}')
            @endforeach
        })
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



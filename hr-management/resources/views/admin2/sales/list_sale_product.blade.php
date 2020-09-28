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
                    <li class="breadcrumb-item "><a >Quản lý Khuyến Mại</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                <label class="ml-3">Danh Sách</label>
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
                    <th style="width:5%" class="noSort">Action</th>
                    <th style="width:5%" >Tên Khuyến Mại</th>
                    <th style="width:5%" >Tên Sản Phẩm</th>
                    <th style="width:10%">Mã Sản Phẩm</th>
                    <th style="width:10%">Quyết Định Tham Chiếu</th>
                    <th style="width:10%">Nhóm</th>
                    <th style="width:10%">Giá Bán</th>
                    <th style="width:10%">Hình Thức Khuyến Mại</th>
                    <th style="width:10%">Giá trị</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($list_sale_product) > 0)
                    @foreach($list_sale_product as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
{{--                                        <a href="{{route('list_product_decentralization_with_group',['id'=> $value->id])}}" data-remote="false" class="btn dropdown-item">--}}
{{--                                            <i class="fas fa-edit">Phân Quyền Nhóm</i>--}}
{{--                                        </a>--}}
                                        <a href="{{route('search_sales_product',['id'=>$value->id])}}" data-remote="false"
                                           data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                            <i class="fas fa-edit"> Sửa</i>
                                        </a>
{{--                                        @if($value->status == 'active')--}}
{{--                                            <a href="{{route('update_status_product',['id'=>$value->id])}}"  class="btn dropdown-item">--}}
{{--                                                <i class="fas fa-users"> Tạm Dừng</i>--}}
{{--                                            </a>--}}
{{--                                        @elseif($value->status == 'stop')--}}
{{--                                            <a href="{{route('update_status_product',['id'=>$value->id])}}"  class="btn dropdown-item">--}}
{{--                                                <i class="fas fa-users"> Kích Hoạt</i>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                    </div>

                                </div>
                            </td>
                            </td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->name_product}}</td>
                            <td>{{$value->product_code}}</td>
                            <td>{{$value->qdtc}}</td>
                            <td>{{$value->name_group}}</td>
                            <td>{{$value->sal_price}}</td>
                            @if($value->sale_off == null)
                                <td>Tặng Quà</td>
                                <td>{{$value->name_gifts}}</td>
                            @elseif($value->sale_off != null)
                                <td>Giảm Giá</td>
                                <td>{{$value->sale_off}}</td>
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
        <div class="modal-dialog" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_sale_product')}}" method="post">
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
                    <h4 class="modal-title">Tạo Khuyến Mại</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('add_product')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div id = "url_image1"></div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="col-lg-6 float-left">
                                    <div class="form-group">
                                        <label for="name">Tên Khuyến Mại</label>
                                        <input id="name" type="text" class="form-control @error('txtQdtc') is-invalid
                                                      @enderror" name="txtName" value=""  autocomplete="number" required>
                                        @error('txtQdtc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên Sản Phẩm</label>
                                        <select id="name_product" name = "txtNameProduct" class="form-control select2"
                                                value="{{ old('txtNameProduct') }}" autocomplete="txtNameProduct"
                                                style="width: 100%;">
                                            @foreach ($product as $product)
                                                <option value="{{$product->id}}">{{$product->name}}-{{$product->product_code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Quyết định tham chiếu</label>
                                        <input id="qdtc" type="text" class="form-control @error('txtQdtc') is-invalid
                                                      @enderror" name="txtQdtc" value=""  autocomplete="number" required>
                                        @error('txtQdtc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Giá Bán</label>
                                        <input id="Price" type="number" class="form-control @error('txtPrice') is-invalid @enderror" name="txtPrice" value=""  autocomplete="number" required>
                                        @error('txtPrice')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 float-left">
                                    <div class="form-group">
                                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                                        <label for="exampleInputEmail1">Nhóm Áp Dụng</label>
                                        <select id="group" name = "txtGroup" class="form-control select2"  value="{{ old('txtGroup') }}" autocomplete="txtGroup" style="width: 100%;">
                                            @foreach ($group as $group)
                                                <option value="{{$group->id}}">{{$group->name}}-{{$group->id_group}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Hình Thức Khuyến Mại</label>
                                        <div class="form-check">
                                            <input id="giamgia" type="radio" class="form-check-input" name="txtType" value="giamgia"  autocomplete="number" required>
                                            <label class="form-check-label " for="giamgia">
                                                Giảm Giá
                                            </label>
                                            <input id="tangqua" type="radio" class="form-check-input ml-4" name="txtType" value="tangqua"  autocomplete="number" required>
                                            <label class="form-check-label ml-5 " for="tangqua">
                                                Tặng Quà
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Giá trị khuyến mại</label>
                                        <input id="PriceSale" type="number" class="form-control @error('txtPriceSale') is-invalid @enderror" name="txtPriceSale" value=""  autocomplete="number">
                                        @error('txtPriceSale')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <meta name="csrf-token2" content="{{ csrf_token() }}">
                                        <label for="exampleInputEmail1">Quà Tặng</label>
                                        <select id="gift" name = "txtGift" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                                            @foreach ($gift as $gift)
                                                <option value="{{$gift['id']}}">{{$gift['name']}}-{{$gift['code_gift']}}</option>
                                            @endforeach
                                        </select>
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
    <div class="modal fade"  id="modal-nhap-san-pham" >
        <div class="modal-dialog col-lg-8" >
            <div class="modal-content col-lg-12 ">
                <div class="modal-header">
                    <h4 class="modal-title">Nhập Sản Phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('import_total_product')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button id="create_member" type="submit" class="btn btn-primary" >Nhập</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade"  id="modal-tra-san-pham" >
        <div class="modal-dialog col-lg-8" >
            <div class="modal-content col-lg-12 ">
                <div class="modal-header">
                    <h4 class="modal-title">Trả Sản Phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('export_total_product')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button id="create_member" type="submit" class="btn btn-primary" >Trả</button>
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


@extends('adminlte::page')
@section('title', 'Pool List')


@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tạo Sản Phẩm</h1>
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
    <div class="card card-outline card-primary-dashboard">
        <meta name="csrf-token-2" content="{{ csrf_token() }}">
        <div >
            <div class="col-lg-10 m-auto" >
                <div class="col-md-8 float-left">
                    <form>
                        <div class="modal-body col-md-12">
                            <div class="row">
                                <div class="card-body col-lg-12 float-left">
                                    <span id="uploaded_image"><img id="img_prv1" src="{{URL::to('/')}}/upload/picture-icon-.jpg" style="max-width: 150px;max-height: 200px; width: 150px;height: 200px"></span>
                                    <div class="form-group col-8 float-right">
                                        <label for="name">Tải Ảnh Đại Diện</label>
                                        <form id="upload_form" enctype="multipart/form-data" method="post">
                                            <meta name="csrf-token1" content="{{ csrf_token() }}">
                                            <input id="select_file" type="file" name="select_file" required="true" class="pb-3">
                                        </form>
                                        <span id="mgs_ta"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 float-right">
                    <form action="{{ url('user2/add_more_image') }}" enctype="multipart/form-data" method="POST" style="padding-top: 35px">
                        {{ csrf_field() }}
                        <label for="name">Tải Nhiều Ảnh Chi tiết</label>
                        <input type="file" name="filesTest[]" multiple required="true">
                        <br/>
                        <input type="submit" value="Tải Nhiều Ảnh" style="margin-top: 20px">
                        <br>
                        <span id="mgs_ta_1" style="color: red"> * Cần Nhấn " Tải Nhiều Ảnh " Trước Khi Lưu Sản Phẩm </span>
                    </form>
                </div>
                <div class=" col-lg-12 float-left ">
                    <form class="form-horizontal" action="{{route('add_product')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div id = "url_image1"></div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="col-lg-6 float-left">
                                        <div class="form-group">
                                            <label for="name">Tên Sản Phẩm</label>
                                            <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value=""  autocomplete="number" required>
                                            @error('txtName')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Loại Sản Phẩm</label>
                                            <div class="form-check">
                                                <input id="hanghoa" type="radio" class="form-check-input" name="txtType" value="hanghoa"  autocomplete="number" required>
                                                <label class="form-check-label " for="hanghoa">
                                                    Hàng Hóa
                                                </label>
                                                <input id="dichvu" type="radio" class="form-check-input ml-4" name="txtType" value="dichvu"  autocomplete="number" required>
                                                <label class="form-check-label ml-5 " for="dichvu">
                                                    Dịch Vụ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <meta name="csrf-token2" content="{{ csrf_token() }}">
                                            <label for="exampleInputEmail1">Nhà Cung Cấp</label>
                                            <select id="supplier" name = "txtSupplier" class="form-control select2"  value="{{ old('txtSupplier') }}" autocomplete="txtSupplier" style="width: 100%;">
                                                @foreach ($supplier as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->name}}-{{$supplier->address}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Loại Hình Hợp Tác</label>
                                            <div class="form-check">
                                                <input id="muaban" type="radio" class="form-check-input" name="txtTypeHT" value="muaban"  autocomplete="number" required>
                                                <label class="form-check-label " for="muaban">
                                                    Mua bán
                                                </label>
                                                <input id="kigui" type="radio" class="form-check-input ml-4" name="txtTypeHT" value="kigui"  autocomplete="number" required>
                                                <label class="form-check-label ml-5 " for="kigui">
                                                    Kí Gửi
                                                </label>
                                                <input id="hoptac" type="radio" class="form-check-input ml-4" name="txtTypeHT" value="hoptac"  autocomplete="number" required>
                                                <label class="form-check-label ml-5 " for="hoptac">
                                                    Hợp Tác
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Hợp Đồng Tham Chiếu</label>
                                            <input id="contract" type="text" class="form-control @error('txtContract') is-invalid @enderror" name="txtContract" value=""  autocomplete="number" required>
                                            @error('txtContract')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 float-left">
                                        <div class="form-group">
                                            <label for="name">Giá Nhập</label>
                                            <input id="PriceIn" type="number" class="form-control @error('txtPriceIn') is-invalid @enderror" name="txtPriceIn" value=""  autocomplete="number" required>
                                            @error('txtPriceIn')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Giá bán</label>
                                            <input id="PriceOut" type="number" class="form-control @error('txtPriceIn') is-invalid @enderror" name="txtPriceOut" value=""  autocomplete="number" required>
                                            @error('txtPriceIn')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Giá Khuyến Mại</label>
                                            <input id="PriceSale" type="number" class="form-control @error('txtPriceSale') is-invalid @enderror" name="txtPriceSale" value=""  autocomplete="number" required>
                                            @error('txtPriceSale')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Hình Thức Hoa Hồng</label>
                                            <div class="form-check">
                                                <input id="codinh" type="radio" class="form-check-input" name="txtHH" value="codinh"  autocomplete="number" required>
                                                <label class="form-check-label " for="codinh">
                                                    Mức Cố Định
                                                </label>
                                                <input id="tile" type="radio" class="form-check-input ml-4" name="txtHH" value="tile"  autocomplete="number" required>
                                                <label class="form-check-label ml-5 " for="tile">
                                                    Theo Tỉ lệ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Mức Hoa Hồng</label>
                                            <input id="priceHH" type="number" class="form-control @error('txtPriceHH') is-invalid @enderror" name="txtPriceHH" value=""  autocomplete="number" required>
                                            @error('txtPriceHH')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 float-left">
                                        <div class="form-group">
                                            <label for="name">Chi tiết Sản Phẩm</label>
                                            <textarea name="editor1" id="editor1" rows="10" cols="80">

                                            </textarea>
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
    </div>
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
    <script src="{{asset("../ckeditor/ckeditor.js")}}"></script>
    <script>
        CKEDITOR.replace( 'editor1' );

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
                {{--$.ajax({--}}
                {{--    type:'POST',--}}
                {{--    url:'{{route('search_list_acc_with_area_name')}}',--}}
                {{--    data:dt,--}}
                {{--    success:function(resultData){--}}
                {{--        // // $('.effort').val(resultData);--}}
                {{--        $('#table_body').html(resultData);--}}
                {{--        // $('#sum_result').html(resultData['sum']);--}}
                {{--        // console.log(resultData);--}}
                {{--    }--}}
                {{--});--}}
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



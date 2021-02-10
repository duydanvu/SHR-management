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
                <div class=" col-lg-12 ">
                    <form class="form-horizontal" action="{{route('add_sale_product')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div id = "url_image1"></div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="col-lg-6 float-left">
                                        <div class="form-group">
                                            <label for="name">Tên Khuyến Mại</label>
                                            <input id="name" type="text" class="form-control @error('txtName') is-invalid
                                                      @enderror" name="txtName" value=""  autocomplete="number" required>
                                            @error('txtName')
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
                                        <div class="form-group" id="gia_tri" style="display: none">
                                            <label for="name">Giá trị khuyến mại</label>
                                            <input id="PriceSale" type="number" class="form-control @error('txtPriceSale') is-invalid @enderror" name="txtPriceSale" value=""  autocomplete="number">
                                            @error('txtPriceSale')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" id="gift_1" style="display: none">
                                            <meta name="csrf-token2" content="{{ csrf_token() }}">
                                            <label for="exampleInputEmail1">Quà Tặng 1</label>
                                            <select id="gift_r1" name = "txtGift_r1" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                                                <option value="no_choice" selected>Quà Tặng 1</option>
                                                @foreach ($product_1 as $product_1)
                                                    <option value="{{$product_1->id}}">{{$product_1->name}}-{{$product_1->product_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" id="gift_2" style="display: none">
                                            <meta name="csrf-token2" content="{{ csrf_token() }}">
                                            <label for="exampleInputEmail1">Quà Tặng 2</label>
                                            <select id="gift_r2" name = "txtGift_r2" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                                                <option value="no_choice" selected>Quà Tặng 2</option>
                                                @foreach ($product_2 as $product_2)
                                                    <option value="{{$product_2->id}}">{{$product_2->name}}-{{$product_2->product_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group" id="gift_3" style="display: none">
                                            <meta name="csrf-token2" content="{{ csrf_token() }}">
                                            <label for="exampleInputEmail1">Quà Tặng 3</label>
                                            <select id="gift_r3" name = "txtGift_r3" class="form-control select2"  value="{{ old('txtGift') }}" autocomplete="txtGift" style="width: 100%;">
                                                <option value="no_choice" selected>Quà Tặng 3</option>
                                                @foreach ($product_3 as $product_3)
                                                    <option value="{{$product_3->id}}">{{$product_3->name}}-{{$product_3->product_code}}</option>
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
        $(document).ready(function () {
            $("#giamgia").change(function () {
                document.getElementById("gia_tri").style.display = "block";
                document.getElementById("gift_1").style.display = "none";
                document.getElementById("gift_2").style.display = "none";
                document.getElementById("gift_3").style.display = "none";
            });
            $("#tangqua").change(function () {
                document.getElementById("gia_tri").style.display = "none";
                document.getElementById("gift_1").style.display = "block";
                document.getElementById("gift_2").style.display = "block";
                document.getElementById("gift_3").style.display = "block";
            })
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

@stop




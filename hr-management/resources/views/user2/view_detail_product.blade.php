@extends('adminlte::page')
@section('title', 'dashboard')

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css">
    <style>
        .home_banner_area .banner_inner {
            position: relative;
            width: 100%;
            min-height: 400px;
        }
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .main_title {
            text-align: center;
            max-width: 720px;
            margin: 0px auto 5px;
        }
        .hot_p_item .product_text a {
            position: absolute;
            left: 26px;
            bottom: 28px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 500;
            color: #222222;
            -webkit-transition: all 300ms linear 0s;
            -o-transition: all 300ms linear 0s;
            transition: all 300ms linear 0s;
        }
        .swiper-slide .detail-slide{
            box-sizing: border-box;
            font-size: 20px;
            padding: 200px 20px 20px 20px;
        }
        .swiper-slide .detail-slide h7{
            font-size: 20px;
            text-align: center;
            line-height: 20px;
            color: #bee5eb;
        }

        .owl-carousel .owl-stage-outer {
            position: relative;
            overflow: hidden;
            -webkit-transform: translate3d(0,0,0);
        }
        .product_details {
            width: 100%;
            background: #FFFFFF;
            z-index: 2;
        }
        .details_row {
            margin-top: 5px;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
    </style>
@stop
@section('content')
    <!-- Product Details -->
    @if(session()->has('message_listcode'))
        <div class="alert alert-success">
            <h4>Mã Code mà bạn mua là :</h4>
            @foreach(session()->get('message_listcode') as $values_list_code)
                <p>{{$values_list_code->code}}<p>
            @endforeach
        </div>
    @endif
    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-8 pt-3">
                        <div class="col-xl-8 col-lg-9 col-md-8 float-left " style="max-height: 100%;padding: inherit">
                            <img style="width: 100%"  src="{{$product->link}}" alt="">
                        </div>
                    @if($product->id_link_detail != null)
                        <div class="col-xl-4 col-lg-3 col-md-4 float-left mt-3" >
                            @foreach(explode(',',$product->id_link_detail) as $values_image)
                                @foreach($link_image as $values_image_list)
                                    @if($values_image == $values_image_list->id)
                                    <div class="col-lg-6 col-md-3 col-3" data-image="images/details_1.jpg">
                                        <img src="{{$values_image_list->link_image}}" alt="" style="max-width: 90px;max-height: 90px; padding: 10px"></div>
                                    @endif
                                @endforeach
                            @endforeach
{{--                                    <div class="col-lg-6 col-md-3 col-3" data-image="images/details_2.jpg">--}}
{{--                                        <img src="/upload/product/feature-product/f-p-1.jpg" alt="" style="max-width: 90px;max-height: 90px; padding: 10px"></div>--}}
{{--                                    <div class="col-lg-6 col-md-3 col-3 " data-image="images/details_3.jpg">--}}
{{--                                        <img src="/upload/product/feature-product/f-p-1.jpg" alt="" style="max-width: 90px;max-height: 90px; padding: 10px"></div>--}}
{{--                                    <div class="col-lg-6 col-md-3 col-3 " data-image="images/details_4.jpg">--}}
{{--                                        <img src="/upload/product/feature-product/f-p-1.jpg" alt="" style="max-width: 90px;max-height: 90px; padding: 10px"></div>--}}

                        </div>
                    @endif
                </div>

                <!-- Product Content -->
                <div class="col-xl-6 col-lg-4 col-md-4">
                    <div class="details_content pt-4" style="height: 100%">
                        <div class="details_name pt-2 pl-4" style="font-size: 35px; font-weight: bolder">{{$product->name}}</div>
                        <div class="col-12 m-0 p-0" style="max-height: 100px;float: left">
                            <p class="details_discount col-4 float-left" style="font-size: 20px">Giá Bán </p>
                            <p class="details_discount col-8 pt-3 float-left"
                               style="color: red;text-decoration-line: line-through;font-size: 25px">{{number_format($product->price_out)}} VND</p>
                        </div>
                        <div class="col-12 m-0 p-0" style="max-height: 100px;float: left">
                            <div class="details_price col-4 float-left" style="font-size: 20px">Giá Khuyến Mại</div>
                            <div class="details_price col-8 pt-3 float-left" style="font-size: 25px">{{number_format($product->price_sale)}} VND</div>
                        </div>
                        <!-- In Stock -->
                        <div class="p-review pl-4 pt-4" >
                            <i class="fas fa-star"  style="color: yellow; font-size: 25px"></i>
                            <i class="fas fa-star" style="color: yellow; font-size: 25px"></i>
                            <i class="fas fa-star" style="color: yellow; font-size: 25px"></i>
                            <i class="fas fa-star" style="color: yellow; font-size: 25px"></i>
                            <i class="far fa-star" style="font-size: 25px"></i>
                        </div>
                        <div class="p-review pl-4 pt-3" >
                            <i class="fab fa-facebook-square" style="font-size: 25px" ></i>
                            <i class="fab fa-facebook-messenger" style="font-size: 25px"></i>
                            <i class="fab fa-twitter-square" style="font-size: 25px"></i>
                            <i class="fab fa-twitch" style="font-size: 25px"></i>
                            <i class="fab fa-amazon" style="font-size: 25px"></i>
                        </div>
                        <div class="card_area col-12 pt-2" >
                            <button style="font-size: 20px;background-color: blue;border-radius: 8px;color: white; border: none"
                                    class="main_btn" data-toggle="modal" data-target="#modal-create-store">Bán Sản Phẩm</button>
                        </div>

                        <div class="form-group m-0" >
                            <input id="linkLandPage" type="text" class="form-control @error('txtLinkLandding')
                                is-invalid @enderror" name="txtLinkLandding" value="http://www.example.com/product_1/landdingpage/#bird"  autocomplete="number" required hidden>
                            <button style="font-size: 15px;background-color: #cf5f02;border-radius: 8px;color: white;border: none;
                            margin-left: 17px;margin-top: 10px"
                                    onclick="myFunction()">Sao Chép Đường Dẫn Sản Phẩm</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row pt-3" >
                <div class="col">
                    <div class="description_title_container">
                        <div class="reviews_title"><a href="#" style="font-size: 35px">Chi tiết Sản Phẩm</a></div>
                    </div>
                    <div class="description_text" >
                        <?php echo $product->detail; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
{{--     modal --}}
<div class="modal fade" id="modal-create-store">
    <div class="modal-dialog" style="max-width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bán Sản Phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" @if($product->type_sale == 'code') action="{{route('add_new_sell_product_code')}}"  @else action="{{route('add_new_sell_product')}}" @endif method="post">
                <div class="modal-body" >
                    @csrf
                    <div class="row" >
                        <div class="col-sm-12">
                            <div class="col-sm-6 float-left">
                                <div class="form-group">
                                    <div class="details_image" style="height: 200px;width: 150px">
                                        <div class="details_image_large" style="height: 300px;width: 250px">
                                            <img src="/upload/product/feature-product/f-p-1.jpg" alt="" style="height: 300px;width: 250px">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="details_image" style="height: 100px;width: 100px">
                                        <div class="details_image_large" >
                                            <img src="/upload/qr-code_vinacheck.jpg" alt="" style="height: 100px;width: 100px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 float-left">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên Sản Phẩm</label>
                                        <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value="{{$product->name}}"  autocomplete="number" required readonly>
                                        @error('txtName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Giá Sản Phẩm</label>
                                        <input id="price_product" type="text" class="form-control @error('txtName')
                                            is-invalid @enderror" name="txtPriceProduct" value="{{number_format($product->price_sale)}}"  autocomplete="number" readonly>
                                        <input id="product_id" type="text" class="form-control @error('txtProductID')
                                            is-invalid @enderror" name="txtProductID" value="{{$product->id}}"  autocomplete="number" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Số Lượng </label>
                                        <input id="totalProduct" type="number" class="form-control @error('txtAddress') is-invalid @enderror" name="totalProduct" value="1"  autocomplete="number" required>
                                        @error('txtAddress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tổng tiền</label>
                                        <input id="tongTien" type="text" class="form-control @error('txtTongTien') is-invalid @enderror" name="txtTongTien" value="{{$product->price_sale}}"  autocomplete="number">
                                        @error('txtTongTien')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email Khách Hàng</label>
                                        <input id="emailGuest" type="text" class="form-control @error('txtEmailGuest')
                                            is-invalid @enderror" name="txtEmailGuest" value=""  autocomplete="number" required>
                                        @error('txtEmailGuest')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Số Điện Thoại Khách Hàng</label>
                                        <input id="phoneGuest" type="text" class="form-control @error('txtPhoneGuest')
                                            is-invalid @enderror" name="txtPhoneGuest" value=""  autocomplete="number" required>
                                        @error('txtPhoneGuest')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    @if($product->type_sale == 'code')
                        <button id="create_member" type="submit"  class="btn btn-primary">Xác Nhận</button>
                    @else
                        <button id="create_member" type="submit" class="btn btn-primary">Xác Nhận</button>
                    @endif
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--    --}}{{-- modal --}}

{{--    --}}{{-- modal --}}
<div class="modal fade" id="modal-sell-product-code">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin Mã Code Sản Phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="" method="post">
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
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
    <script>
        $("#modal-sell-product-code").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
    </script>
    <script>
        $(function () {
            $("#totalProduct").keyup( function () {
                let price = $("#price_product").val();
                let total = $("#totalProduct").val();
                $("#tongTien").val(price*total);
                console.log(price*total);
            });
        });
    </script>
    <script>
        function myFunction() {
            var copyText = document.getElementById("linkLandPage");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            alert("Sao chép đường dẫn : "+ copyText.value +" - thành công . ");
        }
    </script>
@stop


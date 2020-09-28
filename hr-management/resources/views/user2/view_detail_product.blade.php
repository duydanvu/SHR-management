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

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <div class="details_image" style="height: 100%">
                        <div class="details_image_large" style="height: 100%">
                            <img src="/upload/product/feature-product/f-p-1.jpg" alt="">
                    </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name pt-2" style="font-size: 25px">{{$product->name}}</div>
                        <div class="details_discount" style="color: red;text-decoration-line: line-through">{{$product->price_out}} VND</div>
                        <div class="details_price">{{$product->price_sale}} VND</div>

                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Chi tiết Sản Phẩm:</div>
                        </div>
                        <div class="details_text">
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse platea dictumst. Suspendisse ultrices mauris diam. Nullam sed aliquet elit. Mauris consequat nisi ut mauris efficitur lacinia.</p>
                        </div>

                        <div class="card_area">
                            <button class="main_btn" data-toggle="modal" data-target="#modal-create-store">Bán Sản Phẩm</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                    </div>
                    <div class="description_text">
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse platea dictumst. Suspendisse ultrices mauris diam. Nullam sed aliquet elit. Mauris consequat nisi ut mauris efficitur lacinia.</p>
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
            <form class="form-horizontal" action="{{route('add_new_sell_product')}}" method="post">
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
                                        <input id="price_product" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtPriceProduct" value="{{$product->price_sale}}"  autocomplete="number" readonly>
                                        <input id="product_id" type="text" class="form-control @error('txtProductID') is-invalid @enderror" name="txtProductID" value="{{$product->id}}"  autocomplete="number" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Số Lượng </label>
                                        <input id="totalProduct" type="number" class="form-control @error('txtAddress') is-invalid @enderror" name="totalProduct" value="0"  autocomplete="number" required>
                                        @error('txtAddress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Đường Dẫn Sản Phẩm</label>
                                        <input id="linkLandPage" type="text" class="form-control @error('txtLinkLandding')
                                            is-invalid @enderror" name="txtLinkLandding" value="http://www.example.com/product_1/landdingpage/#bird"  autocomplete="number" required readonly>
                                        @error('txtLinkLandding')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <button onclick="myFunction()">Sao Chép Đường Dẫn</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tổng tiền</label>
                                        <input id="tongTien" type="text" class="form-control @error('txtTongTien') is-invalid @enderror" name="txtTongTien" value=""  autocomplete="number">
                                        @error('txtTongTien')
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
                    <button id="create_member" type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--    --}}{{-- modal --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>

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
            alert("Sao chép đường dẫn thành công .");
        }
    </script>
@stop


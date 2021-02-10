@extends('adminlte::page')
@section('title', 'dashboard')

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/linericon/style.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendor/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../vendor/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../vendor/animate-css/animate.css">
    <link rel="stylesheet" href="../vendor/jquery-ui/jquery-ui.css">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
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
    </style>
@stop
@section('content')
    <h2 style="text-align: center">Danh Sách Sản Phẩm</h2>
    <!--================Category Product Area =================-->
    <section class="cat_product_area p_40">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="product_top_bar">
                    </div>
                    <div class="latest_product_inner row">
                            @foreach($product as $value)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="f_p_item">
                                <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="../upload/product/feature-product/f-p-5.jpg" alt="">
                                    <div class="p_icon">
                                        <a href="#"><i class="lnr lnr-heart"></i></a>
                                    </div>
                                </div>
                                </a>
                                <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}"><h4>{{$value->name}}</h4></a>
                                <h5 style="text-decoration-line: line-through">{{$value->price_out}}<sup>VND</sup></h5>
                                <h5>{{$value->price_sale}}<sup>VND</sup></h5>
                            </div>
                        </div>
                            @endforeach
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="../upload/product/feature-product/f-p-2.jpg" alt="">
                                    <div class="p_icon">
                                        <a href="#"><i class="lnr lnr-heart"></i></a>
                                        <a href="#"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </div>
                                <a href="#"><h4>Long Sleeve TShirt</h4></a>
                                <h5>$150.00</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="../upload/product/feature-product/f-p-3.jpg" alt="">
                                    <div class="p_icon">
                                        <a href="#"><i class="lnr lnr-heart"></i></a>
                                        <a href="#"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </div>
                                <a href="#"><h4>Long Sleeve TShirt</h4></a>
                                <h5>$150.00</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="../upload/product/feature-product/f-p-4.jpg" alt="">
                                    <div class="p_icon">
                                        <a href="#"><i class="lnr lnr-heart"></i></a>
                                        <a href="#"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </div>
                                <a href="#"><h4>Long Sleeve TShirt</h4></a>
                                <h5>$150.00</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img class="img-fluid" src="../upload/product/feature-product/f-p-5.jpg" alt="">
                                    <div class="p_icon">
                                        <a href="#"><i class="lnr lnr-heart"></i></a>
                                        <a href="#"><i class="lnr lnr-cart"></i></a>
                                    </div>
                                </div>
                                <a href="#"><h4>Long Sleeve TShirt</h4></a>
                                <h5>$150.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets cat_widgets">
                            <div class="l_w_title">
                                <h3>Nhà Cung Cấp</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach($supplier as $values)
                                    <li><a href="#">{{$values->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Product Chi Tiết Sản Phẩm</h3>
                            </div>
                            <div class="widgets_inner">
                                <h4>Màu Sắc</h4>
                                <ul class="list">
                                    <li><a href="#">Đen</a></li>
                                    <li><a href="#">Xanh</a></li>
                                    <li class="active"><a href="#">Vàng</a></li>
                                </ul>
                            </div>
{{--                            <div class="widgets_inner">--}}
{{--                                <h4>Price</h4>--}}
{{--                                <div class="range_item">--}}
{{--                                    <div id="slider-range"></div>--}}
{{--                                    <div class="row m0">--}}
{{--                                        <label for="amount">Price : </label>--}}
{{--                                        <input type="text" id="amount" >--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

        <!--================Most Product Area =================-->
        <section class="most_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="main_title">
                        <h2>Sản Phẩm Được Tìm Kiếm Nhiều Nhất</h2>
                    </div>
                    <div class="row most_product_inner">
                        <div class="col-lg-3 col-sm-6">
                            <div class="most_p_list">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-1.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-2.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-3.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="most_p_list">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-4.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-5.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-6.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="most_p_list">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-7.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-8.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-9.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="most_p_list">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-10.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-11.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="../upload/product/most-product/m-product-12.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <a href="#"><h4>Black lace Heels</h4></a>
                                        <h3>$189.00</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Most Product Area =================-->
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/stellar.js"></script>
    <script src="../vendor/lightbox/simpleLightbox.min.js"></script>
    <script src="../vendor/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../vendor/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../vendor/isotope/isotope-min.js"></script>
    <script src="../vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="../js/jquery.ajaxchimp.min.js"></script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/flipclock/timer.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.js"></script>
    <script src="../js/mail-script.js"></script>
    <script src="../js/theme.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: ['noSort'],

                    } // Disable sorting on columns marked as so
                ],
                "oLanguage": {
                    "sSearch": "Tìm Kiếm",
                    "sLengthMenu": "Hiển Thị _MENU_ Bản Ghi",
                },
                "language": {
                    "info": "Đang hiển thị _START_ tới _END_ trong _TOTAL_ kết quả",
                }
            });
            // fix table
            $("#example1").parent().css({"overflow": "auto"});
        });
    </script>
@stop

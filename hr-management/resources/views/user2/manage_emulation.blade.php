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
    <!-- Info boxes -->
    <section class="home_banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content row " style="padding-top: 10px">
                    <div class="col-lg-5">
                        <h3>{{$emulation_new->name}}<br />Mới!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                        <a class="white_bg_btn" href="{{route('view_list_emulation_detail',['id'=>$emulation_new->id])}}">Xem Chi tiết</a>
                    </div>
                    <div class="col-lg-7">
                        <div class="halemet_img">
                            <img src="../upload/banner/helmat.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Feature Product Area =================-->
    <section class="feature_product_area">
        <div class="main_box">
            <div class="container">
                <div class="row hot_product_inner">
                    @foreach($list_emulation as $key=> $value)
                    <div class="col-lg-6 mt-3">
                        <div class="hot_p_item">
                            <img class="img-fluid" src="../upload/product/hot-product/hot-p-1.jpg" alt="">
                            <div class="product_text">
                                <h4> {{$value->name}}<br />QDTC : {{$value->qdtc}}</h4>
                                <a href="{{route('view_list_emulation_detail',['id'=>$value->id])}}">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="hot_p_item">--}}
{{--                            <img class="img-fluid" src="../upload/product/hot-product/hot-p-2.jpg" alt="">--}}
{{--                            <div class="product_text">--}}
{{--                                <h4>Ưu Đãi Hấp Dẫn<br />Trong Tháng</h4>--}}
{{--                                <a href="{{route('view_list_product_detail')}}">Xem Ngay</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <!--================End Feature Product Area =================-->

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


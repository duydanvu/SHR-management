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

    <section class="blog_area single-post-area p_20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="../upload/product/hot-product/hot-p-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    @foreach($list_product as $value)
                                        <a href="#">{{$value->name}}</a>
                                    @endforeach
                                </div>
                                <ul class="blog_meta list">
                                    <li><a href="#">{{$emulation_detail->qdtc}}<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="#">1.2M Views<i class="lnr lnr-eye"></i></a></li>
                                    <li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>
                                </ul>
                                <ul class="social-links">
                                    <li><a href="#"><i class="far fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="far fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="far fa-github"></i></a></li>
                                    <li><a href="#"><i class="far fa-behance"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{$emulation_detail->name}}</h2>
                            <p class="excert">
                                Chi tiết về chương trình thi đua : MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.
                            </p>
                            <p>
                                Boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training. who has the willpower to actually sit through a self-imposed
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <div class="quotes">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower to actually sit through a self-imposed MCSE training.
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <img class="img-fluid" src="../upload/product/hot-product/hot-p-1.jpg" alt="">
                                </div>
                                <div class="col-6">
                                    <img class="img-fluid" src="../upload/product/hot-product/hot-p-1.jpg" alt="">
                                </div>
                                <div class="col-lg-12 mt-25">
                                    <p>
                                        MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower.
                                    </p>
                                    <p>
                                        MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction of the camp price. However, who has the willpower.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Danh Sách Thi Đua</h4>
                            <ul class="list cat-list">
{{--                                @foreach($result as $key => $values )--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="d-flex justify-content-between">--}}
{{--                                        <p>@foreach($list_name_user as $values1) @if($values1->id == $key) {{$values1->last_name}} @endif @endforeach</p>--}}
{{--                                        <p>{{$values}}</p>--}}
{{--                                        <p>{{$key}}</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                @endforeach--}}
                            </ul>
                            <div class="br"></div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

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



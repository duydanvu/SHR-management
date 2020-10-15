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
                    @if(count($banner) >= 1 )
                        @foreach($banner as $value_1)
                            <div class="banner_content" style="padding-top: 10px">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <h3>{{$value_1->title}}</h3>
                                        <p> {{$value_1->content}}</p>
                                        <a class="white_bg_btn" href="{{$value_1->link}}">Xem Thông tin</a>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="halemet_img">
                                            <img src="..{{$value_1->image}}" alt="" style="width: 500px;height: 300px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="banner_content" style="padding-top: 10px">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h3>Combo Toán+Tiếng Việt</h3>
                                    <p> Ưu đãi đặc biệt dành tặng đến KH khi mua gói học Online cho các bạn Tiểu học, THCS tại MobiFone Plus.</p>
                                    <a class="white_bg_btn" href="http://hr.mobifoneplus.vn/user2/view_detail_product_user2/14">Xem Thông tin</a>
                                </div>
                                <div class="col-lg-7">
                                    <div class="halemet_img">
                                        <img src="../upload/banner/unnamed.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="banner_content" style="padding-top: 10px">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h3>Combo Toán+Tiếng Việt 2</h3>
                                    <p> Ưu đãi đặc biệt dành tặng đến KH khi mua gói học Online cho các bạn Tiểu học, THCS tại MobiFone Plus.</p>
                                    <a class="white_bg_btn" href="http://hr.mobifoneplus.vn/user2/view_detail_product_user2/14">Xem Thông tin</a>
                                </div>
                                <div class="col-lg-7">
                                    <div class="halemet_img">
                                        <img src="../upload/banner/unnamed.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="banner_content" style="padding-top: 10px">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h3>Combo Toán+Tiếng Việt 3</h3>
                                    <p> Ưu đãi đặc biệt dành tặng đến KH khi mua gói học Online cho các bạn Tiểu học, THCS tại MobiFone Plus.</p>
                                    <a class="white_bg_btn" href="http://hr.mobifoneplus.vn/user2/view_detail_product_user2/14">Xem Thông tin</a>
                                </div>
                                <div class="col-lg-7">
                                    <div class="halemet_img">
                                        <img src="../upload/banner/unnamed.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!--================Feature Product Area =================-->
        <section class="feature_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="row hot_product_inner">
                        <div class="col-lg-6">
                            <a href="{{route('view_list_emulation_detail',['id'=>$emulation->id])}}">
                            <div class="hot_p_item">
                                <img class="img-fluid" src="../upload/product/hot-product/post.jpeg" alt="">
                                <div class="product_text">
                                    <h4>Chương trình thi đua<br />{{$emulation->name}}</h4>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <a>
                                <div class="hot_p_item">
                                    <div class="product_text">
                                        <h4>Thời gian thực hiện <br />{{$emulation->time}}</h4>
                                        <h5 style="padding-left: 25px"><?php echo $emulation->content; ?></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="feature_product_inner">
                        <div class="main_title">
                            <h2>Sản Phẩm Nổi Bật</h2>
                            <p>Sản Phẩm Được Nhiều Nhất .</p>
                        </div>
                        <div class="feature_p_slider owl-carousel">
                            @foreach($product as $value)
                            <div class="item">
                                <div class="f_p_item">
                                    <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="..{{$value->link}}" alt="">
                                        <div class="p_icon">
{{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
                                        </div>
                                    </div>
                                    </a>
                                    <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}"><h4>{{$value->name}}</h4></a>
                                    <h5 style="text-decoration-line: line-through">{{$value->price_out}}<sup>VND</sup></h5>
                                    <h5>{{$value->price_sale}}<sup>VND</sup></h5>
                                </div>
                            </div>
                            @endforeach
{{--                        <div class="feature_p_slider owl-carousel">--}}
{{--                            <div class="row">--}}
{{--                                @foreach($product as $value)--}}
{{--                                <div class="item col-lg-3 col-md-4 col-sm-6 col-12" >--}}
{{--                                    <div class="f_p_item">--}}
{{--                                        <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">--}}
{{--                                        <div class="f_p_img">--}}
{{--                                            <img class="img-fluid" src="../upload/product/feature-product/f-p-1.jpg" alt="">--}}
{{--                                        </div></a>--}}
{{--                                        <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}" style="text-align: center"><h5>{{$value->name}}</h5></a>--}}
{{--                                        <div style="text-align: center"><p><a style="text-decoration-line: line-through">{{$value->price_out}}</a> ~{{$value->price_sale}}</p>--}}
{{--                                           </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Feature Product Area =================-->

        <!--================Latest Product Area =================-->
        <section class="feature_product_area latest_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="feature_product_inner">
                        <div class="main_title">
                            <h2>Sản Phẩm Khuyến Mại </h2>
                            <p>Những sản phẩm mới đang được khuyến mại</p>
                        </div>
                        <div class="latest_product_inner row">
                            @foreach($product_nb as $value)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="f_p_item">
                                        <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">
                                            <div class="f_p_img">
                                                <img class="img-fluid" src="..{{$value->link}}" alt="">
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
                            {{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
                            {{--                                <div class="f_p_item">--}}
                            {{--                                    <div class="f_p_img">--}}
                            {{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-1.jpg" alt="">--}}
                            {{--                                        <div class="p_icon">--}}
                            {{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
                            {{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
                            {{--                                    <h5>$150.00</h5>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
                            {{--                                <div class="f_p_item">--}}
                            {{--                                    <div class="f_p_img">--}}
                            {{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-2.jpg" alt="">--}}
                            {{--                                        <div class="p_icon">--}}
                            {{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
                            {{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
                            {{--                                    <h5>$150.00</h5>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
                            {{--                                <div class="f_p_item">--}}
                            {{--                                    <div class="f_p_img">--}}
                            {{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-3.jpg" alt="">--}}
                            {{--                                        <div class="p_icon">--}}
                            {{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
                            {{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
                            {{--                                    <h5>$150.00</h5>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
                            {{--                                <div class="f_p_item">--}}
                            {{--                                    <div class="f_p_img">--}}
                            {{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-4.jpg" alt="">--}}
                            {{--                                        <div class="p_icon">--}}
                            {{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
                            {{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
                            {{--                                    <h5>$150.00</h5>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest Product Area =================-->

        <!--================Latest Product Area =================-->
        <section class="feature_product_area latest_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="feature_product_inner">
                        <div class="main_title">
                            <h2>Sản Phẩm Mới </h2>
                            <p>Những sản phẩm mới được bán</p>
                        </div>
                        <div class="latest_product_inner row">
                            @foreach($product_new as $value)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="f_p_item">
                                    <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">
                                    <div class="f_p_img">
                                        <img class="img-fluid" src="..{{$value->link}}" alt="">
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
{{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                                <div class="f_p_item">--}}
{{--                                    <div class="f_p_img">--}}
{{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-1.jpg" alt="">--}}
{{--                                        <div class="p_icon">--}}
{{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
{{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
{{--                                    <h5>$150.00</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                                <div class="f_p_item">--}}
{{--                                    <div class="f_p_img">--}}
{{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-2.jpg" alt="">--}}
{{--                                        <div class="p_icon">--}}
{{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
{{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
{{--                                    <h5>$150.00</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                                <div class="f_p_item">--}}
{{--                                    <div class="f_p_img">--}}
{{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-3.jpg" alt="">--}}
{{--                                        <div class="p_icon">--}}
{{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
{{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
{{--                                    <h5>$150.00</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-3 col-md-4 col-sm-6">--}}
{{--                                <div class="f_p_item">--}}
{{--                                    <div class="f_p_img">--}}
{{--                                        <img class="img-fluid" src="../upload/product/feature-product/f-p-4.jpg" alt="">--}}
{{--                                        <div class="p_icon">--}}
{{--                                            <a href="#"><i class="lnr lnr-heart"></i></a>--}}
{{--                                            <a href="#"><i class="lnr lnr-cart"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a href="#"><h4>Long Sleeve TShirt</h4></a>--}}
{{--                                    <h5>$150.00</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Latest Product Area =================-->

        <!--================Most Product Area =================-->
{{--        <section class="most_product_area">--}}
{{--            <div class="main_box">--}}
{{--                <div class="container">--}}
{{--                    <div class="main_title">--}}
{{--                        <h2>Sản Phẩm Được Tìm Kiếm Nhiều Nhất</h2>--}}
{{--                    </div>--}}
{{--                    <div class="row most_product_inner">--}}
{{--                        <div class="col-lg-3 col-sm-6">--}}
{{--                            <div class="most_p_list">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-1.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-2.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-3.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3 col-sm-6">--}}
{{--                            <div class="most_p_list">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-4.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-5.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-6.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3 col-sm-6">--}}
{{--                            <div class="most_p_list">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-7.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-8.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-9.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-3 col-sm-6">--}}
{{--                            <div class="most_p_list">--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-10.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-11.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <img src="../upload/product/most-product/m-product-12.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <a href="#"><h4>Black lace Heels</h4></a>--}}
{{--                                        <h3>$189.00</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
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
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("banner_content");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}
            x[myIndex-1].style.display = "block";
            setTimeout(carousel, 3000); // Change image every 2 seconds
        }
    </script>
@stop

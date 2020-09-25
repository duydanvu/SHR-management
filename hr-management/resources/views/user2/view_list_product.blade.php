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
    </style>
@stop
@section('content')
        <!-- Info boxes -->
        <!--================Feature Product Area =================-->
        <section class="feature_product_area">
            <div class="main_box">
                <div class="container">
                    <div class="row hot_product_inner">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="hot_p_item">
                                <img class="img-fluid" src="../upload/product/hot-product/hot-p-1.jpg" alt="">
                                <div class="product_text" style="position: absolute;left: 0px;top: 0px;height: 100%;">
                                    <a href="#" >Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="hot_p_item">
                                <img class="img-fluid" src="../upload/product/hot-product/hot-p-2.jpg" alt="">
                                <div class="product_text" style="position: absolute;left: 0px;top: 0px;height: 100%;">
                                    <a href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feature_product_inner">
                        <div class="main_title">
                            <h2>Sản Phẩm Nổi Bật</h2>
                            <p></p>
                        </div>
                        <div class="feature_p_slider owl-carousel">
                            <div class="row">
                                @foreach($product as $value)
                                <div class="item col-lg-3 col-md-4 col-sm-6 col-12" >
                                    <div class="f_p_item">
                                        <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}">
                                        <div class="f_p_img">
                                            <img class="img-fluid" src="../upload/product/feature-product/f-p-1.jpg" alt="">
                                        </div></a>
                                        <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}" style="text-align: center"><h5>{{$value->name}}</h5></a>
                                        <div style="text-align: center"><p><a style="text-decoration-line: line-through">{{$value->price_out}}</a> ~{{$value->price_sale}}</p>
                                           </div>
                                    </div>
                                </div>
                                @endforeach
                                    @foreach($product as $value)
                                        <div class="item col-lg-3 col-md-4 col-sm-6 col-12" >
                                            <div class="f_p_item">
                                                <div class="f_p_img">
                                                    <img class="img-fluid" src="../upload/product/feature-product/f-p-1.jpg" alt="">
                                                </div>
                                                <a href="{{route('view_detail_product_user2',['id'=>$value->id])}}" style="text-align: center"><h5>{{$value->name}}</h5></a>
                                                <div style="text-align: center"><p><a style="text-decoration-line: line-through">{{$value->price_out}}</a> ~{{$value->price_sale}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
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

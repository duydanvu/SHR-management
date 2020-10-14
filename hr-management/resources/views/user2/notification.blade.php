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
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Labels</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-danger"></i>
                                    Important
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-warning"></i> Promotions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle text-primary"></i>
                                    Social
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                        <thead>
                        <tr>
                            <h3>Thông báo</h3>
                        </tr>
                        <tbody id="table_body">
                        @if(count($notification) > 0)
                            @foreach($notification as $key => $value)
                                <tr>
                                    <td style="width: 5%"><input type="checkbox" name="noti{{$key}}" value="{{$value->id}}"></td>
                                    <td style="width: 15%">{{$value->name}}</td>
                                    <td style="width: 60%">{{$value->content}}</td>
                                    <td style="width: 20%">{{$value->time}}</td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="8" style="text-align: center">
                                <h3>Không có Thông Tin</h3>
                            </td>
                        @endif

                        </tbody>
                    </table>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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


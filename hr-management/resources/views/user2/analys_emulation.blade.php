@extends('adminlte::page')
@section('title', 'Pool List')

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

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Tài khoản người dùng {{\Illuminate\Support\Facades\Auth::user()->last_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home1">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a >Quản lý Hoàn ứng</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($arr as $key_name=> $value)
                    @if(sizeof($value) > 0)
                <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="col-lg-12">
                                <div class="blog_right_sidebar">
                                    <aside class="single_sidebar_widget post_category_widget">
                                        <h4 class="widget_title">{{$key_name}}</h4>
                                        <ul class="list cat-list">
                                            @php $i = 1 @endphp
                                            @foreach($value as $value_detail)
                                            <li>
                                                <a href="#" class="d-flex "><p></p>
                                                    <p class="col-3" style="float: left">{{$i}}</p>
                                                    <p class="col-3">@foreach($name as $value_name) @if($value_name->id == $value_detail->id_user){{$value_name->last_name}} @endif @endforeach</p>
                                                    <p class="col-3">{{$value_detail->b}}</p>
                                                    <p class="col-3">{{$value_detail->c}}</p>
                                                </a>
                                            </li>
                                                @php $i ++ @endphp
                                            @endforeach
                                        </ul>
                                        <div class="br"></div>
                                    </aside>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                <!-- /.col (RIGHT) -->
            </div>
                @endif
                @endforeach
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script>

        $("#modal-admin-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-image").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });

        $(function () {
            $("#example1").DataTable({
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: ['noSort']
                    } // Disable sorting on columns marked as so
                ]
            });
            // fix table
            $("#example1").parent().css({"overflow": "auto"});
        });

    </script>

    <script>
        $(document).ready(function () {
            $("#area_search").change(function () {
                var area = $("#area_search").val();
                $.ajax({
                    headers:{'X-CSRF-Token':$('meta[name="csrf-token2"]').attr('content')},
                    url:"{{url('admin/user/area_store')}}",
                    type:"POST",
                    data: {
                        area : area
                    },
                    success:function (data) {

                        $('#store_search').empty();
                        $.each(data.stores,function(index,store){
                            // console.log(index);
                            // console.log(store);
                            $('#store_search').append('<option value="'+store.store_id+'">'+store.store_name+'-'+store.store_address+'</option>');
                        })
                    }
                })
            })
        })
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





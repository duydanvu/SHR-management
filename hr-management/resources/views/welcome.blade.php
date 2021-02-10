@extends('adminlte::page')
@section('title', 'dashboard')

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css">
    <style>
        .slide-swiper {
            background: #fff;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper-container {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 300px;
            height: 300px;
        }
        .swiper-slide .detail-slide{
            box-sizing: border-box;
            font-size: 20px;
            padding: 200px 20px 20px 20px;
        }
        .swiper-slide .detail-slide h3{
            font-size: 20px;
            text-align: center;
            line-height: 20px;
            color: #bee5eb;
        }
    </style>
@stop
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark font-weight-bold">Trang Chủ</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                {{--                @if($role_use_number == 1)--}}
{{--                <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-store"><i class="fas fa-plus-circle"></i> Create Area New </button>--}}
                {{--                @endif--}}
                {{--                <a href="{{route('export_report_area')}}" class="btn btn-success" type="button"><i class="fas fa-file-download"></i>Export</a>--}}
                {{--                <button id = "" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-file-download"></i> Export </button>--}}
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:20%">Tên Công Ty</th>
                    <th style="width:15%">Tổng số chi nhánh</th>
                    <th style="width:10%">GDV</th>
                    <th style="width:10%">NVBH</th>
                    <th style="width:10%">NVDT</th>
                    <th style="width:10%">AM</th>
                    <th style="width:10%">KAM</th>
{{--                    <th style="width:10%">Chính Thức</th>--}}
{{--                    <th style="width:10%">Thử Việc</th>--}}
                    <th style="width:10%">Tổng số Nhân Viên</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($area) > 0)
                    @foreach($area as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->name}}</td>
                            <td><a href="{{route('detail_area_of_company',['id'=>$value->id])}}">{{$value->sum}}</a></td>
                            <td><a href="{{route('detail_GDV_of_company',['id'=>$value->id])}}">{{$value->GDV}}</a></td>
                            <td><a href="{{route('detail_NVBH_of_company',['id'=>$value->id])}}">{{$value->NVBH}}</a></td>
                            <td><a href="{{route('detail_NVDT_of_company',['id'=>$value->id])}}">{{$value->NVDT}}</a></td>
                            <td><a href="{{route('detail_AM_of_company',['id'=>$value->id])}}">{{$value->AM}}</a></td>
                            <td><a href="{{route('detail_KAM_of_company',['id'=>$value->id])}}">{{$value->KAM}}</a></td>
{{--                            <td>{{$value->CT}}</td>--}}
{{--                            <td>{{$value->TV}}</td>--}}
                            <td> <a href="{{route('detail_nv_of_company',['id'=>$value->id])}}">{{($value->CT)+($value->TV)}}</a></td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="8" style="text-align: center">
                        <h3>Empty Data</h3>
                    </td>
                @endif

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
{{--    <!-- Info boxes -->--}}
{{--    <div class="row">--}}
{{--        <div class="col-12 slide-swiper">--}}
{{--            <div class="swiper-container">--}}
{{--                <div class="swiper-wrapper">--}}
{{--                    <div class="swiper-slide" style="background-image:url(https://www.nepalitimes.com/wp-content/uploads/2019/08/page-12.jpg)">--}}
{{--                        <div class="detail-slide">--}}
{{--                            <h3>XA XA<br><span>Web Designer</span></h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="swiper-slide" style="background-image:url(https://www.nepalitimes.com/wp-content/uploads/2019/08/page-12.jpg)">--}}
{{--                        <div class="detail-slide">--}}
{{--                            <h3>XA XA<br><span>Web Designer</span></h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="swiper-slide" style="background-image:url(https://www.nepalitimes.com/wp-content/uploads/2019/08/page-12.jpg)">--}}
{{--                        <div class="detail-slide">--}}
{{--                            <h3>XA XA<br><span>Web Designer</span></h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="swiper-slide" style="background-image:url(https://www.nepalitimes.com/wp-content/uploads/2019/08/page-12.jpg)">--}}
{{--                        <div class="detail-slide">--}}
{{--                            <h3>XA XA<br><span>Web Designer</span></h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="swiper-slide" style="background-image:url(https://www.nepalitimes.com/wp-content/uploads/2019/08/page-12.jpg)">--}}
{{--                        <div class="detail-slide">--}}
{{--                            <h3>XA XA<br><span>Web Designer</span></h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="swiper-slide" style="background-image:url(https://www.nepalitimes.com/wp-content/uploads/2019/08/page-12.jpg)">--}}
{{--                        <div class="detail-slide">--}}
{{--                            <h3>XA XA<br><span>Web Designer</span></h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--News Information-->--}}
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <h4>News</h4>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-12 col-sm-6 col-md-6 " >--}}
{{--            <div class="card">--}}
{{--                <div class="card-header bg-info">--}}
{{--                    <h3 class="card-title font-weight-bold">List Store Manager</h3>--}}
{{--                    <div class="card-tools">--}}
{{--                        <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                            <i class="fas fa-minus"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.card-header -->--}}
{{--                <div class="card-body p-0" >--}}
{{--                    <ul class="products-list product-list-in-card pl-2 pr-2">--}}
{{--                        @foreach($poolaction as $key => $value)--}}
{{--                            <li class="item">--}}
{{--                                <div class="product-img" >--}}
{{--                                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Cinque_Terre_.jpg" class="img-circle" alt="Cinque Terre">--}}
{{--                                </div>--}}
{{--                                <div class="product-info">--}}
{{--                                    <span>Staff 1</span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="item">--}}
{{--                                <div class="product-img" >--}}
{{--                                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Cinque_Terre_.jpg" class="img-circle" alt="Cinque Terre">--}}
{{--                                </div>--}}
{{--                                <div class="product-info">--}}
{{--                                    <span>Staff 2</span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="item">--}}
{{--                                <div class="product-img" >--}}
{{--                                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Cinque_Terre_.jpg" class="img-circle" alt="Cinque Terre">--}}
{{--                                </div>--}}
{{--                                <div class="product-info">--}}
{{--                                    <span>Staff 3</span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="item">--}}
{{--                                <div class="product-img" >--}}
{{--                                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Cinque_Terre_.jpg" class="img-circle" alt="Cinque Terre">--}}
{{--                                </div>--}}
{{--                                <div class="product-info">--}}
{{--                                    <span>Staff 4</span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <!-- /.card-body -->--}}
{{--                <div class="card-footer text-center" style="padding: 5px 0">--}}
{{--                    <a href="#" class="uppercase text-dark">View All</a>--}}
{{--                </div>--}}
{{--                <!-- /.card-footer -->--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-12 col-sm-6 col-md-6" >--}}
{{--            <div class="card">--}}
{{--                <div class="card-header bg-cyan">--}}
{{--                    <h3 class="card-title">List Store And Member</h3>--}}
{{--                    <div class="card-tools">--}}
{{--                        <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                            <i class="fas fa-minus"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.card-header -->--}}
{{--                <div class="card-body p-1">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table m-0 table-bordered">--}}
{{--                                <thead >--}}
{{--                                <tr>--}}
{{--                                    <th style="width: 25%">Store</th>--}}
{{--                                    <th style="width: 35%">Address</th>--}}
{{--                                    <th style="width: 20%">New Member</th>--}}
{{--                                    <th style="width: 20%">Total Member</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>Store1</td>--}}
{{--                                        <td>Ha Noi</td>--}}
{{--                                        <td>3</td>--}}
{{--                                        <td>40</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Store2</td>--}}
{{--                                        <td>Hai Phong</td>--}}
{{--                                        <td>5</td>--}}
{{--                                        <td>30</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Store3</td>--}}
{{--                                        <td>Bac Giang</td>--}}
{{--                                        <td>3</td>--}}
{{--                                        <td>20</td>--}}
{{--                                    </tr>--}}
{{--                                @if(count($team) > 0)--}}
{{--                                    @foreach($team as $key => $value)--}}
{{--                                        <tr @if(($value->balance)>0) class="table-success" @elseif(($value->balance) == 0) class="table-warning" @elseif(($value->balance)< 0) class="table-danger" @endif>--}}
{{--                                            <td>{{$value->name}}</td>--}}
{{--                                            <td>{{$value->balance}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @else--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="8" style="text-align: center">--}}
{{--                                            <h3>Empty Pool Action</h3>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endif--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!-- /.table-responsive -->--}}
{{--                    </div>--}}
{{--                <!-- /.card-body -->--}}
{{--                <div class="card-footer text-center" style="padding: 5px 0">--}}
{{--                    <a href="#" class="uppercase text-dark">View All</a>--}}
{{--                </div>--}}
{{--                <!-- /.card-footer -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <h4>Report</h4>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-12 col-sm-6 col-md-6" >--}}
{{--            <div class="card">--}}
{{--                <div class="card-header bg-fuchsia">--}}
{{--                    <h3 class="card-title">Rank Member</h3>--}}
{{--                    <div class="card-tools">--}}
{{--                        <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                            <i class="fas fa-minus"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.card-header -->--}}
{{--                <div class="card-body p-1">--}}
{{--                    <canvas id="canvas" height="350" width="400"></canvas>--}}
{{--                </div>--}}
{{--                <!-- /.card-body -->--}}
{{--                <!-- /.card-footer -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-sm-6 col-md-6" >--}}
{{--            <div class="card">--}}
{{--                <div class="card-header bg-fuchsia">--}}
{{--                    <h3 class="card-title">KPI</h3>--}}
{{--                    <div class="card-tools">--}}
{{--                        <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                            <i class="fas fa-minus"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.card-header -->--}}
{{--                <div class="card-body p-1">--}}
{{--                    <canvas id="kpi-chart" height="350" width="400"></canvas>--}}
{{--                </div>--}}
{{--                <!-- /.card-body -->--}}
{{--                <!-- /.card-footer -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
{{--    <script>--}}
{{--        var mychart = document.getElementById("canvas").getContext("2d");--}}

{{--        new Chart(mychart, {--}}
{{--            type: 'bar',--}}
{{--            data: {--}}
{{--                labels: ["Member1", "Member2", "Member3", "Member4", "Member5"],--}}
{{--                --}}{{--labels: [{% for item in labels %}--}}
{{--                --}}{{--            "{{item}}",--}}
{{--                --}}{{--            {% endfor %}],--}}
{{--                datasets: [{--}}
{{--                    label:"KPI Tháng",--}}
{{--                    data: [13, 20, 60, 40, 80,100],--}}
{{--                    --}}{{--data: [{% for item in values %}--}}
{{--                    --}}{{--    {{item}},--}}
{{--                    --}}{{--    {% endfor %}],--}}
{{--                    backgroundColor: 'rgba(63,25,209,1)',--}}
{{--                    borderColor: 'rgba(63,25,205,6)',--}}
{{--                    pointBackgroundColor: 'rgba(63,255,139,1)'--}}
{{--                }]--}}
{{--        },--}}
{{--        options: {--}}
{{--            scales: {--}}
{{--                yAxes: [{--}}
{{--                    ticks: {--}}
{{--                        beginAtZero: true,--}}
{{--                        stepSize: 10--}}
{{--                    }--}}
{{--                }]--}}
{{--            }--}}
{{--        }--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        var mychart = document.getElementById("kpi-chart").getContext("2d");--}}

{{--        new Chart(mychart, {--}}
{{--            type: 'line',--}}
{{--            data: {--}}
{{--                labels: ["01", "02", "03", "04", "05","06","07","08","09","10","11","12"],--}}
{{--                --}}{{--labels: [{% for item in labels %}--}}
{{--                    --}}{{--            "{{item}}",--}}
{{--                    --}}{{--            {% endfor %}],--}}
{{--                datasets: [{--}}
{{--                    data: [80,85,70,77,60,70,75,80,85,90,95,95],--}}
{{--                    label: "Store1",--}}
{{--                    borderColor: "#3e95cd",--}}
{{--                    fill: false--}}
{{--                }, {--}}
{{--                    data: [60, 65, 70, 77, 80, 80, 75, 70, 85, 80, 75, 85],--}}
{{--                    label: "Store2",--}}
{{--                    borderColor: "#3cba9f",--}}
{{--                    fill: false--}}
{{--                },{--}}
{{--                    data: [70, 75, 70, 67, 60, 70, 75, 80, 75, 80, 85, 75],--}}
{{--                    label: "Store3",--}}
{{--                    borderColor: "#c45850",--}}
{{--                    fill: false--}}
{{--                }]--}}
{{--            },--}}
{{--            options: {--}}
{{--                scales: {--}}
{{--                    yAxes: [{--}}
{{--                        ticks: {--}}
{{--                            beginAtZero: true,--}}
{{--                            stepSize: 10--}}
{{--                        }--}}
{{--                    }]--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
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
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>
@stop

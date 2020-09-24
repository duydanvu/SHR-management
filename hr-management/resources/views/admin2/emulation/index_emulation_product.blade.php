@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tạo Chương trình thi đua</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home1">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a >Quản lý Thi Đua</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary-dashboard">
        <meta name="csrf-token-2" content="{{ csrf_token() }}">
        <div >
            <div class="col-lg-6 m-auto" >
                <div class=" col-lg-12 ">
                    <form class="form-horizontal" action="{{route('add_emulation_product')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div id = "url_image1"></div>
                                <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Tên Chương Trình</label>
                                            <input id="name" type="text" class="form-control @error('txtName') is-invalid
                                                      @enderror" name="txtName" value=""  autocomplete="number" required>
                                            @error('txtName')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Quyết định tham chiếu</label>
                                            <input id="qdtc" type="text" class="form-control @error('txtQdtc') is-invalid
                                                      @enderror" name="txtQdtc" value=""  autocomplete="number" required>
                                            @error('txtQdtc')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Hình Thức Thi Đua</label>
                                            <div class="form-check">
                                                <input id="sanluong" type="radio" class="form-check-input" name="txtType" value="sanluong"  autocomplete="number" required>
                                                <label class="form-check-label " for="sanluong">
                                                    Sản Lượng
                                                </label>
                                                <input id="doanhso" type="radio" class="form-check-input ml-4" name="txtType" value="doanhso"  autocomplete="number" required>
                                                <label class="form-check-label ml-5 " for="doanhso">
                                                    Doanh Số
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <meta name="csrf-token2" content="{{ csrf_token() }}">
                                            <label for="exampleInputEmail1">Giải Thưởng</label>
                                            <select id="reward" name = "txtReward" class="form-control select2"  value="{{ old('txtReward') }}" autocomplete="txtReward" style="width: 100%;">
                                                @foreach ($reward as $reward)
                                                    <option value="{{$reward['id']}}">{{$reward['name']}}-{{$reward['values']}}
                                                        -SL:{{$reward['sl_min']}}-DS:{{$reward['ds_min']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button id="create_member" type="submit" class="btn btn-primary" >Lưu</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        $("#modal-admin-action-update").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-image").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-admin-action-update-detail").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-nhap-san-pham").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $("#modal-tra-san-pham").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });

        $(function () {
            // $("#example1").DataTable({
            //     aoColumnDefs: [
            //         {
            //             bSortable: false,
            //             aTargets: ['noSort']
            //         } // Disable sorting on columns marked as so
            //     ]
            // });
            // fix table
            $("#example1").parent().css({"overflow": "auto"});
        });

    </script>

    <script>
        $(document).ready(function(){
            $('#fillter_date').click(function () {
                let area_search = $('#area_search').val();
                let name_user = $('#name_user').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                var dt = {_token,area_search,name_user};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_list_acc_with_area_name')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        $('#table_body').html(resultData);
                        // $('#sum_result').html(resultData['sum']);
                        // console.log(resultData);
                    }
                });
            });
        });
    </script>

@stop





@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tài Khoản Admin Cấp 2</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home1">Trang Chủ</a></li>
                    <li class="breadcrumb-item "><a href="/admin2/product">Quản lý Sản Phẩm</a></li>
                    <li class="breadcrumb-item "><a >Danh Sách Nhóm</a></li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
                <label class="ml-3">Danh Sách Nhóm</label>
                {{--                @if($role_use_number == 1)--}}
                {{--                @endif--}}
                {{--<a href="{{route('export_to_file_csv')}}" class="btn btn-success btn-xs offset-lg-10" style="float: right;">export</a>--}}
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('add_group_to_sell_product')}}" method="post">
                @csrf
                <input name="id_product" value="{{$id}}_id" hidden>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width:5%">#</th>
                        <th style="width:5%">STT</th>
                        <th style="width:10%">Tên Nhóm</th>
                        <th style="width:10%">Mã Nhóm</th>
                        <th style="width:10%">Thông tin chi tiết</th>
                        <th style="width:10%">Người Quản Lý</th>
                    </tr>
                    </thead>
                    <tbody id="table_body">
                    @if(count($list_group_check) > 0)
                        @foreach($list_group_check as $key => $value)
                            <tr>
                                <td><input type="checkbox" name="group{{$key}}" value="{{$value->id}}"></td>
                                <td>{{$key+1}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->id_group}}</td>
                                <td>{{$value->description}}</td>
                                <td>@foreach(explode("-",$value->name_manager) as $value) <p>{{$value}}</p>@endforeach</td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="8" style="text-align: center">
                            <h3>Không có dữ liệu</h3>
                        </td>
                    @endif
                    </tbody>
                </table>
                <button type="submit" id="addUser2" class="btn btn-primary mt-4" style="float: left"><i class="fas fa-plus-circle"> Thêm</i></button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

    {{--    --}}{{-- modal --}}

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
                let store_search = $('#store_search').val();
                let name_user = $('#name_user').val();
                let position_search = $('#position_search').val();
                let department_search = $('#position_search').val();
                let service_search = $('#service_search').val();
                let contract_search = $('#contract_search').val();
                let start_date = $('#start_date').val();
                let end_date = $('#end_date').val();
                let _token = $('meta[name="csrf-token-2"]').attr('content');
                var dt = {_token,store_search,name_user,position_search,department_search,
                    service_search,contract_search,start_date,end_date};
                console.log(dt);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-2"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'{{route('search_user_with_store')}}',
                    data:dt,
                    success:function(resultData){
                        // // $('.effort').val(resultData);
                        $('#table_body').html(resultData['result']);
                        $('#sum_result').html(resultData['sum']);
                        // console.log(resultData);
                    }
                });
            });
        });
    </script>

@stop





@extends('adminlte::page')
@section('title', 'Pool List')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Services</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item "><a href="/home">Home</a></li>
                    <li class="breadcrumb-item "><a href="#">Admin User</a></li>
                    <li class="breadcrumb-item active">Services</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="button-group-card-header">
{{--                @if($role_use_number == 1)--}}
                    <button id = "" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create-store"><i class="fas fa-plus-circle"></i> Create Account </button>
{{--                @endif--}}
                <button id = "" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create-member"><i class="fas fa-file-download"></i> Export </button>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:10%">Tên Dịch Vụ</th>
                    <th style="width:15%">Thông tin Dịch Vụ</th>
                    <th style="width:15%">Số Nhân Viên</th>
                    <th style="width:5%" class="noSort">Action</th>
                </tr>
                </thead>
                <tbody id="table_body">
                @if(count($service) > 0)
                    @foreach($service as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->description}}</td>
                            <td>---</td>
                            <td class="text-center">
{{--                                @if($role_use_number == 1)--}}
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="{{route('view_update_service',['id'=>$value->id])}}" data-remote="false"
                                               data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                                <i class="fas fa-edit"> Edit</i>
                                            </a>
                                            <a href="{{route('delete_information_service',['id'=>$value->id])}}"  class="btn dropdown-item">
                                                <i class="fas fa-users"> Delete</i>
                                            </a>
                                        </div>

                                    </div>
{{--                                @endif--}}
                            </td>
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

{{--     modal --}}
    <div class="modal fade" id="modal-admin-action-update">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Action</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{route('update_information_service')}}" method="post">
                    <div class="modal-body">
                        @csrf

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

{{--     modal --}}
    <div class="modal fade" id="modal-create-store">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Services</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="{{route('add_new_service')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Tên Dịch Vụ</label>
                                        <input id="name" type="text" class="form-control @error('txtName') is-invalid @enderror" name="txtName" value=""  autocomplete="number" required>
                                        @error('txtName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Thông tin dịch vụ</label>
                                        <input id="fName" type="text" class="form-control @error('txtDescription') is-invalid @enderror" name="txtDescription" value=""  autocomplete="number" required>
                                        @error('txtDescription')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="create_member" type="submit" class="btn btn-primary">Save changers</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
        $("#modal-member-project").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
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
@stop


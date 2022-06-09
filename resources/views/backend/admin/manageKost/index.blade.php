@extends('layouts.admin.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Manage Kost</a>
                </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @include('backend.admin.manageKost.reject')
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>List permohonan konfirmasi kos</h5>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-kost-unconfirm">
                            <thead>
                                <tr>
                                    <th>Nama Kos</th>
                                    <th>Alamat</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>List kos terkonfirmasi</h5>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-kost-confirm">
                            <thead>
                                <tr>
                                    <th>Nama Kos</th>
                                    <th>Alamat</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>List kos ditolak</h5>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-kost-reject">
                            <thead>
                                <tr>
                                    <th>Nama Kos</th>
                                    <th>Alamat</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{!! Form::open(['method'=>'PATCH', 'route' => ['admin.kost.confirm', 0], 'style' =>
'display:none','id'=>'confirm']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'PATCH', 'route' => ['admin.kost.reject', 0], 'style' =>
'display:none','id'=>'reject']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<!-- Page-Level Scripts -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.dataTables-kost-unconfirm').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'excel',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'pdf',
                    title: 'Data Kost Owner'
                },

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            responsive: true,
            searchDelay: 500,
            processing: true,
            aaSorting: [],
            // serverSide: true,
            ajax: {
                url: "{{url('api/kost')}}?data=all&&status=0",
                dataSrc: ''
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'address'
                },
                {
                    data: 'type'
                },
                {
                    data: 'id',
                    responsivePriority: -1
                },
            ],
            columnDefs: [{
                targets: -1,
                title: "Action",
                orderable: false,
                render: function (data, type, full, meta) {
                    var base = "{{url('/')}}";
                    return `` +
                        ` <a class="btn btn-white btn-sm" href="/admin/kost/` +
                        data + `/show-index"><i class="fa fa-folder"></i> View </a>` +

                        ` <a class="btn btn-white btn-sm" href="javascript:void(0)" onclick="confirm(` +
                        data + `
                            )"><i class="fa fa-check"></i> Konfirmasi </a>` +

                        ` <a class="btn btn-white btn-sm" onclick="reject(` +
                        data +
                        `)" href="javascript:void(0)"><i class="fa fa-times"></i> Tolak </a>` +
                        ``;
                },
            }, ],
        });
    });

    $(document).ready(function () {
        $('.dataTables-kost-confirm').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'excel',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'pdf',
                    title: 'Data Kost Owner'
                },

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/kost')}}?data=all&&status=1",
                dataSrc: ''
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'address'
                },
                {
                    data: 'type'
                },
                {
                    data: 'id',
                    responsivePriority: -1
                },
            ],
            columnDefs: [{
                targets: -1,
                title: "Action",
                orderable: false,
                render: function (data, type, full, meta) {
                    var base = "{{url('/')}}";
                    return `` +
                        ` <a class="btn btn-white btn-sm" href="/admin/kost/` +
                        data + `/show-index"><i class="fa fa-folder"></i> View </a>` +
                        ``;
                },
            }, ],
        });
    });

    $(document).ready(function () {
        $('.dataTables-kost-reject').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'excel',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'pdf',
                    title: 'Data Kost Owner'
                },

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            responsive: true,
            searchDelay: 500,
            processing: true,
            // serverSide: true,
            ajax: {
                url: "{{url('api/kost')}}?data=all&&status=2",
                dataSrc: ''
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'address'
                },
                {
                    data: 'type'
                },
                {
                    data: 'id',
                    responsivePriority: -1
                },
            ],
            columnDefs: [{
                targets: -1,
                title: "Action",
                orderable: false,
                render: function (data, type, full, meta) {
                    var base = "{{url('/')}}";
                    return `` +
                        ` <a class="btn btn-white btn-sm" href="/admin/kost/` +
                        data + `/show-index"><i class="fa fa-folder"></i> View </a>` +
                        ``;
                },
            }, ],
        });
    });

    function nl2br(str) {
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    }

    function confirm(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Kos yang telah dikonfirmasi akan dibebaskan untuk beroperasi pada aplikasi ini",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, konfirmasi!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false

                
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Konfirmasi!", "Kos telah dapat beroperasi pada aplikasi ini.", "success");
                    $('#confirm').attr('action', "/admin/kost/" + id + "/confirm");
                    $('#confirm').submit();
                } else {
                    swal("Batal", "Kamu batal melakukan konfirmasi kos", "error");
                }
            });
    }

    function reject(id) {
        $('#reject-kost').toggle();
        $('#kost_id').val(id).change();
    }

</script>
@endsection

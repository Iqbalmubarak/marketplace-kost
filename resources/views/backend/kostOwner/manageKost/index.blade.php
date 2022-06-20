@extends('layouts.kostOwner.main')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Kelola Kos</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Kelola Kos</a>
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <a href="{{ route('owner.kost.create') }}">
                    <button class="btn btn-primary btn-sm btn-outline"
                            type=" button">Tambah Kos</button>
                </a>
            </div>
        </div>

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach ($kosts as $kost)
        <div class="col-lg-4">
            <div class="contact-box" style="min-height:200px">
                <a class="row" @if($kost->status == 2) href="javascript:void(0)" onclick="edit_kost({{$kost->id}})"
                    @else href="{{ route('owner.kost.show', $kost->id) }}" @endif>
                    <div class="col-4">
                        <div class="text-center">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid"
                                src="{{ asset('templates/img/kost.jfif') }}">
                            <div class="m-t-xs font-bold"><strong>{{$kost->name}}</strong></div>
                        </div>
                    </div>
                    <div class="col-8">
                        <address>
                            <abbr title="Pengelola"><i class="fa fa-user"></i></abbr> 
                            <strong>
                            @if ($kost->manager_name != NULL)
                                {{$kost->manager_name}}
                            @else
                                {{$kost->kostOwner->first_name}} {{$kost->kostOwner->last_name}}
                            @endif
                            </strong> <br>  
                            <abbr title="Alamat"><i class="fa fa-map-marker"></i></abbr> {{$kost->address}} <br>
                            <abbr title="Berdiri pada tahun"><i class="fa fa-calendar"></i></abbr> {{$kost->exist}} <br>
                            <abbr title="Nomor pengelola"><i class="fa fa-phone"></i></abbr> @if ($kost->manager_handphone != NULL)
                            {{$kost->manager_handphone}}
                            @else
                            {{$kost->kostOwner->handphone}}
                            @endif
                            <br>
                            <strong>
                                @if ($kost->type->id == 1)
                                <span class="badge badge-success">{{$kost->type->name}}</span>
                                @elseif ($kost->type->id == 2)
                                <span class="badge badge-danger">{{$kost->type->name}}</span>
                                @else
                                <span class="badge badge-warning">{{$kost->type->name}}</span>
                                @endif

                                @if ($kost->status == 0)
                                <span class="badge badge-plain">Menunggu konfirmasi admin</span>
                                @elseif ($kost->status == 1)
                                <span class="badge badge-primary">Aktif</span>
                                @else
                                <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </strong>
                        </address>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

{!! Form::open(['method'=>'GTE', 'route' => ['owner.kost.edit', 0], 'style' =>
'display:none','id'=>'edit_kost']) !!}
{!! Form::close() !!}

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function () {
        $('.dataTables-kost').DataTable({
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
                url: "{{url('api/kost')}}?data=all&&user={{Auth::user()->kostOwner->id}}",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
                },
                {
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
                        ` <a class="btn btn-white btn-sm" href="javascript:void(0)" onclick="edit(` +
                        data + `,'` + full.name + `','` + nl2br(full.address) + `','` + full
                        .type_id + `','` + full.latitude + `','` + full.longitude +
                        `')"><i class="fa fa-pencil"></i> Edit </a>` +

                        ` <a class="btn btn-white btn-sm" onclick="confirm_delete(` + data +
                        `)" href="javascript::void(0)"><i class="fa fa-trash"></i> Delete </a>` +

                        ` <a class="btn btn-white btn-sm" href="{{route('owner.room.index')}}/` +
                        data + `"><i class="fa fa-folder"></i> View </a>` +
                        ``;
                },
            }, ],
        });
    });

    function nl2br(str) {
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
    }

    function confirm_delete(id) {
        swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    $('#deleted_kost').attr('action', "{{route('owner.kost.index')}}/" + id);
                    $('#deleted_kost').submit();
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    }

    function edit(id, name, address, type_id, latitude, longitude) {
        if ($('#edit').is(":visible")) {
            $('#edit').hide('500');
        } else {
            console.log(address);
            $('#edit').show('500');
            $('#e_name').val(name);
            $('#e_address').val(address);
            $('#e_latitude').val(latitude);
            $('#e_longitude').val(longitude);
            $('#e_type').val(type_id).trigger('change');
            $('#form-update').attr('action', "{{route('owner.kost.index')}}/" + id);
        }

        $('#create').hide('500');
    }

    function edit_kost(id) {
        swal({
                title: "Apakah kamu ingin melengkapi data kos?",
                text: "Data kos yang telah dilengkapi akan diajukan lagi untuk dikonfirmasi oleh admin!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, lengkapi!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Lengkapi data!", "Kamu akan dipindahkan ke halaman untuk melengkapi data kos.",
                        "success");
                    location.href = "{{route('owner.kost.index')}}/" + id + "/edit?data=request";
                } else {
                    swal("Dibatalkan", "Kamu batal melengkapi data kos", "error");
                }
            });
    }

</script>
@endsection

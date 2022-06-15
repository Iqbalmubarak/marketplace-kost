@extends('layouts.kostOwner.main')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Kelola Booking</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Kelola Booking</a>
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @include('backend.kostOwner.manageBooking.accept')
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>List Data Booking Kamar</h5>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-booking"
                            id="tbl_booking">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyewa</th>
                                    <th>Nama Kos</th>
                                    <th>Tipe Kamar</th>
                                    <th>Mulai Dari</th>
                                    <th>Berakhir</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
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

{!! Form::open(['method'=>'PATCH', 'route' => ['owner.booking.accept', 0], 'style' =>
'display:none','id'=>'accept']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'PATCH', 'route' => ['owner.booking.reject', 0], 'style' =>
'display:none','id'=>'reject']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(".myselect2").select2({
        placeholder: "Pilih",
        allowClear: true
    });
    $('.myselect2').val(0).change();
    $(document).ready(function () {
        $('.dataTables-booking').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Booking'
                },
                {
                    extend: 'excel',
                    title: 'Data Booking'
                },
                {
                    extend: 'pdf',
                    title: 'Data Booking'
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
                url: "{{url('api/booking')}}?data=owner",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'kost_seeker'
                },
                {
                    data: 'kost'
                },
                {
                    data: 'room_type'
                },
                {
                    data: 'started_at'
                },
                {
                    data: 'ended_at'
                },
                {
                    data: 'status'
                },
                {
                    data: 'total_price'
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
                    if(full.payment == 1){
                        return `` +
                        ` <a class="btn btn-white btn-sm" href="/owner/booking/` +
                        data + `/show"><i class="fa fa-folder"></i> Detail </a>` +

                        ` <a class="btn btn-white btn-sm" onclick="accept(` + data + `,` + full.room_type_id + `)" href="javascript::void(0)" data-toggle="modal" data-target="#acceptModal"><i class="fa fa-check"></i> Terima</a>` +

                        ` <a class="btn btn-white btn-sm" onclick="reject(` +
                        data +
                        `)" href="javascript::void(0)"><i class="fa fa-times"></i> Tolak</a>` +

                        
                        ``;
                    }else{
                        return `` +
                        ` <a class="btn btn-white btn-sm" href="/owner/booking/` +
                        data + `/show"><i class="fa fa-folder"></i> Detail </a>` +
                        '';
                    }
                },
            }, ],
        });

    });

    function reject(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Pemesanan booking kamar ditolak!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Tolak!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Ditolak!", "Pemesanan booking kamar berhasil ditolak", "success");
                    $('#reject').attr('action', "/owner/booking/" + id + "/reject");
                    $('#reject').submit();
                } else {
                    swal("Batal", "Kamu batal melakukan penolakan booking kamar kos", "error");
                }
            });
    }

    function accept(id,room_type) {
        if ($('#accept').is(":visible")) {
            $('#accept').hide('500');
        } else {
            $('#accept').show('500');
            fethDataRoom(room_type);
            $('#form-acc').attr('action', "{{route('owner.booking.index')}}/" + id + "/accept");
        }
    }

    function fethDataRoom(room_type) {
        console.log('success');
        let base_url = "{{URL('api/select/room')}}";
        $("#c_room").select2({
            placeholder: "Select a state",
            allowClear: true,
            language: {
                noResults: function (params) {
                    return "Tidak ada ruangan yang tersedia pada tipe kamar ini";
                }
            },
            tokenSeparators: [',', ' '],
            ajax: {
                url: base_url + "/" + room_type,
                dataType: "json",
                type: "GET",
                quietMillis: 50,
                data: function (params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    }

</script>
@endsection

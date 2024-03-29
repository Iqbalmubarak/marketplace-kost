@extends('layouts.admin.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>List Booking</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
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

@endsection

@section('script')
<script type="text/javascript">
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
                url: "{{url('api/booking')}}?data=all",
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
                    if(full.this_status == 1){
                        return `` +
                        ` <a class="btn btn-white btn-sm" <i class="fa fa-check"></i> Terima</a>` +

                        ` <a class="btn btn-white btn-sm"<i class="fa fa-times"></i> Tolak</a>` +
                        ``;
                    }else{
                        return ``;
                    }
                },
            }, ],
        });

    });

</script>
@endsection


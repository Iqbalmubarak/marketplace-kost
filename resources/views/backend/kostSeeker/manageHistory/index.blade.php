@extends('layouts.kostSeeker.main')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>List Data Penyewaan Kamar</h5>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-rent"
                            id="tbl_rent">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kos</th>
                                    <th>Nama Kamar</th>
                                    <th>Mulai Dari</th>
                                    <th>Berakhir</th>
                                    <th>Status</th>
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
    $('.myselect2').val(0).change();
    $(document).ready(function () {
        $('.dataTables-rent').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Rent'
                },
                {
                    extend: 'excel',
                    title: 'Data Rent'
                },
                {
                    extend: 'pdf',
                    title: 'Data Rent'
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
                url: "{{url('api/history')}}?data=customer",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'kost'
                },
                {
                    data: 'room'
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
                        ` <a class="btn btn-white btn-sm" href="/customer/history/` +
                        data + `"><i class="fa fa-folder"></i> View </a>` +
                        ``;
                },
            }, ],
        });

    });

</script>
@endsection

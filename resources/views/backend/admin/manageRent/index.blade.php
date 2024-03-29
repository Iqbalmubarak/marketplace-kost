@extends('layouts.admin.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Penyewaan Kamar</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>List Penyewaan Kamar</a>
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
                            <h5>List Data Penyewaan Kamar</h5>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-rent" id="tbl_rent">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kos</th>
                                    <th>Kamar</th>
                                    <th>Tipe Kamar</th>
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
        $('.dataTables-rent').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Penyewaan'
                },
                {
                    extend: 'excel',
                    title: 'Data Penyewaan'
                },
                {
                    extend: 'pdf',
                    title: 'Data Penyewaan'
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
                url: "{{url('api/rent')}}?data=all",
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
                    data: 'type'
                },
            ],
        });

    });

</script>
@endsection

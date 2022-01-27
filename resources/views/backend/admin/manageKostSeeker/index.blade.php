@extends('layouts.admin.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Kost Seeker</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Kost Seeker</a>
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
                    <h5>List Kost Seeker</h5>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <a href="{{ route('admin.kost-seeker.create') }}">
                        <button class="btn btn-primary btn-outline" type="button">Add Data</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-kostSeeker" >
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
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

{!! Form::open(['method'=>'DELETE', 'route' => ['admin.kost-seeker.destroy', 0], 'style' => 'display:none','id'=>'deleted_kost_seeker']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'GET', 'route' => ['admin.kost-seeker.edit', 0], 'style' => 'display:none','id'=>'edit_kost_seeker']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
        $('.dataTables-kostSeeker').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv', title: 'Data Kost Owner'},
                {extend: 'excel', title: 'Data Kost Owner'},
                {extend: 'pdf', title: 'Data Kost Owner'},

                {extend: 'print',
                    customize: function (win){
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
                url: "{{url('api/kost-seeker')}}?data=all",
                dataSrc: ''
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'handphone'},
                {data: 'id', responsivePriority: -1},
            ],
            columnDefs: [
                {
                targets: -1,
                title: "Action",
                orderable: false,
                render: function(data, type, full, meta) {
                    var base = "{{url('/')}}";
                    return ``+
                        ` <a class="btn btn-success btn-sm" onclick="edit(`+data+`)" href="javascript::void(0)">Edit</a>`+

                        ` <a class="btn btn-danger btn-sm" onclick="confirm_delete(`+data+`)" href="javascript::void(0)">Delate</a>`+
                        ``;
                },
                },
            ],
        });

    });

    function confirm_delete(id){
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false },
        function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                $('#deleted_kost_seeker').attr('action', "{{route('admin.kost-seeker.index')}}/"+id);
                $('#deleted_kost_seeker').submit();
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    }

    function edit(id){
        $('#edit_kost_seeker').attr('action', "{{route('admin.kost-seeker.index' )}}/"+id+"/edit");
        $('#edit_kost_seeker').submit();
    }

</script>
@endsection
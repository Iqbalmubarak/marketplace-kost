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
                            <a>Kelola Penyewa</a>
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <a href="{{ route('owner.tenant.create') }}">
                    <button class="btn btn-primary btn-sm btn-outline" type=" button">Tambah penyewa</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach ($tenants as $tenant)
        <div class="col-lg-3">
            <div class="contact-box center-version">
                <a href="{{route('owner.tenant.show', $tenant->id)}}">
                    @if ($tenant->avatar != NULL)
                    <img alt="image" src="{{ asset('storage/images/avatar/'.$tenant->avatar) }}" class="rounded-circle" >  
                    @else
                    <?php $random = rand(1,5); ?>
                    <img alt="image" src="{{ asset('templates/img/profile/profil'.$random.'.jpeg') }}" class="rounded-circle" >
                    @endif
                    <h3 class="m-b-xs"><strong>{{$tenant->name}}</strong>
                    @if ($tenant->gender == 1)
                    <span class="badge badge-success">Pria</span>
                    @else
                    <span class="badge badge-warning">Wanita</span>  
                    @endif
                    </h3>
                    <div class="font-bold">{{$tenant->kost->name}}</div>
                    <address class="m-t-md">
                        <strong>
                        @if ($tenant->job == 1)
                        Mahasiswa
                        @elseif ($tenant->job == 2)
                        Karyawan
                        @else
                        Lainnya
                        @endif
                        </strong><br>
                        {{$tenant->job_name}}<br>
                        <abbr title="Phone">Handphone:</abbr> {{$tenant->handphone}}
                    </address>
                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <button class="btn btn-xs btn-white" type="button" onclick="edit({{$tenant->id}})"><i class="fa fa-file"></i> Edit</button>
                        <button class="btn btn-xs btn-white" type="button" onclick="confirm_delete({{$tenant->id}})"><i class="fa fa-trash"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
{!! Form::open(['method'=>'DELETE', 'route' => ['owner.tenant.destroy', 0], 'style' =>
'display:none','id'=>'deleted_tenant']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'GET', 'route' => ['owner.tenant.edit', 0], 'style' => 'display:none','id'=>'edit_tenant']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<script type="text/javascript">

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
                    $('#deleted_tenant').attr('action', "{{route('owner.tenant.index')}}/" + id);
                    $('#deleted_tenant').submit();
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
}

    function edit(id) {
        $('#edit_tenant').attr('action', "{{route('owner.tenant.index' )}}/" + id + "/edit");
        $('#edit_tenant').submit();
    }

</script>
@endsection

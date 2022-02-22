@extends('layouts.kostOwner.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Kelola Kamar</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('owner.kost.index') }}">Kelola Kost</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Kelola Kamar</a>
                </strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">

            <div class="ibox" id="ibox1">
                <div class="ibox-title">
                    <h5>Room List</h5>
                    <div class="ibox-tools">
                        <a href="" class="btn btn-primary btn-xs">Menambah kamar</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                    </div>
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
                        <div class="col-md-11">
                            <div class="input-group"><input type="text" placeholder="Search" class="form-control-sm form-control"> <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                        </div>
                    </div>

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody id="room-list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::open(['method'=>'DELETE', 'route' => ['admin.admin.destroy', 0], 'style' => 'display:none','id'=>'deleted_admin']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'GET', 'route' => ['admin.admin.edit', 0], 'style' => 'display:none','id'=>'edit_admin']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax(
            { url: "{{url('api/room')}}?data=all&&id={{$id}}", 
            dataType: 'json', 
            cache: false, 
            dataSrc: '',

            success: function(data){  
                var name = data.map(function(item) {
                    return item.name;
                }); 
                for(i=0; i<data.length; i++){
                    console.log(name[i]);  
                    var start = '<tr>';
                    var td1 = '<td class="project-status"><span class="label label-primary">Active</span></td>';          
                    var td2 = '<td class="project-title"><a href="project_detail.html">'+name[i]+'</a><br><small>Created 14.08.2014</small></td>'; 
                    var td3 = '<td class="project-completion"><small>Completion with: 48%</small><div class="progress progress-mini"><div style="width: 48%;" class="progress-bar"></div></div></td>'; 
                    var td4 = '<td class="project-people"><a href=""><img alt="image" class="rounded-circle" src="{{ asset("templates/img/profile_small.jpg") }}"></a></td>';
                    var td5 = '<td class="project-actions"><a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a><a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a></td>';
                    var end = '</tr>';
                    $("#room-list").prepend(start, td1, td2, td3, td4, td5, end);     
                }
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
            }
                
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
                $('#deleted_admin').attr('action', "{{route('admin.admin.index')}}/"+id);
                $('#deleted_admin').submit();
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    }

    function edit(id){
        console.log(id);
        $('#edit_admin').attr('action', "{{route('admin.admin.index' )}}/"+id+"/edit");
        $('#edit_admin').submit();
    }


</script>
@endsection
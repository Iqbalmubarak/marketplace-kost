@extends('layouts.kostOwner.main')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('templates/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
    rel="stylesheet">
@endsection
@section('content')
<?php 
    $today = new DateTime("today");
    $ended_at = new DateTime($rent->ended()->ended_at);
    $started_at = new DateTime($rent->started()->started_at);
    $d = $ended_at->diff($today)->days;
    $day = $ended_at->diff($started_at)->days;

    if($ended_at){
        $percent = 100 - ($d/$day * 100);
    }else{
        $percent = 100;
    }
?>
<div class="modal inmodal" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Bukti pembayaran</h4>
            </div>
            <div class="modal-body">
                <img id="modalImg" src="{{ asset('templates/img/input_image.png') }}"
                                                alt="Snow" style="width:100%;max-width:100%">
            </div>
        </div>
    </div>
</div>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Detail Penyewaan kamar</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('owner.rent.index') }}">Penyewaan kamar</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Detail Penyewaan kamar</a>
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                @if ($rent->history)
                <a href="#" onclick="notify({{$rent->id}})">
                    <button class="btn btn-success btn-sm btn-outline" type=" button">Ingatkan perpanjangan sewa</button>
                </a>
                &nbsp;
                @endif
                <a href="{{ route('owner.rent.edit', $rent->id) }}">
                    <button class="btn btn-primary btn-sm btn-outline" type=" button">Ubah Penyewaan</button>
                </a>
                &nbsp;
                <a onclick="confirm_delete({{$rent->id}})" href="javascript::void(0)">
                    <button class="btn btn-danger btn-sm btn-outline" type=" button">Hapus Penyewaan</button>
                </a>
            </div>
        </div>

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    @include('backend.kostOwner.manageRent.createDetail')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a href="javascript:void(0)" onclick="$('#detail-create').toggle(500);$('#detail-edit').hide(500);" class="btn btn-white btn-xs float-right">Perpanjang sewa</a>
                                    <a href="javascript:void(0)" onclick="stopRent({{$rent->id}})" class="btn btn-white btn-xs float-right">Berhenti sewa</a>
                                    <h2>{{$rent->room->roomType->name}} / {{$rent->room->name}} - {{$rent->room->kost->name}}</h2>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Status:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        @if ($rent->status == 1)
                                        <dd class="mb-1"><span class="label label-primary">Aktif</span></dd>
                                        @else
                                        <dd class="mb-1"><span class="label label-danger">Tidak aktif</span></dd>
                                        @endif
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Total transaksi:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1"> {{$rent->rentDetail->count()}}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Total biaya transaksi:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">
                                            <p class="text-navy">
                                                {{Helper::rupiah($rent->rentDetail->sum('total_price'))}}</p>
                                        </dd>
                                    </div>
                                </dl>

                            </div>
                            <div class="col-lg-6" id="cluster_info">

                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Terakhir diperbaharui:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">{{$rent->updated_at}}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Dibuat:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="mb-1">{{$rent->created_at}}</dd>
                                    </div>
                                </dl>
                                <dl class="row mb-0">
                                    <div class="col-sm-4 text-sm-right">
                                        <dt>Participants:</dt>
                                    </div>
                                    <div class="col-sm-8 text-sm-left">
                                        <dd class="project-people mb-1">
                                            @foreach ($rent->tenantDetail as $tenantDetail)
                                            @if ($tenantDetail->tenant->avatar != NULL)
                                            <a href="{{route('owner.tenant.show', $tenantDetail->tenant->id)}}"><img
                                                    alt="member" class="rounded-circle"
                                                    src="{{ asset('storage/images/avatar/'.$tenantDetail->tenant->avatar) }}"
                                                    title="{{$tenantDetail->tenant->name}}"></a>
                                            @else
                                            <?php $random = rand(1,5); ?>
                                            <a href="{{route('owner.tenant.show', $tenantDetail->tenant->id)}}"><img
                                                    alt="member" class="rounded-circle"
                                                    src="{{ asset('templates/img/profile/profil'.$random.'.jpeg') }}"
                                                    title="{{$tenantDetail->tenant->name}}"></a>
                                            @endif
                                            @endforeach
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <dl class="row mb-0">
                                    <div class="col-sm-2 text-sm-right">
                                        <dt>Completed:</dt>
                                    </div>
                                    <div class="col-sm-10 text-sm-left">
                                        <dd>
                                            <div class="progress m-b-1">
                                            @if ($rent->status == 1)
                                                @if ($percent > 70)
                                                    <div style="width: {{$percent}}%;"
                                                        class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated">
                                                    </div>
                                                @elseif ($percent >=100)
                                                    <div style="width: {{$percent}}%;"
                                                        class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated">
                                                    </div>
                                                @else
                                                    <div style="width: {{$percent}}%;"
                                                        class="progress-bar progress-bar-striped progress-bar-animated">
                                                    </div>
                                                @endif
                                            @else
                                                <div style="width: {{$percent}}%;"
                                                    class="progress-bar progress-bar-danger progress-bar-striped">
                                                </div>
                                            @endif
                                                
                                            </div>
                                            <small>Penyewaan kamar yang telah dilalui
                                                <strong><?php echo round($percent,2) ; ?>%</strong>. Tersisa {{$d}}
                                                hari dari total {{$day}} hari sebelum batas waktu penyewaan habis.</small>
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li><a class="nav-link active" href="#tab-1" data-toggle="tab">Aktifitas
                                                        penyewaan</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Status</th>
                                                            <th>Dimulai</th>
                                                            <th>Berakhir</th>
                                                            <th>Total biaya</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rent->rentDetail as $rentDetail)
                                                        <?php 
                                                              $ended_at = new DateTime($rentDetail->ended_at);
                                                          ?>
                                                        <tr>
                                                            <td>
                                                                @if ($rentDetail->status == 1)
                                                                    @if ($today < $ended_at) <span
                                                                    class="label label-primary"><i
                                                                        class="fa fa-check"></i> Berjalan</span>
                                                                    @else
                                                                    <span class="label label-danger"><i
                                                                            class="fa fa-check"></i>
                                                                        Selesai</span>
                                                                    @endif
                                                                @elseif($rentDetail->status == 2)
                                                                <span class="label label-warning"><i
                                                                        class="fa fa-check"></i>
                                                                    Diajukan</span>
                                                                @else
                                                                <span class="label label-danger"><i
                                                                        class="fa fa-check"></i>
                                                                    Ditolak</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{$rentDetail->started_at}}
                                                            </td>
                                                            <td>
                                                                {{$rentDetail->ended_at}}
                                                            </td>
                                                            <td>
                                                                <p class="text-navy">
                                                                    {{Helper::rupiah($rentDetail->total_price)}}</p>
                                                            </td>
                                                            <td>
                                                                @if ($rentDetail->payment != NULL)
                                                                    <div><button class="btn btn-xs btn-white" onclick="showImg(`{{ asset('storage/images/payment/'.$rentDetail->payment) }}`)" id="myImg" data-toggle="modal" data-target="#imageModal"><i class="fa fa-eye"></i> Bukti pembayaran</button></div>
                                                                @endif
                                                                
                                                                @if ($rentDetail->status == 2)
                                                                    <div><button class="btn btn-xs btn-white" onclick="acceptDetail({{$rentDetail->id}})"><i class="fa fa-check"></i> Terima</button></div>
                                                                    <div><button class="btn btn-xs btn-white" onclick="rejectDetail({{$rentDetail->id}})"><i class="fa fa-close"></i> Tolak</button></div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::open(['method'=>'POST', 'route' => ['owner.rent.notify', 0], 'style' =>
'display:none','id'=>'notify']) !!}
{!! Form::close() !!}
{!! Form::open(['method'=>'POST', 'route' => ['owner.rentDetail.accept', 0], 'style' =>
'display:none','id'=>'accept_detail']) !!}
{!! Form::close() !!}
{!! Form::open(['method'=>'POST', 'route' => ['owner.rentDetail.reject', 0], 'style' =>
'display:none','id'=>'reject_detail']) !!}
{!! Form::close() !!}
{!! Form::open(['method'=>'POST', 'route' => ['owner.rent.stopRent', 0], 'style' =>
'display:none','id'=>'stop_rent']) !!}
{!! Form::close() !!}
{!! Form::open(['method'=>'DELETE', 'route' => ['owner.rent.destroy', 0], 'style' =>
'display:none','id'=>'deleted_rent']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
     // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("modalImg");

    function showImg(src){
        console.log(src);
        modalImg.src = src;
    }
    
    $('#c_room').on('select2:select', function (e) {
        let room_type = $('#c_room_type').val();
        if (room_type) {
            fethDataDuration(room_type);
            $('#c_price_list').prop("disabled", false);
        } else {
            $('#c_price_list').prop("disabled", true);
        }
    });

    $('#c_price_list').on('change', function (e) {
        let duration_price = $('#c_price_list').val();
        $('#c_total_price').val(0);
        var total_price = $('#c_total_price').val();
        total_price = parseInt(total_price);

        let base_url = "{{URL('api/select/duration_price')}}";
        $.ajax({
            url: base_url + "/" + duration_price,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var price = data.price;
                total_price = total_price + price;

                for (i = 1; i <= $('.optional-checkbox').length; i++) {
                    if ($('#optional' + i).prop("checked") == true) {
                        var optional = $('#input-checkbox' + i).val();

                        optional = parseInt(optional);
                        total_price = total_price + optional;
                    }
                }

                total_price = String(total_price);
                var convert = convertRupiah(total_price, "Rp. ");
                $('#c_total_price').val(convert);
            }
        });

    });

    function checkOptional() {
        console.log('sudah');
        let duration_price = $('#c_price_list').val();
        $('#c_total_price').val(0);
        var total_price = $('#c_total_price').val();
        total_price = parseInt(total_price);

        let base_url = "{{URL('api/select/duration_price')}}";
        $.ajax({
            url: base_url + "/" + duration_price,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var price = data.price;
                total_price = total_price + price;

                for (i = 0; i < $('.optional-checkbox').length; i++) {
                    if ($('#optional' + i).prop("checked") == true) {
                        var optional = $('#input-checkbox' + i).val();

                        optional = parseInt(optional);
                        total_price = total_price + optional;
                    }
                }

                total_price = String(total_price);
                var convert = convertRupiah(total_price, "Rp. ");
                $('#c_total_price').val(convert);
            }
        });
    }

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = angka.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }
    
    $('.chosen-select').chosen({
        width: "100%"
    });
    $(document).ready(function () {

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function () {
            readURL(this);
        });

        $(".upload-button").on('click', function () {
            $(".file-upload").click();
        });
    });

    function tenantClone() {
        $("#row-tenant")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".row-tenant:last");

        $(".c_tenant:last").attr("data-select2-id", "dsada");
        $(".label-tenant:last").html("");
    }

    function delTenantClone(data) {
        if ($('.row-tenant').length > 1) data.closest('.row-tenant').remove();
    }

</script>
<script>
    function notify(id) {
        swal({
                title: "Apakah kamu ingin mengingatkan penyewa ini?",
                text: "Pesan akan dikirim ke email penyewa!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, terima!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Berhasil!", "Pesan telah terkirim.", "success");
                    $('#notify').attr('action', "{{route('owner.rent.index')}}/"+ id +"/notify");
                    $('#notify').submit();
                } else {
                    swal("Dibatalkan", "Kamu batal mengirim pesan", "error");
                }
            });
    }

    function acceptDetail(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Durasi sewa kamar akan diperpanjang!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, terima!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Diterima!", "Penyewaan kamar berhasil diperpanjang.", "success");
                    $('#accept_detail').attr('action', "{{route('owner.rentDetail.index')}}/"+ id +"/accept");
                    $('#accept_detail').submit();
                } else {
                    swal("Dibatalkan", "Data kamu aman :)", "error");
                }
            });
    }

    function rejectDetail(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Permohonan perpanjangan durasi akan ditolak!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, tolak!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Ditolak!", "Permohonan penyewaan kamar berhasil ditolak.", "success");
                    $('#reject_detail').attr('action', "{{route('owner.rentDetail.index')}}/"+ id +"/reject");
                    $('#reject_detail').submit();
                } else {
                    swal("Dibatalkan", "Data kamu aman :)", "error");
                }
            });
    }

    function stopRent(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Penyewaan kamar akan dihentikan dan tidak dapat diperpanjang lagi!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, berhenti!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Berhasil!", "Penyewaan kamar telah dihentikan.", "success");
                    $('#stop_rent').attr('action', "{{route('owner.rent.index')}}/" + id +"/stop-rent");
                    $('#stop_rent').submit();
                } else {
                    swal("Dibatalkan", "Data kamu aman :)", "error");
                }
            });
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
                    $('#deleted_rent').attr('action', "{{route('owner.rent.index')}}/" + id);
                    $('#deleted_rent').submit();
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    }
</script>
@endsection

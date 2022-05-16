@extends('layouts.landingPage.main')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
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
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">

        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        @include('backend.kostSeeker.manageHistory.createDetail')
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInUp">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="m-b-md">
                                            <a href="javascript:void(0)"
                                                onclick="$('#detail-create').toggle(500);$('#detail-edit').hide(500);"
                                                class="btn-upper btn btn-primary float-right">Perpanjang sewa</a>
                                            <a href="javascript:void(0)" onclick="stopRent({{$rent->id}})"
                                                class="btn-upper btn btn-primary float-right">Berhenti sewa</a>
                                            <h2>{{$rent->room->name}} - {{$rent->room->kost->name}}</h2>
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
                                                <dd class="mb-1"><span class="label label-danger">Tidak aktif</span>
                                                </dd>
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
                                                    <p class="text-navy" style="color:#3EB489;font-weight: bold;">
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
                                                        <strong><?php echo round($percent,2) ; ?>%</strong>. Tersisa
                                                        {{$d}}
                                                        hari dari total {{$day}} hari sebelum batas waktu penyewaan
                                                        habis.</small>
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
                                                        <li><a class="nav-link active" href="#tab-1"
                                                                data-toggle="tab">Aktifitas
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
                                                                        <p class="text-navy"
                                                                            style="color:#3EB489;font-weight: bold;">
                                                                            {{Helper::rupiah($rentDetail->total_price)}}
                                                                        </p>
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
    </div><!-- /.container -->
</div><!-- /.body-content -->

{!! Form::open(['method'=>'POST', 'route' => ['owner.rent.stopRent', 0], 'style' =>
'display:none','id'=>'stop_rent']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js">
    < script src = "{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}" >

</script>
<script>
    function fileValidation() {
        var fileInput = document.getElementById('payment');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').innerHTML = '<img id="image" src="' + e.target.result +
                        '" style="width: 200px; height: 150px;"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    function removeImage() {
        var image = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
        preview.removeChild(image);
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

</script>
<script>
    function confirm_delete(id) {
        swal({
                title: "Apakah kamu yakin?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    swal("Terhapus!", "Data kamu telah terhapus.", "success");
                    $('#deleted_rent').attr('action', "{{route('owner.rent.index')}}/" + id);
                    $('#deleted_rent').submit();
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
                    $('#stop_rent').attr('action', "{{route('customer.rent.index')}}/" + id + "/stop-rent");
                    $('#stop_rent').submit();
                } else {
                    swal("Dibatalkan", "Data kamu aman :)", "error");
                }
            });
    }

</script>
@endsection

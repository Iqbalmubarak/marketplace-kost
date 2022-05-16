@extends('layouts.kostSeeker.main')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('templates/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}"
    rel="stylesheet">
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
<div class="wrapper wrapper-content animated fadeInRight">
    @include('backend.kostSeeker.manageHistory.createDetail')
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
                                                                            class="fa fa-check"></i> Selesai</span>
                                                                    @endif
                                                                @else
                                                                    <span class="label label-warning"><i
                                                                        class="fa fa-check"></i> Diajukan</span>
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
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                            <div class="tab-pane" id="tab-2">

                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Status</th>
                                                            <th>Title</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Comments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Completed</span>
                                                            </td>
                                                            <td>
                                                                Create project in webapp
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    Lorem Ipsum is that it has a more-or-less normal
                                                                    distribution of letters, as opposed to using
                                                                    'Content here, content here', making it look like
                                                                    readable.
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Accepted</span>
                                                            </td>
                                                            <td>
                                                                Various versions
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    Various versions have evolved over the years,
                                                                    sometimes by accident, sometimes on purpose
                                                                    (injected humour and the like).
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Sent</span>
                                                            </td>
                                                            <td>
                                                                There are many variations
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    There are many variations of passages of Lorem Ipsum
                                                                    available, but the majority have suffered alteration
                                                                    in some form, by injected humour, or randomised
                                                                    words which
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Reported</span>
                                                            </td>
                                                            <td>
                                                                Latin words
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    Latin words, combined with a handful of model
                                                                    sentence structures
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Accepted</span>
                                                            </td>
                                                            <td>
                                                                The generated Lorem
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    The generated Lorem Ipsum is therefore always free
                                                                    from repetition, injected humour, or
                                                                    non-characteristic words etc.
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Sent</span>
                                                            </td>
                                                            <td>
                                                                The first line
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    The first line of Lorem Ipsum, "Lorem ipsum dolor
                                                                    sit amet..", comes from a line in section 1.10.32.
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Reported</span>
                                                            </td>
                                                            <td>
                                                                The standard chunk
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    The standard chunk of Lorem Ipsum used since the
                                                                    1500s is reproduced below for those interested.
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Completed</span>
                                                            </td>
                                                            <td>
                                                                Lorem Ipsum is that
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    Lorem Ipsum is that it has a more-or-less normal
                                                                    distribution of letters, as opposed to using
                                                                    'Content here, content here', making it look like
                                                                    readable.
                                                                </p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span class="label label-primary"><i
                                                                        class="fa fa-check"></i> Sent</span>
                                                            </td>
                                                            <td>
                                                                Contrary to popular
                                                            </td>
                                                            <td>
                                                                12.07.2014 10:10:1
                                                            </td>
                                                            <td>
                                                                14.07.2014 10:16:36
                                                            </td>
                                                            <td>
                                                                <p class="small">
                                                                    Contrary to popular belief, Lorem Ipsum is not
                                                                    simply random text. It has roots in a piece of
                                                                    classical
                                                                </p>
                                                            </td>

                                                        </tr>

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
{!! Form::open(['method'=>'DELETE', 'route' => ['owner.rent.destroy', 0], 'style' =>
'display:none','id'=>'deleted_rent']) !!}
{!! Form::close() !!}
{!! Form::open(['method'=>'POST', 'route' => ['owner.rent.stopRent', 0], 'style' =>
'display:none','id'=>'stop_rent']) !!}
{!! Form::close() !!}

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
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
                    $('#stop_rent').attr('action', "{{route('owner.rent.index')}}/" + id +"/stop-rent");
                    $('#stop_rent').submit();
                } else {
                    swal("Dibatalkan", "Data kamu aman :)", "error");
                }
            });
    }
</script>
@endsection

@extends('layouts.landingPage.main')

@section('css')
<link href="{{ asset('templates/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('templates/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="modal inmodal" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Bukti pembayaran</h4>
            </div>
            <div class="modal-body">
                <h3 id="paymentMethod"></h3>
                <img id="modalImg" src="{{ asset('templates/img/input_image.png') }}"
                                                alt="Snow" style="width:100%;max-width:100%">
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal inmodal" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
                <h4 class="modal-title">Pemesanan kamar</h4>
            </div>
            {{ Form::open(array('method'=>'POST', 'url' => route('customer.commerce.payment'), 'files' => true)) }}
            <div class="modal-body">
                <div class="form-group row" id="data_5">
                    <label class="col-lg-12 col-form-label" id="remaining" style="color:red">Waktu yang tersisa untuk melakukan pembayaran</label>
                    <input type="hidden" id="created_at" value="null">
                    <input type="hidden" id="booking_id" name="booking_id">
                </div>
                <div class="form-group row" id="data_5">
                    <label class="col-lg-3 col-form-label">Pilih Metode pembayaran</label>
                    <div class="col-lg-9">
                        <div class="row" id="paymentMethod">
                            
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">No rekening</label>
                    <div class="col-lg-9">
                        <input id="c_rek" name="rek" type="text" placeholder=""
                            class="form-control @error('rek') is-invalid @enderror" readonly> <span
                            class="form-text m-b-none"></span>
                        @error('total_price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row"><label class="col-lg-3 col-form-label">Bukti pembayaran</label>
                    <div class="col-lg-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-block btn-outline btn-primary btn-file"><span
                                    class="fileinput-new">Upload</span>
                                <span class="fileinput-exists">Change</span><input type="file" id="payment"
                                    name="payment" onchange="return fileValidation()"  required/></span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none"
                                onclick="removeImage()">×</a>
                        </div>
                        <div id="imagePreview"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">Riwayat Pemesanan Kamar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <td class="col-md-2 col-sm-6 col-xs-6"><img src="{{ asset('storage/images/room/'.$booking->roomType->firstImage()->image) }}"
                                            alt="image"></td>
                                    <td class="col-md-7 col-sm-6 col-xs-6">
                                        <div class="product-name"><a href="#">{{$booking->roomType->name}}
                                                                &diams;{{$booking->roomType->kost->name}}</a></div>
                                        <div class="description"><i class="fa fa-calendar"
                                                                aria-hidden="true"></i> {{$booking->started_at}} hingga {{$booking->ended_at}}</div>
                                        <div class="price">
                                            {{Helper::rupiah($booking->total_price)}}
                                        </div>
                                        <div class="description">
                                        @if($booking->status == 1)
                                        @if(Carbon\Carbon::now() <= Carbon\Carbon::parse($booking->created_at)->addHour())
                                        <p><span class="label label-warning">Sedang diajukan</span></p>
                                        @else
                                        <p><span class="label label-danger">EXPIRED</span></p>
                                        @endif
                                        @elseif($booking->status == 2)
                                        <p><span class="label label-primary">Diterima</span></p>
                                        @else
                                        <p><span class="label label-danger">Ditolak</span></p>
                                        @endif
                                        </div>
                                    </td>
                                    <td class="col-md-2 ">
                                    @if ($booking->bookingPayment)
                                        <button onclick="showImg(`{{ asset('storage/images/payment/'.$booking->bookingPayment->payment) }}`, '{{$booking->bookingPayment->paymentMethodDetail->paymentMethod->name}} ({{$booking->bookingPayment->paymentMethodDetail->no_rek}})')" id="myImg" class="btn-upper btn btn-primary" data-toggle="modal" data-target="#imageModal">Bukti pembayaran</button>
                                    @else
                                        @if(Carbon\Carbon::now() <= Carbon\Carbon::parse($booking->created_at)->addHour())
                                            <button onclick="payment({{$booking->id}})" id="myImg" class="btn-upper btn btn-primary" data-toggle="modal" data-target="#paymentModal">Lakukan pembayaran</button>
                                        @endif  
                                    @endif
                                    </td>
                                    
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection

@section('script')
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('templates/js/plugins/iCheck/icheck.min.js') }}"></script>
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

     // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("modalImg");

    function showImg(src, name){
        modalImg.src = src;
        console.log(name);
        $('#paymentMethod').text(name);
    }
    // img.onclick = function () {
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    // }

    function payment(id){
        $.ajax({
            url: "{{url('api/payment/booking-payment')}}/"+id,
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                console.log(data[0].count_down);
                $('#paymentMethod').remove();
                for(var i=0; i<data.length; i++){
                    var div = $(`<div class="col-md-3">
                                    <div class="i-checks"><label> <input type="radio"  value="`+data[i].id+`" name="payment_method_detail" required> <i></i> `+data[i].payment_method_name+` </label></div>
                                </div>`);
                    $('#paymentMethod').append(div);
                }
                $('#booking_id').val(id).change();
                $('#created_at').val(data[0].count_down);
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('input[name="payment_method_detail"]').on('ifClicked', function (event) {
                    $.post(
                        "{{url('api/payment/get-paymentMethod')}}", 
                        {
                            "_token": "{{ csrf_token() }}",
                            id: this.value
                        }, 
                        function(result){
                            $('#c_rek').val(result.no_rek).change();
                        }
                    )
                });

        var date = new Date(data[0].count_down).getTime();

        var countDownDate = new Date(date);
        countDownDate = new Date(countDownDate.getFullYear(), countDownDate.getMonth(), countDownDate.getDate(), countDownDate.getHours() + 1, countDownDate.getMinutes(), countDownDate.getSeconds());
        countDownDate.setDate(countDownDate.getDate());
        console.log(countDownDate.getDate())
        console.log(countDownDate.getMinutes() )

        // Hitungan Mundur Waktu Dilakukan Setiap Satu Detik
        var x = setInterval(function() {
        // Mendapatkan Tanggal dan waktu Pada Hari ini
        var now = new Date().getTime();
        //Jarak Waktu Antara Hitungan Mundur
        var distance = countDownDate - now;
        // Perhitungan waktu hari, jam, menit dan detik
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Tampilkan hasilnya di elemen id = "carasingkat"
        document.getElementById("remaining").innerHTML = "Waktu yang tersisa untuk melakukan pembayaran " + hours + "h "
        + minutes + "m " + seconds + "s ";
        // Jika hitungan mundur selesai,
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("remaining").innerHTML = "EXPIRED";
        }
        }, 1000);
                }

            });
        }
</script>
@endsection

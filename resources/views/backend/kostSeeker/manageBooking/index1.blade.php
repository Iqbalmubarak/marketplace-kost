@extends('layouts.kostSeeker.main')

@section('css')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-hsd_bZKO7trRc-pi"></script>
@endsection

@section('content')
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
                                    <th>Nama Kos</th>
                                    <th>Tipe Kamar</th>
                                    <th>Mulai Dari</th>
                                    <th>Berakhir</th>
                                    <th>Total Harga</th>
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

{{ Form::open(array('method'=>'POST', 'url' => route('customer.booking.payment'), 'id' => 'submit_form')) }}
    <input type="hidden" name="json" id="json_callback">
    <input type="hidden" name="booking_id" id="booking_id">
{!! Form::close() !!}
@endsection

@section('script')
<script type="text/javascript">
    $('.myselect2').val(0).change();
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
                url: "{{url('api/booking')}}?data=customer",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
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
                    data: 'total_price'
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
                    if (full.this_status == 2) {
                        return `` +
                            ` <a class="btn btn-white btn-sm" onclick="payment(` + data +
                            `)" href="javascript::void(0)" data-toggle="modal" data-target="#acceptModal"><i class="fa fa-check"></i> Bayar</a>` +
                            ``;
                    } else {
                        return ``;
                    }
                },
            }, ],
        });

    });

    function payment(id) {
        let base_url = "{{URL('api/payment/rent-payment')}}";
        $.ajax({
            url: base_url + "/" + id,
            dataType: 'json',
            cache: false,
            dataSrc: '',
            success: function (data) {
                var snapToken = data;
                console.log(snapToken);
                pay(snapToken, id);
            }
        });
    }

    function pay(snapToken, id){
        window.snap.pay(snapToken, {
            onSuccess: function (result) {
                /* You may add your own implementation here */
                alert("payment success!");
                send_response_to_form(result,id);
            },
            onPending: function (result) {
                /* You may add your own implementation here */
                console.log(result);
                alert("wating your payment!");
                //send_response_to_form(result,id);
            },
            onError: function (result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                send_response_to_form(result,id);
            },
            onClose: function () {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        });
    }

    function send_response_to_form(result,id){
        document.getElementById('json_callback').value = JSON.stringify(result);
        document.getElementById('booking_id').value = id;
        $('#submit_form').submit();
    }

</script>
@endsection

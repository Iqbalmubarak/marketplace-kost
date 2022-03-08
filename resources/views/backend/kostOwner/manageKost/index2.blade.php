@extends('layouts.kostOwner.main')

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Manage Kost</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Google Maps</h5>
            </div>
            <div class="ibox-content">
                <p>
                    Find your kost here
                </p>
                <div class="google-map" id="map" style="height:600px"></div>
            </div>
        </div>
    </div>
</div>

@include('backend.kostOwner.manageKost.edit')

<div class="row wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox " id="ibox1">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-10">
                        <h5>List Kost</h5>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <a href="{{ route('owner.kost.create') }}">
                            <button class="btn btn-primary btn-outline""
                            type="button">Add Data</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-kost">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
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

{!! Form::open(['method'=>'DELETE', 'route' => ['owner.kost.destroy', 0], 'style' =>
'display:none','id'=>'deleted_kost']) !!}
{!! Form::close() !!}

@endsection

@section('script')


<script>
    Dropzone.options.myDropzone = {

        // Prevents Dropzone from uploading dropped files immediately
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilesize: 10,
        maxFiles: 2,
        addRemoveLinks: true,
        acceptedFiles: ".png, .jpg",

        init: function () {
            var submitButton = document.querySelector("#submit-all")
            myDropzone = this; // closure

            submitButton.addEventListener("click", function (e) {
                console.log(myDropzone.processQueue());
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue(); // Tell Dropzone to process all queued files.
            });

            // You might want to show the submit button only when 
            // files are dropped here:
            // this.on("addedfile", function() {
            //   // Show submit button here and/or inform user to click it.
            //   alert("se agrego un archivo");
            // });

            this.on("complete", function (file) {
                myDropzone.removeFile(file);
            });

        }
    };





    function myclone() {
        $("#repet")
            .eq(0)
            .clone()
            .find("input").val("").end() // ***
            .show()
            .insertAfter(".repet:last");
    }

    function delmyclone(data) {
        console.log(data.closest('.repet'));
        if ($('.repet').length > 1) data.closest('.repet').remove();
    }
    $(document).ready(function () {
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex) {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex) {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
            },
            onFinishing: function (event, currentIndex) {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        }).validate({
            errorPlacement: function (error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });

</script>
<script type="text/javascript">
    let mapCreate;
    let markers = [];
    // When the window has finished loading google map
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions1 = {
            zoom: 13,
            center: new google.maps.LatLng(-0.9111111111111111, 100.34972222222221),
            // Style for Google Maps
            styles: [{
                "featureType": "water",
                "stylers": [{
                    "saturation": 43
                }, {
                    "lightness": -11
                }, {
                    "hue": "#0088ff"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [{
                    "hue": "#ff0000"
                }, {
                    "saturation": -100
                }, {
                    "lightness": 99
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#808080"
                }, {
                    "lightness": 54
                }]
            }, {
                "featureType": "landscape.man_made",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ece2d9"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ccdca1"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#767676"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#ffffff"
                }]
            }, {
                "featureType": "poi",
                "stylers": [{
                    "visibility": "off"
                }]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry.fill",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "color": "#b8cb93"
                }]
            }, {
                "featureType": "poi.park",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.sports_complex",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.medical",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi.business",
                "stylers": [{
                    "visibility": "simplified"
                }]
            }]
        };
        // Get all html elements for map
        var mapElement1 = document.getElementById('map');
        var mapElement2 = document.getElementById('map-create');
        var mapElement3 = document.getElementById('map-edit');

        // Create the Google Map using elements
        var map = new google.maps.Map(mapElement1, mapOptions1);
        var mapCreate = new google.maps.Map(mapElement2, mapOptions1);
        var mapEdit = new google.maps.Map(mapElement3, mapOptions1);

        console.log(map);

        $('#map-create').hide();
        $('#map-edit').hide();

        google.maps.event.addListener(mapCreate, 'click', function (e) {
            if (markers.length > 0) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
            }

            $('#c_latitude').val(e.latLng.lat);
            $('#c_longitude').val(e.latLng.lng);

            var marker = new google.maps.Marker({
                position: e["latLng"],
                icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-4.png',
                title: "Hello world!"
            });
            markers.push(marker);
            marker.setMap(mapCreate);
        });

        google.maps.event.addListener(mapEdit, 'click', function (e) {
            if (markers.length > 0) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
            }

            $('#e_latitude').val(e.latLng.lat);
            $('#e_longitude').val(e.latLng.lng);

            var marker = new google.maps.Marker({
                position: e["latLng"],
                icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-4.png',
                title: "Hello world!"
            });
            markers.push(marker);
            marker.setMap(mapEdit);
        });

        // Variabel untuk menyimpan batas kordinat
        bounds = new google.maps.LatLngBounds();

        // Geolokasi / lokasi sendiri
        var infoWindow = new google.maps.InfoWindow({
            map: map
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'Lokasi Anda',
                    icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-6.png',
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });

                marker.addListener('click', toggleBounce);

                function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }
                infoWindow.setPosition(pos);
                infoWindow.setContent('Anda Disini');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
            handleLocationError(false, infoWindow, map.getCenter());
        }

        document
            .getElementById("get-location")
            .addEventListener("click", function () {
                getLocation(mapCreate);
            });

        document
            .getElementById("get-location-edit")
            .addEventListener("click", function () {
                getLocationEdit(mapEdit);
            });

        $.ajax({
            url: "{{url('api/kost/get-location')}}?data=all&&user={{Auth::user()->kostOwner->id}}",
            dataType: 'json',
            cache: false,
            dataSrc: '',

            success: function (data) {
                var latitude = data.map(function (item) {
                    return item.latitude;
                });
                var longitude = data.map(function (item) {
                    return item.longitude;
                });
                for (i = 0; i < data.length; i++) {
                    var pos = {
                        lat: parseFloat(latitude[i]),
                        lng: parseFloat(longitude[i])
                    };
                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Lokasi Anda',
                        icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-3.png',
                        draggable: true,
                        animation: google.maps.Animation.DROP
                    });
                    marker.setMap(map);
                    // for(i=0; i<arrays.length; i++){
                    //     var data = arrays
                    //     console.log(data.properties.center['latitude']);
                    // }                   
                }
            }

        });
    }

    function getLocation(mapCreate) {
        // Geolokasi / lokasi sendiri
        var infoWindow = new google.maps.InfoWindow({
            map: mapCreate
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                $('#c_latitude').val(position.coords.latitude);
                $('#c_longitude').val(position.coords.longitude);

                if (markers.length > 0) {
                    for (let i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                }


                var marker = new google.maps.Marker({
                    position: pos,
                    map: mapCreate,
                    title: 'Lokasi Anda',
                    icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-6.png',
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });
                markers.push(marker);

                marker.addListener('click', toggleBounce);

                function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }
                infoWindow.setPosition(pos);
                infoWindow.setContent('Anda Disini');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function getLocationEdit(mapEdit) {
        // Geolokasi / lokasi sendiri
        var infoWindow = new google.maps.InfoWindow({
            map: mapEdit
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                $('#e_latitude').val(position.coords.latitude);
                $('#e_longitude').val(position.coords.longitude);

                if (markers.length > 0) {
                    for (let i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                }


                var marker = new google.maps.Marker({
                    position: pos,
                    map: mapEdit,
                    title: 'Lokasi Anda',
                    icon: 'https://img.icons8.com/external-kmg-design-outline-color-kmg-design/32/000000/external-map-map-and-navigation-kmg-design-outline-color-kmg-design-6.png',
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });
                markers.push(marker);

                marker.addListener('click', toggleBounce);

                function toggleBounce() {
                    if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                    } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    }
                }
                infoWindow.setPosition(pos);
                infoWindow.setContent('Anda Disini');
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Jika browser tidak mendukung geolokasi pindah ke lokasi ketetapan diatas (center)
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent('Error: Kesalahan layanan geolokasi.' +
            'Error: <i>Browser</i> anda tidak mendukung geolokasi.');
    }

    $(function () {
        $('#create-kost').on('click', function () {
            $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        })
    });

    $(document).ready(function () {
        $('.dataTables-kost').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'excel',
                    title: 'Data Kost Owner'
                },
                {
                    extend: 'pdf',
                    title: 'Data Kost Owner'
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
                url: "{{url('api/kost')}}?data=all&&user={{Auth::user()->kostOwner->id}}",
                dataSrc: ''
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'address'
                },
                {
                    data: 'type'
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
                        ` <a class="btn btn-white btn-sm" href="javascript:void(0)" onclick="edit(` +
                        data + `,'` + full.name + `','` + nl2br(full.address) + `','` + full
                        .type_id + `','` + full.latitude + `','` + full.longitude +
                        `')"><i class="fa fa-pencil"></i> Edit </a>` +

                        ` <a class="btn btn-white btn-sm" onclick="confirm_delete(` + data +
                        `)" href="javascript::void(0)"><i class="fa fa-trash"></i> Delete </a>` +

                        ` <a class="btn btn-white btn-sm" href="{{route('owner.room.index')}}/` +
                        data + `"><i class="fa fa-folder"></i> View </a>` +
                        ``;
                },
            }, ],
        });
    });

    function nl2br(str) {
        return str.replace(/(?:\r\n|\r|\n)/g, '<br>');
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
                    $('#deleted_kost').attr('action', "{{route('owner.kost.index')}}/" + id);
                    $('#deleted_kost').submit();
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    }

    function edit(id, name, address, type_id, latitude, longitude) {
        if ($('#edit').is(":visible")) {
            $('#edit').hide('500');
        } else {
            console.log(address);
            $('#edit').show('500');
            $('#e_name').val(name);
            $('#e_address').val(address);
            $('#e_latitude').val(latitude);
            $('#e_longitude').val(longitude);
            $('#e_type').val(type_id).trigger('change');
            $('#form-update').attr('action', "{{route('owner.kost.index')}}/" + id);
        }

        $('#create').hide('500');
    }

</script>
@endsection

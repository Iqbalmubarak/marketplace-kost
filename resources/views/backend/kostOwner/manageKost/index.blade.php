@extends('layouts.kostOwner.main')

@section('content')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

<div class="row">
    <div class="col-md-12">
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

<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <div class="row">
                <div class="col-10">
                    <h5>List Kost</h5>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <a href="{{ route('admin.kost-owner.create') }}">
                        <button class="btn btn-primary btn-outline" type="button">Add Data</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-kost" >
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Type</th>
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
            
@endsection

@section('script')
<script type="text/javascript">
    // Proses membuat marker 
    var location;
    var marker;
    // function addMarker(lat, lng, info){
    //     location = new google.maps.LatLng(lat, lng);
    //     bounds.extend(location);
    //     marker = new google.maps.Marker({
    //         map: map,
    //         position: location
    //     });       
    //     map.fitBounds(bounds);
    //     //bindInfoWindow(marker, map, infoWindow, info);
    // }
        
    // When the window has finished loading google map
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        // Options for Google map
        // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions1 = {
            zoom: 11,
            center: new google.maps.LatLng(22.4700,77.5667),
            // Style for Google Maps
            styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
        };

        // Get all html elements for map
        var mapElement1 = document.getElementById('map');

        // Create the Google Map using elements
        var map = new google.maps.Map(mapElement1, mapOptions1);

        // Variabel untuk menyimpan batas kordinat
        bounds = new google.maps.LatLngBounds();

        addMarker(22.4700,77.5667, "fsda");
        map.fitBounds(bounds);

        
    }

    $(document).ready(function(){
        $('.dataTables-kost').DataTable({
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
                url: "{{url('api/kost')}}?data=all&&user={{Auth::user()->kostOwner->id}}",
                dataSrc: ''
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'address'},
                {data: 'type'},
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
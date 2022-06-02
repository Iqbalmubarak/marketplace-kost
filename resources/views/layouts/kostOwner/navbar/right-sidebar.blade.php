<?php 
    $rooms = \App\Models\Room::whereIn('kost_id', $kost_id)->get();

    $room_id = collect([]);
    foreach($rooms as $room){
        $room_id->push($room->id);
    }
    $deadlineRents = \App\Models\Rent::join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                        ->join('rooms', 'rents.room_id', '=', 'rooms.id')
                                        ->whereIn('rents.room_id', $room_id)
                                        ->where('rent_details.status', 1)
                                        ->where('rent_details.ended_at', Carbon\Carbon::now()->format('Y-m-d'))
                                        ->get();
    // $warningRents = \App\Models\Rent::join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
    //                                     ->join('rooms', 'rents.room_id', '=', 'rooms.id')
    //                                     ->whereIn('rents.room_id', $room_id)
    //                                     ->where('rent_details.status', 1)
    //                                     ->where('rent_details.ended_at', Carbon\Carbon::now()->subDay(3)->format('Y-m-d'))
    //                                     ->get();

    $updateDetails = \App\Models\RentDetail::where('ended_at', '<', Carbon\Carbon::now()->format('Y-m-d'))
                                            ->where('status', 1)
                                            ->get();
    foreach($updateDetails as $updateDetail){
        $updateDetail->status = 3;
        $updateDetail->save();
    }
?>

<div class="sidebar-container">

    <ul class="nav nav-tabs navs-2">
        <li>
            <a class="nav-link active " data-toggle="tab" href="#tab-1"> Catatan </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-2"> Pemberitahuan </a>
        </li>
    </ul>

    <div class="tab-content">


        <div id="tab-1" class="tab-pane active">

            <div class="sidebar-title">
                <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                <small><i class="fa fa-tim"></i> You have 10 new message.</small>
            </div>

            <div>
                @foreach ($deadlineRents as $deadlineRent)
                    <div class="sidebar-message">
                        <a href="#">
                            <div class="float-left text-left">
                                
                            </div>
                            <div class="media-body">
                                <strong>Kamar {{$deadlineRent->name}}</strong>
                                <br>
                                Waktu penyewaan kamar berakhir pada hari ini
                            </div>
                        </a>
                    </div>
                @endforeach
                
                <div class="sidebar-message">
                    <a href="#">
                        <div class="float-left text-center">
                            <img alt="image" class="rounded-circle message-avatar" src="{{ asset('templates/img/warning.png') }}">
                        </div>
                        <div class="media-body">
                            <h4 style="color:#CB8100;">Warning!!</h4>
                            The point of using Lorem Ipsum is that it has a more-or-less normal.
                            <br>
                            <small class="text-muted">Yesterday 2:45 pm</small>
                        </div>
                    </a>
                </div>
                <div class="sidebar-message">
                    <a href="#">
                        <div class="float-left text-center">
                            <img alt="image" class="rounded-circle message-avatar" src="{{ asset('templates/img/danger.png') }}">
                        </div>
                        <div class="media-body">
                            <h4 style="color:red;">Important!!</h4>
                            Penyewa hdduk telah mendekati deadline
                            <br>
                            <small class="text-muted">Yesterday 2:45 pm</small>
                        </div>
                    </a>
                </div>
            </div>

        </div>

        <div id="tab-2" class="tab-pane">

            <div class="sidebar-title">
                <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
            </div>

            <ul class="sidebar-list">
                <li>
                    <a href="#">
                        <div class="small float-right m-t-xs">9 hours ago</div>
                        <h4>Business valuation</h4>
                        It is a long established fact that a reader will be distracted.

                        <div class="small">Completion with: 22%</div>
                        <div class="progress progress-mini">
                            <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                        </div>
                        <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                    </a>
                </li>

            </ul>

        </div>
    </div>

</div>

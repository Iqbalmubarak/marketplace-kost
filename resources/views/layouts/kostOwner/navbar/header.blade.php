<div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    <form role="search" class="navbar-form-custom" action="search_results.html">
        <div class="form-group">
            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
        </div>
    </form>
</div>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <span class="m-r-sm text-muted welcome-message">Selamat datang di kosanku</span>
    </li>
    <?php 
        $kosts = \App\Models\Kost::select('id')
        ->where('kost_owner_id', Auth::user()->kostOwner->id)
        ->get();
        
        $kost_id = collect([]);;
        foreach($kosts as $kost){
            $kost_id->push($kost->id);
        }
        $chats = \App\Models\Chat::whereIn('kost_id', $kost_id)
                                ->where('owner_status', 0)
                                ->get();

        $rooms = \App\Models\Room::whereIn('kost_id', $kost_id)->get();

        $room_id = collect([]);
        foreach($rooms as $room){
            $room_id->push($room->id);
        }
        $roomTypes = \App\Models\RoomType::whereIn('kost_id', $kost_id)->get();

        $room_type_id = collect([]);
        foreach($roomTypes as $roomType){
            $room_type_id->push($roomType->id);
        }
        $deadlineRents = \App\Models\Rent::select('rents.id as id', 'rooms.name as name', 'rent_details.ended_at as ended_at')
                                            ->join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                            ->join('rooms', 'rents.room_id', '=', 'rooms.id')
                                            ->whereIn('rents.room_id', $room_id)
                                            ->where('rent_details.status', 1)
                                            ->where('rent_details.ended_at', Carbon\Carbon::now()->format('Y-m-d'))
                                            ->get();
        $warningRents = \App\Models\Rent::select('rents.id as id', 'rooms.name as name', 'rent_details.ended_at as ended_at')
                                            ->join('rent_details', 'rents.id', '=', 'rent_details.rent_id')
                                            ->join('rooms', 'rents.room_id', '=', 'rooms.id')
                                            ->whereIn('rents.room_id', $room_id)
                                            ->where('rent_details.status', 1)
                                            ->where('rent_details.ended_at', '>=', Carbon\Carbon::now()->format('Y-m-d'))
                                            ->where(DB::raw("DATE_SUB(rent_details.ended_at, INTERVAL 3 DAY)"), '<=', Carbon\Carbon::now()->format('Y-m-d'))
                                            ->get();
        $bookings = \App\Models\Booking::whereIn('room_type_id', $room_type_id)
                                        ->where('status', 1)
                                        ->get();

        $updateDetails = \App\Models\RentDetail::where('ended_at', '<', Carbon\Carbon::now()->format('Y-m-d'))
                                                ->where('status', 1)
                                                ->get();
        foreach($updateDetails as $updateDetail){
            $updateDetail->status = 3;
            $updateDetail->save();
        }
    ?>
    
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope"></i> 
            @if($chats->count() > 0)
            <span class="label label-warning">{{$chats->count()}}</span>
            @endif
        </a>
        <ul class="dropdown-menu dropdown-messages">
            @foreach ($chats as $chat)
                <li>
                    <div class="dropdown-messages-box">
                        <a class="dropdown-item float-left" href="{{ route('owner.chat.show', $chat->id) }}">
                            <img alt="image" class="rounded-circle" src="{{ asset('templates/img/a4.jpg') }}">
                        </a>
                        <div>
                            <small class="float-right text-navy">{{Helper::timeago($chat->newMessage()->created_at)}}</small>
                            <strong>{{$chat->kost->name}}</strong> menerima pesan baru dari <strong>{{$chat->kostSeeker->first_name}} {{$chat->kostSeeker->last_name}}</strong>. <br>
                            <small class="text-muted">{{$chat->newMessage()->created_at->format('g:i a')}} - {{$chat->newMessage()->created_at->format('d.m.Y')}}</small>
                        </div>
                    </div>
                </li>
                <li class="dropdown-divider"></li>
            @endforeach
            @if($chats->count() > 0)
            <li>
                <div class="text-center link-block">
                    <a href="{{ route('owner.chat.index') }}" class="dropdown-item">
                        <i class="fa fa-envelope"></i> <strong>Baca semua pesan</strong>
                    </a>
                </div>
            </li>
            @else
            <li>
                <div class="text-center link-block">
                        <i class="fa fa-envelope"></i> <strong>Kamu tidak memiliki pesan baru</strong>
                </div>
            </li>
            @endif
        </ul>
    </li>
    <?php 
        //dd($chats->take(1))
    ?>
    
    <li class="dropdown">
        <a class="right-sidebar-toggle count-info">
            @if (($warningRents->count() + $deadlineRents->count() + $bookings->count()) > 0)
                
            @endif
            <i class="fa fa-bell"></i>  <span class="label label-primary">{{$warningRents->count() + $deadlineRents->count() + $bookings->count()}}</span>
        </a>
    </li>
    <li>
        <a onclick="logout()">
            <i class="fa fa-sign-out" ></i> Log out
        </a>
    </li>
    <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
    <li>
        
    </li>
</ul>

<div id="right-sidebar">
    @include('layouts.kostOwner.navbar.right-sidebar')
</div>
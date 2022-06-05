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
                <h3> <i class="fa fa-bell"></i>Catatan Terakhir</h3>
                <small><i class="fa fa-tim"></i>Ada {{$warningRents->count() + $deadlineRents->count()}} notifikasi catatan baru.</small>
            </div>

            <div>
                @foreach ($deadlineRents as $deadlineRent)
                <div class="sidebar-message">
                    <a href="{{route('owner.rent.show', $deadlineRent->id)}}">
                        <div class="float-left text-center">
                            <img alt="image" class="rounded-circle message-avatar"
                                src="{{ asset('templates/img/berakhir.png') }}">
                        </div>
                        <div class="media-body">
                            <h4 style="color:red;">Selesai !</h4>
                            <b>Kamar {{$deadlineRent->name}}</b> : Penyewaan kamar telah barakhir hari ini, harap
                            melakukan pengecekan.
                            <br>
                            <small class="text-muted">Berakhir pada : {{$deadlineRent->ended_at}}</small>
                        </div>
                    </a>
                </div>
                @endforeach

                @foreach ($warningRents as $warningRent)
                <div class="sidebar-message">
                    <a href="{{route('owner.rent.show', $warningRent->id)}}">
                        <div class="float-left text-center">
                            <img alt="image" class="rounded-circle message-avatar"
                                src="{{ asset('templates/img/hampir.png') }}">
                        </div>
                        <div class="media-body">
                            <h4 style="color:#CB8100;">Peringatan !</h4>
                            <b>Kamar {{$warningRent->name}}</b> : Batas penyewaan kamar hampir berakhir, harap
                            melakukan perpanjangan sewa.
                            <br>
                            <small class="text-muted">Berakhir pada : {{$warningRent->ended_at}}</small>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>

        <div id="tab-2" class="tab-pane">

            <div class="sidebar-title">
                <h3> <i class="fa fa-bell"></i> Pemberitahuan Terakhir</h3>
                <small><i class="fa fa-tim"></i>Ada {{$bookings->count()}} notifikasi pemberitahuan baru.</small>
            </div>
            <div>
                @foreach ($bookings as $booking)
                    <div class="sidebar-message">
                        <a href="{{route('owner.booking.index')}}">
                            <div class="float-left text-center">
                                <img alt="image" class="rounded-circle message-avatar"
                                    src="{{ asset('templates/img/permohonan.png') }}">
                            </div>
                            <div class="media-body">
                                <h4 style="color:#198FCF;">Permohonan Baru !</h4>
                                <b>{{$booking->roomType->kost->name}}</b> : Ada permohonan booking kamar kost baru.
                                <br>
                                <small class="text-muted">{{$booking->created_at->format('D M d Y - H:i:s')}}</small>
                            </div>
                        </a>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>

</div>

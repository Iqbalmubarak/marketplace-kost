@extends('layouts.landingPage.main')

@section('css')
<link href="{{ asset('templates/css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="body-content outer-top-bd">
    <div class="container">
        <div class="x-page inner-bottom-sm">
            @if(!$chat)
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <strong>Belum ada obrolan yang tersedia</strong>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox chat-view">

                        <div class="ibox-title">
                            @if($chat)
                            <strong>{{$chat->kostOwner->first_name}} {{$chat->kostOwner->last_name}} ({{$chat->kost->name}})</strong>
                            <small class="float-right text-muted"> Last message: {{$chat->updated_at->format('D M d Y - H:i:s')}}</small>
                            @endif
                        </div>


                        <div class="ibox-content">

                            <div class="row">

                                <div class="col-md-9 ">
                                    <div class="chat-discussion" id="chat-content">
                                        @foreach($chat->chatDetail as $chatDetail)
                                        @if ($chatDetail->sender == Auth::user()->kostSeeker->id)
                                        <div class="chat-message right">
                                            <img class="message-avatar" src="@if ($chat->kostSeeker->avatar)
                                                {{ asset('storage/images/avatar/'.$chat->kostSeeker->avatar) }}
                                            @else
                                                {{ asset('templates/img/profile/profil1.jpeg') }}
                                            @endif" alt="">
                                            <div class="message">
                                                <a class="message-author" href="#"> {{$chat->kostSeeker->first_name}} {{$chat->kostSeeker->last_name}} </a>
                                                <span class="message-date"> {{$chatDetail->created_at->format('D M d Y - H:i:s')}} </span>
                                                <span class="message-content">
                                                    {{$chatDetail->message}} 
                                                </span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="chat-message left">
                                            <img class="message-avatar" src="@if ($chat->kostOwner->avatar)
                                                {{ asset('storage/images/avatar/'.$chat->kostOwner->avatar) }}
                                            @else
                                                {{ asset('templates/img/profile/profil1.jpeg') }}
                                            @endif" alt="">
                                            <div class="message">
                                                <a class="message-author" href="#"> {{$chat->kostOwner->first_name}} {{$chat->kostOwner->last_name}} </a>
                                                <span class="message-date"> {{$chatDetail->created_at->format('D M d Y - H:i:s')}} </span>
                                                <span class="message-content">
                                                    {{$chatDetail->message}} 
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="chat-users">
                                        @foreach ($chats as $chatList)
                                            <div class="users-list">
                                                <div class="chat-user">
                                                    <img class="chat-avatar" src="@if ($chatList->kostOwner->avatar)
                                                {{ asset('storage/images/avatar/'.$chatList->kostOwner->avatar) }}
                                            @else
                                                {{ asset('templates/img/profile/profil1.jpeg') }}
                                            @endif" alt="">
                                                    <div class="chat-user-name">
                                                        <a href="{{ route('customer.chat.show', $chatList->id) }}">{{$chatList->kostOwner->first_name}} {{$chatList->kostOwner->last_name}}</a>
                                                        <span class="message-content">
                                                            {{$chatList->kost->name}} 
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="chat-message-form">

                                        <div class="form-group">
                                            <textarea class="form-control message-input" name="message"
                                                placeholder="Enter message text" id="send-message"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="button" onclick="sendMessage({{Auth::user()->kostSeeker->id}}, {{$chat->kostOwner->id}}, {{$chat->kost->id}}, {{Auth::user()->isCustomer()}})">Send</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div>

@endsection

@section('script')
<script>
    function sendMessage(kostSeeker, kostOwner, kost, status) {
        let message = $('#send-message').val();
        console.log(kostSeeker);
        console.log(kostOwner);
        console.log(kost);

        let base_url = "{{URL('api/message/send_message')}}";
        $.ajax({
            url: base_url + "?kostSeeker=" + kostSeeker + "&kostOwner=" + kostOwner + "&kost=" + kost +  "&message=" + message + "&status=" + status,
            dataType: 'json',
            cache: false,
            dataSrc: '',
            success: function (data) {
                console.log(data.avatar)
                if(data.avatar){
                    var div = $(`<div class="chat-message right">
                                <img class="message-avatar" src="{{ asset('storage/images/avatar/`+ data.avatar +`') }}" alt="">
                                <div class="message">
                                    <a class="message-author" href="#"> `+data.name+` </a>
                                    <span class="message-date"> `+data.created_atV2+`</span>
                                    <span class="message-content">
                                        `+data.message+`
                                    </span>
                                </div>
                            </div>`);
                }else{
                    var div = $(`<div class="chat-message right">
                                <img class="message-avatar" src="{{ asset('templates/img/profile/profil1.jpeg') }}" alt="">
                                <div class="message">
                                    <a class="message-author" href="#"> `+data.name+` </a>
                                    <span class="message-date"> `+data.created_atV2+`</span>
                                    <span class="message-content">
                                        `+data.message+`
                                    </span>
                                </div>
                            </div>`);
                }
                

                $('#chat-content').append(div);
                $('#send-message').value = '';

                $('#chat-content').scrollTop($('#chat-content')[0].scrollHeight);
            }
        });
    }
</script>
@endsection

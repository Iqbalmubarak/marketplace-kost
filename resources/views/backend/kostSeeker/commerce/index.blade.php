@extends('layouts.kostSeeker.main')

@section('content')
    <div class="row">
        @foreach ($roomTypes as $roomType)
        <div class="col-md-2">
            <div class="ibox">
                <div class="ibox-content product-box">
                    @if ($roomType->image())
                        <img alt="image" class="img-fluid" src="{{ asset('storage/images/room/'.$roomType->image()->image) }}">
                    @else
                    <div class="product-imitation">
                        [ INFO ]
                    </div>
                    @endif
                    
                    <div class="product-desc">
                        <span class="product-price">
                            {{Helper::rupiah($roomType->month()->price)}}/ Bulan
                        </span>
                        <small class="text-muted">
                            @if ($roomType->kost->type->id == 1)
                            <span class="badge badge-success">{{$roomType->kost->type->name}}</span>
                            @elseif ($roomType->kost->type->id == 2)
                            <span class="badge badge-danger">{{$roomType->kost->type->name}}</span>
                            @else
                            <span class="badge badge-warning">{{$roomType->kost->type->name}}</span>
                            @endif
                        </small>
                        <h4 class="product-name"> {{$roomType->kost->name}}</h4>
                        <div class="small m-t-xs">
                            {{$roomType->name}} <br>
                            {{$roomType->kost->address}}
                        </div>
                        <div class="m-t text-righ">

                            <a href="{{ route('customer.commerce.show', $roomType->id) }}" class="btn btn-xs btn-outline btn-primary">Info <i
                                    class="fa fa-long-arrow-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection

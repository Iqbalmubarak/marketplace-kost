@extends('layouts.admin.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Admin</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.admin.index') }}">Admin</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Edit</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<br>
<div class="ibox ">
    <div class="ibox-title">
        <h5>Edit Data Admin</h5>
    </div>
    <div class="ibox-content">
      {{ Form::open(array('method'=>'PATCH','url' => route('admin.admin.update', $admin->id), 'files' => true)) }} 
          <div class="form-group row"><label class="col-lg-2 col-form-label">Name</label>
              <div class="col-lg-5">
                <input id="first_name" value="{{$admin->first_name}}" name="first_name" type="type" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('first_name')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                @enderror 
              </div>
              <div class="col-lg-5">
                <input id="last_name" value="{{$admin->last_name}}" name="last_name" type="type" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('last_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror  
            </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Phone Number</label>
              <div class="col-lg-10">
                <input id="handphone" value="{{$admin->handphone}}" name="handphone" type="phone" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('handphone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror  
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>
              <div class="col-lg-10">
                <input id="email" name="email" value="{{$admin->user->email}}" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"  disabled="">
                <span class="form-text m-b-none"></span>
                  @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                  @enderror  
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Address</label>
              <div class="col-lg-10">
                <textarea class="form-control" name="address" id="address" cols="30" rows="10">{{ $admin->address }}</textarea>
                @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>
          </div>

          <div class="form-group row">
              <div class="col-lg-10 d-flex justify-content-center">
                <a href="{{ route('admin.admin.index') }}">
                  <button class="btn btn-lg btn-white" type="button">Back</button>
                </a>
                &nbsp;&nbsp;
                <button class="btn btn-lg btn-primary" type="submit">Save</button>
              </div>
          </div>
      
      {!! Form::close() !!}

    </div>
</div>

@endsection

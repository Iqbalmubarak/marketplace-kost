@extends('layouts.landingPage.main')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Sign in</h4>
                    <p class="">Hello, Welcome to your account.</p>
                    <form method="POST" class="register-form outer-top-xs" role="form" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror"
                                id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password">Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="radio outer-xs">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                            <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                        </div>
                        
                    </form>
                </div>
                <!-- Sign-in -->

                <!-- create a new account -->
                <div class="col-md-6 col-sm-6 create-new-account">
                    <h4 class="checkout-subtitle">Create a new account </h4>
                    <p class="text title-tag-line" >Create your new account.</p>
                    <form method="POST" class="register-form outer-top-xs" role="form" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="email">Email Address <span>@error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror"
                                id="email" name="email">
                        </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label class="info-title" for="first_name">First Name <span>@error('first_name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror</span></label>
                                <input type="text" class="form-control unicase-form-control text-input @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label class="info-title" for="last_name">Last Name <span>@error('last_name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror</span></label>
                                <input type="text" class="form-control unicase-form-control text-input @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name">
                            </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="handphone">Phone Number <span>@error('handphone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="phone" class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror"
                                id="handphone" name="handphone">
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="info-title" for="address">Address <span>@error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <textarea name="address" id="address" class="form-control unicase-form-control text-input @error('handphone') is-invalid @enderror"></textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="password">Password <span>@error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="password" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                id="password" name="password">
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="info-title" for="password">Confirm Password <span>@error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror</span></label>
                            <input type="password" class="form-control unicase-form-control text-input @error('password') is-invalid @enderror"
                                id="password" name="password_confirmation">
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            @if($_GET['role']=='owner')   
                                <input type="hidden" name="role" value="owner">
                            @elseif($_GET['role']=='customer')   
                                <input type="hidden" name="role" value="customer">
                            @else
                                <input type="hidden" name="role" value="admin">
                            @endif
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                        </div>
                        
                    </form>


                </div>
                <!-- create a new account -->
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->>
        @endsection

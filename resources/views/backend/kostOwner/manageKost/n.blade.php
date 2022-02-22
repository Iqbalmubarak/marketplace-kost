<div class="ibox" id="create" style="display:none">
    <div class="ibox-title">
        <h5>Add Data Kost</h5>
    </div>
    <div class="ibox-content">
        {{ Form::open(array('url' => route('owner.kost.store'), 'files' => true, 'class' => 'wizard-big')) }}
        <div class="form-group row"><label class="col-lg-2 col-form-label">Name</label>
            <div class="col-lg-10">
                <input id="c_name" name="name" type="text" placeholder="Name"
                    class="form-control @error('phone') is-invalid @enderror required"> <span
                    class="form-text m-b-none"></span>
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row"><label class="col-lg-2 col-form-label">Type</label>
            <div class="col-lg-10">
                {!! Form::select('type', $type, null, ['class' => 'form-control selectpicker',
                'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_type']) !!}
                @error('type')
                <div class="form-text text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>


        <div class="form-group row"><label class="col-lg-2 col-form-label">Address</label>
            <div class="col-lg-10">
                <textarea id="c_address" name="address" type="textarea" placeholder="Address"
                    class="form-control @error('address') is-invalid @enderror required"> </textarea>
                <span class="form-text m-b-none"></span>
                @error('address')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row"><label class="col-lg-2 col-form-label">Coordinate</label>
            <div class="col-lg-4">
                <input id="c_latitude" name="latitude" type="text" placeholder="latitude"
                    class="form-control @error('phone') is-invalid @enderror required" readonly> <span
                    class="form-text m-b-none"></span>
                @error('latitude')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-lg-4">
                <input id="c_longitude" name="longitude" type="text" placeholder="Longitude"
                    class="form-control @error('longitude') is-invalid @enderror required" readonly> <span
                    class="form-text m-b-none"></span>
                @error('longitude')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-lg-2 d-flex justify-content-left">
                <Button class="btn btn-default  dim" title="Get Your Location" id="get-location" type="button"><i
                        class="fa fa-map-marker"></i></Button>

                <Button class="btn btn-default  dim" title="Mark Your Location" onclick="$('#map-create').toggle(500);"
                    type="button"><img
                        src="https://img.icons8.com/external-those-icons-lineal-those-icons/24/000000/external-map-maps-locations-those-icons-lineal-those-icons-2.png" /></Button>
            </div>
        </div>

        <div class="google-map" id="map-create" style="height:400px" style="display:none"></div>

        <br>
        <div class="form-group row">
            <div class="col-lg-12 d-flex justify-content-center">
                <button class="btn btn-lg btn-white" onclick="$('#create').toggle(500);" type="button">Back</button>
                &nbsp;&nbsp;
                <button class="btn btn-lg btn-primary" type="submit">Save</button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>

<div class="row" id="create" style="display:none">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Wizard with Validation</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" class="dropdown-item">Config option 1</a>
                        </li>
                        <li><a href="#" class="dropdown-item">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <h2>
                    Validation Wizard Form
                </h2>
                <p>
                    This example show how to use Steps with jQuery Validation plugin.
                </p>
                {{ Form::open(array('url' => route('owner.kost.store'), 'files' => true, 'class' => 'wizard-big')) }}
                <h1>Account</h1>
                <fieldset>
                    <h2>Account Information</h2>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Username *</label>
                                <input id="userName" name="userName" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" name="password" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <input id="confirm" name="confirm" type="text" class="form-control required">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <div style="margin-top: 20px">
                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <h1>Profile</h1>
                <fieldset>
                    <h2>Profile Information</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First name *</label>
                                <input id="name" name="name" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Last name *</label>
                                <input id="surname" name="surname" type="text" class="form-control required">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <input id="email" name="email" type="text" class="form-control required email">
                            </div>
                            <div class="form-group">
                                <label>Address *</label>
                                <input id="address" name="address" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Warning</h1>
                <fieldset>
                    <div class="text-center" style="margin-top: 120px">
                        <h2>You did it Man :-)</h2>
                    </div>
                </fieldset>

                <h1>Finish</h1>
                <fieldset>
                    <h2>Terms and Conditions</h2>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label
                        for="acceptTerms">I agree with the Terms and Conditions.</label>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
</div>

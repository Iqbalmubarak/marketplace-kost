<div class="ibox" id="create" style="display:none">
    <div class="ibox-title">
        <h5>Add Data Admin</h5>
    </div>
    <div class="ibox-content">
      {{ Form::open(array('url' => route('owner.kost.store'), 'files' => true)) }} 
          <div class="form-group row"><label class="col-lg-2 col-form-label">Name</label>
              <div class="col-lg-5">
                <input id="first_name" name="first_name" type="type" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('first_name')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                @enderror 
              </div>
              <div class="col-lg-5">
                <input id="last_name" name="last_name" type="type" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('last_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror  
            </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Phone Number</label>
              <div class="col-lg-10">
                <input id="handphone" name="handphone" type="phone" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('handphone')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror  
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>
              <div class="col-lg-10">
                <input id="email" name="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                <span class="form-text m-b-none"></span>
                  @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                  @enderror  
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Password</label>
              <div class="col-lg-10">
                <input id="password" name="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                <span class="form-text m-b-none">
                  @error('password')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
                </span>
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Confirm Password</label>
              <div class="col-lg-10">
                <input id="password" name="password_confirmation" type="password" placeholder="" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Address</label>
              <div class="col-lg-10">
                {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder'=>'','required'=>'required']) !!}
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
                &nbsp;&nbsp;
                <button class="btn btn-lg btn-primary" onclick="$('#map-marker').toggle(500);" type="button">Map</button>
              </div>
          </div>

          <div class="google-map" id="map-marker" style="height:400px" style="display:none"></div>
      
      {!! Form::close() !!}

    </div>
</div>

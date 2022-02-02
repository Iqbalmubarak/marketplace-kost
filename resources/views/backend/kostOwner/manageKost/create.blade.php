<div class="ibox" id="create" style="display:none">
    <div class="ibox-title">
        <h5>Add Data Kost</h5>
    </div>
    <div class="ibox-content">
      {{ Form::open(array('url' => route('owner.kost.store'), 'files' => true)) }} 
          <div class="form-group row"><label class="col-lg-2 col-form-label">Name</label>
              <div class="col-lg-10">
                <input id="c_name" name="name" type="text" placeholder="Name" class="form-control @error('phone') is-invalid @enderror"> <span class="form-text m-b-none"></span>
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror  
              </div>
          </div>

          <div class="form-group row"><label class="col-lg-2 col-form-label">Type</label>
              <div class="col-lg-10">
                {!! Form::select('type', $type, null, ['class' => 'form-control selectpicker', 'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_type']) !!}
                @error('type')
                  <div class="form-text text-danger">{{$message}}</div>
                @enderror
              </div>
          </div>

          
          <div class="form-group row"><label class="col-lg-2 col-form-label">Address</label>
              <div class="col-lg-10">
                <textarea id="c_address" name="address" type="textarea" placeholder="Address" class="form-control @error('address') is-invalid @enderror"> </textarea>
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
              <input id="c_latitude" name="latitude" type="text" placeholder="latitude" class="form-control @error('phone') is-invalid @enderror" readonly> <span class="form-text m-b-none"></span>
                @error('latitude')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror   
            </div>
            <div class="col-lg-4">
              <input id="c_longitude" name="longitude" type="text" placeholder="Longitude" class="form-control @error('longitude') is-invalid @enderror" readonly> <span class="form-text m-b-none"></span>
              @error('longitude')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
              @enderror  
            </div>
            <div class="col-lg-2 d-flex justify-content-left">
              <Button class="btn btn-default  dim" title="Get Your Location" id="get-location" type="button"><i class="fa fa-map-marker"></i></Button>

              <Button class="btn btn-default  dim" title="Mark Your Location" onclick="$('#map-create').toggle(500);" type="button"><img src="https://img.icons8.com/external-those-icons-lineal-those-icons/24/000000/external-map-maps-locations-those-icons-lineal-those-icons-2.png"/></Button>
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

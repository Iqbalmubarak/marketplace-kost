<div class="ibox" id="create" style="display:none">
    <div class="ibox-title">
        <h5>Menambah kost</h5>

    </div>
    <div class="ibox-content">
        <!-- {!!Form::open(['route'=>'dropzone.store',
        'method'=>'POST','class'=>'dropzone','id'=>'my-dropzone','files'=>true])!!}

        <div class="dz-message needsclick">
            Drop files here or click to upload.<br>
            <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong>
                actually uploaded.)</span>
        </div>


        <button id="submit-all">Submit all files</button>

        {!!Form::close()!!} -->

        {{ Form::open(array('method'=>'POST', 'url' => route('owner.kost.store'),'class' => 'wizard-big', 'files' => true, 'id'=>'form', 'enctype' => 'multipart/form-data')) }}

        <h1>Informasi Kost</h1>
        <fieldset>
            <div class="form-group row"><label class="col-lg-2 col-form-label">Nama</label>
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
            <div class="form-group row"><label class="col-lg-2 col-form-label">Tipe</label>
                <div class="col-lg-10">
                    {!! Form::select('type', $type, null, ['class' => 'form-control selectpicker',
                    'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_type']) !!}
                    @error('type')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row"><label class="col-lg-2 col-form-label">Alamat</label>
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
        </fieldset>

        <h1>Koordinat</h1>
        <fieldset>
            <div class="form-group row"><label class="col-lg-2 col-form-label">Koordinat</label>
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
                    <Button class="btn btn-default  dim" title="Mark Your Location"
                        onclick="$('#map-create').toggle(500);" type="button"><img
                            src="https://img.icons8.com/external-those-icons-lineal-those-icons/24/000000/external-map-maps-locations-those-icons-lineal-those-icons-2.png" /></Button>
                </div>
            </div>
            <div class="google-map" id="map-create" style="height:400px" style="display:none"></div>
        </fieldset>

        <h1>Fasilitas</h1>
        <fieldset>
            <div class="form-group row repet" id="repet">
                <div data-repeater-list="" class="col-lg-12">
                    <div data-repeater-item class="form-group row align-items-center">
                        <label class="col-lg-2 col-form-label">Fasilitas :</label>
                        <div class="col-lg-8">
                            <input id="c_facility" name="facility[]" type="text" placeholder="Fasilitas"
                                class="form-control @error('facility') is-invalid @enderror required"> <span
                                class="form-text m-b-none"></span>
                            @error('facility')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-2">
                            <a href="javascript:;" onclick="delmyclone(this)" class="btn btn-white btn-sm">
                                <i class="fa fa-trash"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-group-last row">
                <!-- <label class="col-lg-2 col-form-label"></label> -->
                <div class="col-lg-4">
                    <a href="javascript:;" onclick="myclone()" class="btn btn-white btn-sm">
                        <i class="fa fa-plus-square"></i> Add
                    </a>
                </div>
            </div>
        </fieldset>

        {!! Form::close() !!}
    </div>
</div>
</div>

<div class="col-lg-12 animated fadeInRight" id="room-edit" style="display:none">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Menambah kost</h5>
        </div>
        <div class="ibox-content">
            {{ Form::open(array('method'=>'PATCH', 'url' => route('owner.kost.room.update', 0), 'id'=>'room-update')) }}
            <div class="form-group row"><label class="col-lg-2 col-form-label">Tipe kamar</label>
                <div class="col-lg-10">
                    {!! Form::select('room_type', $room_type,null, ['class' => 'form-control
                    selectpicker','data-live-search'=>'true','required'=>'required','id'=>'e_room_type']) !!}
                    @error('room_type')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row"><label class="col-lg-2 col-form-label">Nama kamar</label>
                <div class="col-lg-10">
                    <input id="e_room_name" name="room_name" type="text" placeholder="Nama kamar"
                        class="form-control @error('room_name') is-invalid @enderror required"> <span
                        class="form-text m-b-none"></span>
                    @error('room_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row"><label class="col-lg-2 col-form-label">Terisi</label>
                <div class="col-lg-10">
                    <div class="checkbox checkbox-success">
                        <input name="availability" id="e_availability" type="checkbox" >
                        <label for="e_availability">
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

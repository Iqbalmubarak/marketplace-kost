<div class="col-lg-12 animated fadeInRight" id="accept" style="display:none">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Penyewaan kamar</h5>
        </div>
        <div class="ibox-content">
            {{ Form::open(array('method'=>'POST', 'url' => route('owner.booking.accept', 0), 'id'=>'form-acc')) }}
            <div class="form-group row">
                <label class="col-lg-1 col-form-label">Kamar</label>
                <div class="col-lg-10">
                    {!! Form::select('room', $room,null, ['class' => 'form-control kt-select2
                    myselect2','required'=>'required','id'=>'c_room']) !!}
                    @error('room')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
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

{{ Form::open(array('method'=>'POST', 'url' => route('customer.commerce.store'), 'files' => true)) }}
<div class="modal inmodal" id="acceptModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Pemesanan kamar</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Kamar</label>
                    <div class="col-lg-9">
                        {!! Form::select('room', $room,null, ['class' => 'form-control kt-select2
                        myselect2','required'=>'required','id'=>'c_room']) !!}
                        @error('room')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

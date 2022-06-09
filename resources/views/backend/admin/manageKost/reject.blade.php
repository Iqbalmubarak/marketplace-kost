<div class="col-lg-12 animated fadeInRight" id="reject-kost" style="display:none">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Menambah kost</h5>
        </div>
        <div class="ibox-content">
            {{ Form::open(array('method'=>'POST', 'url' => route('admin.kost.reject'))) }}
            <input id="kost_id" name="kost_id" type="hidden">
            <div class="form-group row"><label class="col-lg-2 col-form-label">Alasan</label>
                <div class="col-lg-10">
                    <textarea name="reject_note" class="form-control" cols="30" rows="10" required></textarea>
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

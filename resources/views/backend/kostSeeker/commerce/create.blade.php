{{ Form::open(array('method'=>'POST', 'url' => route('customer.commerce.store'))) }}
<div class="modal inmodal" id="bookingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Pemesanan kamar</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Durasi penyewaan</label>
                    <div class="col-lg-9">
                        {!! Form::select('duration', $duration, null, ['class' => 'form-control selectpicker', 'title' => "Pilih Durasi",
                        'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_duration']) !!}
                        @error('duration')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Total biaya</label>
                    <div class="col-lg-9">
                        <input name="price" type="text" placeholder="Total biaya" id="c_total_price"
                                class="form-control @error('price') is-invalid @enderror required" required readonly> 
                                <span class="form-text m-b-none"></span>
                            @error('price')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        <input name="price_list_id" type="text" id="c_price_list_id"
                                class="form-control @error('price_list_id') is-invalid @enderror required"  style="display:none"> 
                                <span class="form-text m-b-none"></span>
                    </div>
                </div>
                <div class="form-group row" style="display:none">
                    <label class="col-lg-3 col-form-label"></label>
                    <div class="col-lg-9">
                        <input name="room_type" type="text"  id="c_room_type" value="{{$roomType->id}}"
                                class="form-control @error('room_type') is-invalid @enderror required" required readonly> 
                                <span class="form-text m-b-none"></span>
                            @error('room_type')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="form-group row" id="data_5">
                    <label class="col-lg-3 col-form-label">Jarak penyewaan</label>
                    <div class="col-lg-9">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" id="c_start" class="form-control-sm form-control" name="start" value="{{$today}}"/>
                            <span class="input-group-addon">hingga</span>
                            <input type="text" id="c_end" class="form-control-sm form-control" name="end" value="" readonly/>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group row" id="data_5">
                    <label class="col-lg-3 col-form-label">Pilih Metode pembayaran</label>
                    <div class="col-lg-9">
                        <div class="row">
                            @foreach ($paymentMethodDetails as $paymentMethodDetail)
                                <div class="col-md-3">
                                    <div class="i-checks"><label> <input type="radio"  value="{{$paymentMethodDetail->id}}" name="payment_method_detail" required> <i></i> {{$paymentMethodDetail->paymentMethod->name}} </label></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">No rekening</label>
                    <div class="col-lg-9">
                        <input id="c_rek" name="rek" type="text" placeholder="{{$roomType->kost->no_rek}}"
                            class="form-control @error('rek') is-invalid @enderror" readonly> <span
                            class="form-text m-b-none"></span>
                        @error('total_price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row"><label class="col-lg-3 col-form-label">Bukti pembayaran</label>
                    <div class="col-lg-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-block btn-outline btn-primary btn-file"><span
                                    class="fileinput-new">Upload</span>
                                <span class="fileinput-exists">Change</span><input type="file" id="payment"
                                    name="payment" onchange="return fileValidation()"  required/></span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none"
                                onclick="removeImage()">×</a>
                        </div>
                        <div id="imagePreview"></div>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

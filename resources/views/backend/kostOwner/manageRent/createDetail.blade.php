
<div class="col-lg-12" id="detail-create" style="display:none">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Menambah penyewaan kamar</h5>
        </div>
        <div class="ibox-content">
            {{ Form::open(array('method'=>'POST', 'url' => route('owner.rent.detailStore', $rent->id))) }}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Pilih durasi penyewaan</label>
                <div class="col-lg-9">
                    {!! Form::select('price_list', $price_list,null, ['class' => 'form-control selectpicker','required'=>'required','id'=>'c_price_list','title'=>'Pilih durasi']) !!}
                    @error('price_list')
                    <div class="form-text text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Biaya tambahan</label>
                <div class="col-lg-9" id="row-optional">
                  @foreach ($optionals as $optional)
                  <div class="checkbox checkbox-primary">
                      <input class="optional-checkbox" id="optional{{$loop->iteration}}" name="optional[]" type="checkbox"
                          value="{{$optional->id}}" onclick="checkOptional()" checked disabled>
                      <label for="optional{{$loop->iteration}}">
                          {{$optional->name}}/ {{Helper::rupiah($optional->price)}}
                      </label>
                      <input type="hidden" name="input_checkbox" id="input-checkbox{{$optional->id}}" value="{{$optional->price}}">
                  </div>
                  @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Total biaya</label>
                <div class="col-lg-9">
                    <input id="c_total_price" name="total_price" type="text" placeholder="Rp. 0,00"
                        class="form-control @error('total_price') is-invalid @enderror" readonly> <span
                        class="form-text m-b-none"></span>
                    @error('total_price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6 col-form-label">
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>


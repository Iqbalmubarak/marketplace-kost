@if(Auth::user()->isOwner())
    @extends('layouts.kostOwner.main')

    @section('content')
        <div class="row wrapper wrapper-content animated fadeInRight">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Ubah Password</h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open(array('method'=>'POST', 'url' => route('owner.auth.changePassword.store'))) }}
                        <div class="form-group row"><label class="col-lg-2 col-form-label">New password</label>
                            <div class="col-lg-10">
                                <input name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror required" required> <span
                                    class="form-text m-b-none"></span>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-lg-2 col-form-label">Confirm password</label>
                            <div class="col-lg-10">
                                <input name="password_confirmation" type="password"
                                    class="form-control @error('password') is-invalid @enderror required" required> <span
                                    class="form-text m-b-none"></span>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-form-label">
                                <button type="submit" class="btn btn-outline-success">Simpan</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
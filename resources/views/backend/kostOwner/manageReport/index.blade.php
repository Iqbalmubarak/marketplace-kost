@extends('layouts.kostOwner.main')

@section('css')
<!-- FooTable -->
<link href="{{ asset('templates/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdGrzi3vv43yyxfcFiBRoGVqvtZcJ2lIM"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Manage Kost</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <strong>
                    <a>Manage Kost</a>
                </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">

    {{ Form::open(array('method'=>'POST', 'url' => route('owner.report.print'))) }}
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-form-label" for="c_type">Kos</label>
                    {!! Form::select('kosts[]', $kosts, null, ['class' => 'form-control selectpicker',
                            'data-live-search'=>'true', 'multiple' => 'multiple', 'required'=>'required', 'id'=>'c_kosts']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="c_type">Tipe laporan</label>
                    {!! Form::select('type', $type, null, ['class' => 'form-control selectpicker',
                            'data-live-search'=>'true', 'required'=>'required', 'id'=>'c_type']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="start">Awal</label>
                    <input type="date" id="start" name="start" value="" 
                        class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="end">Akhir</label>
                    <input type="date" id="end" name="end" value="" 
                        class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Cetak</button>
    </div>
    {!! Form::close() !!}

</div>

@endsection


@extends('log-viewer::bootstrap-4.templateMaster')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>@lang('Dashboard')</h2>
        <div class="row">
            <div class="col-lg-10">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <strong>
                            <a>Dashboard</a>
                        </strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2 d-flex justify-content-end">
                <a href="{{ URL('/log-viewer/logs') }}">
                    <button class="btn btn-info btn-sm btn-outline" type=" button" style="padding: 5px 20px 5px 20px;">Logs</button>
                </a>
            </div>
        </div>

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row">
                        <div class="col-10">
                            <h5>Aktifitas user</h5>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
                        </div>

                        <div class="col-md-6 col-lg-9">
                            <div class="row">
                                @foreach($percents as $level => $item)
                                    <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                                        <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                                            <div class="box-icon">
                                                {!! log_styler()->icon($level) !!}
                                            </div>

                                            <div class="box-content">
                                                <span class="box-text">{{ $item['name'] }}</span>
                                                <span class="box-number">
                                                    {{ $item['count'] }} @lang('entries') - {!! $item['percent'] !!} %
                                                </span>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function() {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endsection

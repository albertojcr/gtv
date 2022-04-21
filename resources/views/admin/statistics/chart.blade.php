<div class="card card-chart">
<div class="card-header">
    <h4 class="card-title"><font
            style="vertical-align: inherit;"><font
                style="vertical-align: inherit;">{{$title}}</font></font></h4>
</div>
<div class="card-body">
    <div class="chart-area">
        <div class="chartjs-size-monitor"
             style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand"
                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div
                    style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink"
                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div
                    style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
        </div>
        {!! $model->container() !!}
    </div>
</div>
<div class="card-footer">
    <div class="stats">
        <i class="now-ui-icons ui-2_time-alarm"></i><font
            style="vertical-align: inherit;"><font
                style="vertical-align: inherit;"> Los últimos 7 días
            </font></font></div>
</div>
</div>
@push('scripts')
    {!!  $model->script() !!}
@endpush

@extends('adminlte::page')

@section('title', 'Error logs')

@push('css')
    <style>
        .error-logs .col-8 {
            display: table-cell;
            width: auto;
            padding-left: 10px;
            border: 1px dashed #807e7e;
            background: #ddd;
            vertical-align: top;
        }
        .row.error-logs {
            padding: 0 10px;
            display: table;
            width: 100%;
        }
        .error-logs .col-4 {
            display: table-cell;
            width: 35%;
            vertical-align: top;
        }
        .error-logs .col-4 .list-group{
            margin-right: 10px;
        }
        .info div {
            color: #b50e0e;
            font-size: 14px;
        }

        .info div span {
            font-family: Roboto-Bold;
            font-size: 17px;
            font-weight: bold;
            color: black;
        }
        .info {
            border-bottom: 1px solid #948a8a;
            margin-bottom: 10px;
            padding-bottom: 10px;
            margin-right: 10px;
        }
        .control-right{
            display: inline-block;
            right: 39px;
            position: absolute;
            top: 12px;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            $('#list-tab a:first').addClass('active');
            $('#nav-tabContent div:first').addClass('active');

            $('#list-tab a:first').tab('show');
            $('#list-tab a').click(function (e) {
                e.preventDefault();
                var href = $(this).attr('href');

                $('.list-group-item').removeClass('active');
                $(this).addClass('active');

                $('.tab-pane').removeClass('show active');
                $(href).addClass('show active');

                $(this).tab('show');
            });
        });
    </script>
@endpush

@section('content_header')
    <h1>Error logs</h1>
    <div class="control-right">
        <input type="button" class="button btn btn-danger btn-sm" onclick="event.preventDefault();document.getElementById('empty-error').submit();" value="Clear all"/>
        <form id="empty-error" action="{{ route('admin.application.emptyErrorLog') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
@stop

@section('content')
    <!-- List group -->
    <div class="row error-logs">
        @if($log->count())
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    @foreach($log AS $item)
                        <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-{{ $item->id }}" role="tab">
                            @if($item->message) {{ snippet($item->message,50) }} @else {{ snippet($item->request_uri, 50) }} @endif
                            <br>
                            <small>{{ fdate($item->create_date) }}</small>
                        </a>
                    @endforeach
                </div>
                <div class="row-no-padding pagination-box">
                    {{ $log->links('vendor.pagination.default') }}
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    @foreach($log AS $item)
                        <div class="tab-pane fade" id="list-{{ $item->id }}" role="tabpanel" aria-labelledby="list-home-list">
                            <div class="info">
                                <div class="message">{{ $item->message }}</div>
                                <div class="line"><span>Dòng phát sinh lỗi:</span> {{ $item->line }}</div>
                                <div class="url"><span>URL:</span> {{ $item->request_uri }}</div>
                                <div class="method"><span>Phương thức:</span> {{ $item->method }}</div>
                                <div class="code"><span>Mã lỗi trả về:</span> {{ $item->code }}</div>
                                <div class="param"><span>Params:</span> {{ $item->parameters }}</div>
                            </div>
                            <div class="trace">
                                <div class="trace">{!! nl2br(e($item->trace)) !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            Hiện tại hệ thống chưa ghi nhận lỗi nào.
        @endif
    </div>
@stop
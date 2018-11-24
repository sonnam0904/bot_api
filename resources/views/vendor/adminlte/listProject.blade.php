@extends('adminlte::page')

@section('title', 'Admin control panel')
@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))
@push('css')

@endpush

@section('content_header')
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



@stop

@section('content')
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Project Code</th>
            <th>Desscription</th>
            <th>Rank</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listData as $key => $value)
        <tr>
            <td>{{$key +1}}</td>
            <td>{{$value->Name}}</td>
            <td>{{$value->ProjectCode}}</td>
            <td>{{$value->Description}}</td>
            <td>{{App\Rank::getRankById($value->rank_id)}}</td>
            <td>
                <a href="editProject/{{$value->Id}}" title="" class="btn btn-success">Sửa</a>
                <a href="delProject/{{$value->Id}}" title="" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
            @endforeach
    </tbody>
</table>
    <div class="text-center">
        {{ $listData ->links('vendor.pagination.paginate', ['foo' => 'bar']) }}
    </div>
@stop

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

<div class="row">
    <form action="" method="get" accept-charset="utf-8">
        <div class="col-md-6">
            <label>Project Name</label>
            <input type="" name="Name" class="form-control" value="{{$listData->Name}}">
        </div>
        <div class="col-md-6">
            <label>Project Code</label>
            <input type="" name="" class="form-control" value="{{$listData->ProjectCode}}">
        </div>
    <div class="col-md-6">
            <label>Description</label>
            <input type="" name="" class="form-control" value="{{$listData->Description}}">
        </div>
    <div class="col-md-6">
            <label>Rank</label>
            <select name="rank_id" class="form-control">
                <option value="">Select Rank</option>
                @foreach($listRank as $key => $value)
                    <option value="{{$value->id}}">{{$value->rank_name}}</option>
                    @endforeach
            </select>
        </div>
    <div class="col-md-6">
            <button type="submit" class="btn btn-success">Lưu</button>
        </div>
    </form>
</div>


@stop

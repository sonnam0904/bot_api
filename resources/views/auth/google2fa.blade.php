@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Google2FA</div>

                <div class="panel-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                              {{session('error')}}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                              {{session('success')}}
                        </div>
                    @endif
                    @if(!count($data['user']->passwordSecurity))
                    <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                        {{ csrf_field() }}
                        <div class='col-md-8 col-md-offset-2'>
                            <button type='submit' class='btn btn-info'>Generate Secret Key</button>
                        </div>
                            
                    </form>    
                    @elseif(!$data['user']->passwordSecurity->google2fa_enable)
                    <p>Scan this barcode with the Google Authenticator App</p>
                    <img src="{{$data['google2fa_url']}}">
                    <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input id="verifyCode" type="password" name="verifyCode" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type='submit' class='btn btn-success'>Enable 2FA</button>
                            </div>
                        </div>
                    </form>    
                    @elseif($data['user']->passwordSecurity->google2fa_enable)
                    <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="password" class="form-control" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type='submit' class='btn btn-success'>Disable 2FA</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

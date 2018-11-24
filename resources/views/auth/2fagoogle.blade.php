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
                        
                   
                    <p></p>
                   
                    <form class="form-horizontal" method="POST" action="{{ route('2faVerify') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input id="one_time_password" type="password" name="one_time_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type='submit' class='btn btn-success'>Verify</button>
                            </div>
                        </div>
                    </form>    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

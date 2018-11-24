@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @stack('css')
@stop

@section('adminlte_js')
    <script src="{{ asset('js/adminlte/particles.js') }}"></script>
    <script>
        particlesJS("galary_div", {
            "particles": {
                "number": {
                    "value": 150,
                    "density": {
                        "enable": true,
                        "value_area": 562
                    }
                },
                "color": {
                    "value": "#fafffb"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 600
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 60,
                        "height": 60
                    }
                },
                "opacity": {
                    "value": 0.7,
                    "random": false,
                    "anim": {
                        "enable": true,
                        "speed": 0.5,
                        "opacity_min": 0.05,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 2,
                        "size_min": 0.8120772123013452,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 100,
                    "color": "#ffffff",
                    "opacity": 0.22096133965703635,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 0.3,
                    "direction": "bottom-right",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 100,
                        "line_linked": {
                            "opacity": 0.7
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @stack('js')
@stop

@section('body_class', 'login-page')

@section('body')
    <div id="galary_div" class="galary_div" style="position:fixed;width: 100%;height: 100%;background: black;top: 0;left: 0;"><canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;"></canvas></div>
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
            <div class="login-box-body">
                <div class="logo-mr" style="position: relative;text-align: center;padding-bottom: 10px;color:#fff;font-size: 40px;font-family: cursive;">Mun's shop</div>
                <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <input type="name" name="name" class="form-control" value="{{ old('name') }}"
                               placeholder="Tên đăng nhập">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('name'))
                            <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" name="password" class="form-control"
                               placeholder="Mật khẩu">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit"
                                    class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="auth-links">
                    <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                       class="text-center"
                    >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                    <br>
                    @if (config('adminlte.register_url', 'register'))
                        <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                           class="text-center"
                        >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                    @endif
                </div>
            </div>
    </div><!-- /.login-box -->
@stop


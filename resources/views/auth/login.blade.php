@extends('Layouts.UpdeRegis')
@section('URS')
    <div class="container paddingtop" dir="rtl">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">ورود</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group row pull-right col-md-12{{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-md-2 pull-right">
                                    <label for="username">نام کاربری</label>
                                </div>
                                <div class="col-md-5 pull-right">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="نام کاربری یا آدرس ایمیل">
                                    <small style="color: red">{{$errors->first('username')}}</small>
                                    <small style="color: red;">@if(isset($paincorrect)) {{$paincorrect}} @endif</small>
                                </div>



                            </div>

                            <div class="form-group row pull-right col-md-12{{ $errors->has('password') ? ' has-error' : '' }}">

                                <div class="col-md-2 text-right pull-right">
                                    <label for="password">رمز عبور</label>
                                </div>

                                <div class="col-md-5 pull-right">
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="کلمه ی عبور">
                                    <small style="color: red">{{$errors->first('password')}}</small>
                                    <small style="color: red;">@if(isset($usincorrect)) {{$usincorrect}} @endif</small>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="col-md-6 pull-right">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;مرا به خاطر بسپار
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 pull-right">
                                    <button type="submit" class="btn btn-primary">
                                        &nbsp;&nbsp;&nbsp;ورود&nbsp;&nbsp;&nbsp;
                                    </button>

                                    <a class="btn btn-link " href="{{ route('password.request') }}">
                                        رمز عبور را فراموش کرده ام
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

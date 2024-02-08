@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')

    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading ml-3">Login</div><br/>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group row col-md-12{{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-md-2">
                                    <label for="username">Username : </label>
                                </div>
                                <div class="col-md-5">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="username or email address">
                                    <small style="color: red">{{$errors->first('username')}}</small>
                                    <small style="color: red;">@if(isset($paincorrect)) {{$paincorrect}} @endif</small>
                                </div>



                            </div>

                            <div class="form-group row col-md-12{{ $errors->has('password') ? ' has-error' : '' }}">

                                <div class="col-md-2">
                                    <label for="password">Password : </label>
                                </div>

                                <div class="col-md-5">
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="enter password">
                                    <small style="color: red">{{$errors->first('password')}}</small>
                                    <small style="color: red;">@if(isset($usincorrect)) {{$usincorrect}} @endif</small>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remember-me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">
                                        &nbsp;&nbsp;&nbsp;Enter&nbsp;&nbsp;&nbsp;
                                    </button>

                                    <a class="btn btn-link " href="{{ route('password.request') }}">
                                        I forgot the password
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
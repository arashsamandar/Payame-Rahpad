@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="{{asset('js\ImageCropShow.js')}}"></script>
<script src="{{asset('js\cropit.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/cropIt.css')}}"/>
    @if(isset($aka))
        <div class="alert alert-success" style="text-align: center">
            <strong>user created successfully</strong>
        </div>
    @endif
    <div class="container" style="clear:both;margin-top: 10px">
        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="form1" role="form" method="post" enctype="multipart/form-data" action="">
                        <div class="image-editor">
                            <input type="file" id="userimage" name="userimage" class="cropit-image-input">
                            <div class="cropit-preview"><img src="{{asset('images/default1.jpg')}}" id="defaultimage" style="cursor:pointer;width:248px;height: 248px;" /></div>
                            <small style="color: red;">@foreach($errors->get('userimage') as $message )
                                    @if($message == 'The userimage failed to upload.')   <div style="color: red">Image file can not be more than 2 MB</div>
                                    @else {{$message}}
                                    @endif
                                @endforeach</small>
                            <div class="image-size-label">
                                Cut Image
                            </div>
                            <input type="range" class="cropit-image-zoom-input">
                            <input type="hidden" name="image-data" class="hidden-image-data" />
                        </div>
                        <div id="result" style="display: none">
                            <code>$form.serialize() =</code>
                            <code id="result-data"></code>
                        </div>
                        <div class="row" style="clear: both">
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="1" maxlength="25" type="text" id="name" name="name" value="{{old('name')}}"  class="form-control input-md floatlabel" placeholder="Name">
                                    <small style="color: red;">@foreach($errors->get('name') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="2" maxlength="25" type="text" id="family" name="family" value="{{old('family')}}"  class="txtOnly form-control input-md" placeholder="Family">
                                    <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="3" id="username" type="text" maxlength="25" name="username" value="{{old('username')}}" class="form-control input-md" placeholder="Username">
                                    <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                                    <small id="usernamewarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="7" id="email" type="email" maxlength="40" name="email" value="{{old('email')}}" class="form-control input-md floatlabel" placeholder="Email-Address">
                                    <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                                    <small id="emailwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="9" id="pass" type="password" maxlength="60" name="password" value="{{old('password')}}" class="form-control input-md" placeholder="Password">
                                    <small style="color: red;">@foreach($errors->get('password') as $message ) {{$message}}   @endforeach</small>
                                    <small id="passwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="10" id="passconf" maxlength="60" type="password" name="password_confirmation" class="form-control input-md" placeholder="Confirm password">
                                    <small id="passconfwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="Register" class="btn btn-success btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
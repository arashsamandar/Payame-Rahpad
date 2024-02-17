@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')
    <title>Users Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css\cropIt.css')}}"/>
    <link rel="stylesheet" href="{{asset('css\modalConfigs.css')}}" />
    <link rel="stylesheet" href="{{asset('css\dropDownForUsersPage.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js\ImageCropShow.js')}}"></script>
    <script src="{{asset('js\cropit.js')}}"></script>
    @if(isset($aka))
        <div class="alert alert-success" style="text-align: center">
            <strong>user edited successfully</strong>
        </div>
    @endif
    <br/>
    <div class="container" style="padding-top: 10px">
        <div>
            <div class="panel panel-default" style="margin-right: 30px !important;">
                <div class="panel-body">
                    <form id="updateform" role="form" method="post" enctype="multipart/form-data" action="">
                            <div class="image-editor">
                                <input type="file" id="userimage" name="userimage" class="cropit-image-input">
                                <div class="cropit-preview">
                                    @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
                                        <img id="defaultimage" src="{{ route('userimage',['id' => Auth::user()->id  ])}}" style="cursor:pointer;width:248px;height: 248px;" />
                                    @else
                                        <img id="defaultimage" src="{{asset('images\default1.jpg')}}" style="cursor:pointer;width:248px;height: 248px;" />
                                    @endif
                                </div>
                                <small style="color: red;">
                                    @foreach($errors->get('userimage') as $message )
                                        @if($message == 'The userimage failed to upload.')   <div style="color: red">Maximum site is 2 MB</div>
                                        @else {{$message}}
                                        @endif
                                    @endforeach</small>
                                <div class="image-size-label">
                                    Cut image
                                </div>
                                <input type="range" class="cropit-image-zoom-input" style="width: 25%;margin-bottom: 20px">
                                <input type="hidden" name="image-data" class="hidden-image-data" />
                            </div>
                        <div class="row" style="clear: both">
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="1" maxlength="25" type="text" id="name" name="name" value="{{Auth::user()->name}}"  class="form-control input-md floatlabel" placeholder="name">
                                    <small style="color: red;">@foreach($errors->get('name') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="2" maxlength="25" type="text" id="family" name="family" value="{{Auth::user()->family}}"  class="txtOnly form-control input-md" placeholder="family">
                                    <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="3" id="username" type="text" maxlength="25" readonly="true" name="username" value="{{Auth::user()->username}}" class="form-control input-md" placeholder="username">
                                    <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                                    <small id="username" style="display: none;color: red;">****</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="7" id="email" type="email" maxlength="40" name="email" value="{{Auth::user()->email}}" class="form-control input-md floatlabel" placeholder="email address">
                                    <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                                    <small id="emailwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>
                        </div>

                        <input type="submit" name="submit" value="Save" class="btn btn-info btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
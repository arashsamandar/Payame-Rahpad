@extends('Layouts.UpdeRegis')
@section('URS')
    <style>
        .ui-datepicker .ui-datepicker-title select {
            color: #000;
        }
        .btn-info {
            background-color: #002A39 !important;
        }
        .btn-info:hover {
            background-color: #17a2b8 !important;
        }
    </style>

    <br><br><br>
    @if(isset($aka))
        <div class="alert alert-success" style="text-align: center">
            <strong>user edited successfully</strong>
        </div>
    @endif
    <div class="container" style="padding-top: 10px">
        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="updateform" role="form" method="post" enctype="multipart/form-data" action="">
                            <div class="image-editor" style="float: right">
                                <input type="file" id="userimage" name="userimage" class="cropit-image-input">
                                <div class="cropit-preview">
                                    @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
                                        <img id="defaultimage" src="{{ route('userimage',['id' => Auth::user()->id  ])}}" style="cursor:pointer;width:248px;height: 248px;" />
                                    @else
                                        <img id="defaultimage" src="{{asset('images\default1.jpg')}}" style="cursor:pointer;width:248px;height: 248px;" />
                                    @endif
                                </div>
                                <small style="color: red;">@foreach($errors->get('userimage') as $message )
                                                               @if($message == 'The userimage failed to upload.')   <div style="color: red">Maximum site is 2 MB</div>
                                                               @else {{$message}}
                                                               @endif
                                                   @endforeach</small>
                                <div class="image-size-label">

                                    Cut image
                                </div>
                                <input type="range" class="cropit-image-zoom-input">
                                <input type="hidden" name="image-data" class="hidden-image-data" />
                            </div>

                        <div class="row" dir="rtl" style="clear: both">
                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="2" maxlength="25" type="text" id="family" name="family" value="{{Auth::user()->family}}"  class="txtOnly form-control input-md" placeholder="family">
                                    <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="1" maxlength="25" type="text" id="name" name="name" value="{{Auth::user()->name}}"  class="form-control input-md floatlabel" placeholder="name">
                                    <small style="color: red;">@foreach($errors->get('name') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>

                        </div>

                        <div class="row" dir="rtl">

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="4" type="text" name="birth_date" id="bd" value="{{Auth::user()->birth_date}}"  class="form-control input-md floatlabel" placeholder="birth-date">
                                    <small style="color: red;">@foreach($errors->get('birth_date') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-md-6 col-md-6">
                                <div class="form-group">
                                    <input tabindex="3" id="username" type="text" maxlength="25" readonly="true" name="username" value="{{Auth::user()->username}}" class="form-control input-md" placeholder="username">
                                    <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                                    <small id="username" style="display: none;color: red;">****</small>
                                </div>
                            </div>

                        </div>

                        <div class="row" dir="rtl">

                            <div class="col-md-4 col-md-4 col-md-4">
                                <div class="form-group">
                                    <select name="gender" tabindex="6" id="gen" value="{{Auth::user()->gender}}" class="form-control" placeholder="gender">
                                        <option value="آقا">آقا</option>
                                        <option value="خانم">خانم</option>
                                        <option selected value="{{Auth::user()->gender}}">{{Auth::user()->gender}}</option>
                                    </select>
                                    <small style="color: red;">@foreach($errors->get('gender') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>

                            <div class="col-md-8 col-md-8 col-md-8">
                                <div class="form-group">
                                    <input tabindex="5" id="nac" type="number" min="0" step="1" data-bind="value:nac" name="national_code" value="{{Auth::user()->national_code}}" class="form-control input-md floatlabel" placeholder="national id">
                                    <small style="color: red;">@foreach($errors->get('national_code') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>

                        </div>

                        <div class="row" dir="rtl">

                            <div class="col-md-4 col-md-4 col-md-4">
                                <div class="form-group">
                                    <input tabindex="8" type="number" min="0" step="1" data-bind="value:cell" id="cell" maxlength="11" name="cell_phone"  value="{{Auth::user()->cell_phone}}" class="form-control input-md" placeholder="phone">
                                    <small style="color: red;">@foreach($errors->get('cell_phone') as $message ) {{$message}}   @endforeach</small>
                                </div>
                            </div>

                            <div class="col-md-8 col-md-8 col-md-8">
                                <div class="form-group">
                                    <input tabindex="7" id="email" type="email" maxlength="40" name="email" value="{{Auth::user()->email}}" class="form-control input-md floatlabel" placeholder="email address">
                                    <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                                    <small id="emailwarn" style="display: none;color: red;">****</small>
                                </div>
                            </div>

                        </div>

                        <input type="submit" name="submit" value="Save" class="btn btn-info">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
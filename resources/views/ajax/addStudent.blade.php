<link rel="stylesheet" href="{{asset('css\progressStyle.css')}}" />
<script>
    function closestore() {
        $('#myModal').modal('hide');
    }
</script>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 50px;">
            <div class="modal-header">
                <h4 class="modal-title">َAdd new user</h4>
            </div>
            <a class="btn btn-default" id="add_new_image">add image</a>
            <br><br>
            <form id="frm-insert" role="form" method="post" action="{{ URL::to('student/store') }}">
                <input type="hidden" name="usercropedimage" id="usercropedimage" class="usercropedimage" />
                <div class="row"  style="clear: both">
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="1" maxlength="25" type="text" id="name" name="name" value="{{old('name')}}"  class="form-control input-md floatlabel" placeholder="name">
                            <small style="color: red;">@foreach($errors->get('name') as $message ) {{$message}}   @endforeach</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="2" maxlength="25" type="text" id="family" name="family" value="{{old('family')}}"  class="txtOnly form-control input-md" placeholder="family">
                            <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                        </div>
                    </div>
                </div>
                <style>
                    .datepicker thead tr:first-child th {
                        color: #5bc0de;
                    }
                    .datepicker th.next {
                    .glyphicon .glyphicon-chevron-left;
                    }
                    .prev {
                    .glyphicon .glyphicon-chevron-left;
                    }
                </style>
                <div class="row">
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="3" id="username" type="text" maxlength="25" name="username" value="{{old('username')}}" class="form-control input-md" placeholder="username">
                            <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                            <small id="usernamewarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="7" id="email" type="email" maxlength="40" name="email" value="{{old('email')}}" class="form-control input-md floatlabel" placeholder="email address">
                            <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                            <small id="emailwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="9" id="pass" type="password" maxlength="60" name="password" value="{{old('password')}}" class="form-control input-md" placeholder="password">
                            <small style="color: red;">@foreach($errors->get('password') as $message ) {{$message}}   @endforeach</small>
                            <small id="passwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="10" id="passconf" maxlength="60" type="password" name="password_confirmation" class="form-control input-md" placeholder="password confirmation">
                            <small id="passconfwarn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                </div>
                <br/>
                <progress id="updateProg" max="100" value="0" style="display: none;"></progress>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="button" value="Back" onclick="closestore()" data-backdrop="false" class="btn btn-danger btn-block"  />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="submit" name="submit" value="Save" class="btn btn-success btn-block">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
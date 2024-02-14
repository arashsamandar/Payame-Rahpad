<script>
    function arash() {
        $('.cropit-preview-image').attr('src','');

        $("input#image-data").cropit('destroy');

        $('#student-update').modal('hide');
    }

    $(document).on('show.bs.modal','#student-update', function () {
        $("#userimagee").value = "";
        $("input#image-data").cropit('destroy');
        $("input#usercropedimage").cropit('destroy');
    });

    $(document).on('hidden.bs.modal','#myModal', function () {
        $("#userimagee").value = "";
        $("input#image-data").cropit('destroy');
        $("input#usercropedimage").cropit('destroy');
    });

</script>
<style>
    .modal-content {
        visibility: hidden;
        position: absolute;
        top: -9999px;
    }
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

<div id="student-update" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="padding: 50px;">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
            </div>
            <a class="btn btn-default" id="add_new_imagee">change image</a>
                    <div><img src="" alt="" id="defaultimagee" name="defaultimagee" style="cursor:pointer;width:248px;height: 248px;" /></div>
<br>

            <form id="frm-update" role="form" method="post" action="{{ URL::to('student/update') }}">
                <input type="hidden" name="id" id="id" />
                <input type="hidden" name="usercropedimagee" id="usercropedimagee" class="usercropedimage" />
                <div class="row"  style="clear: both">
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="1" maxlength="25" type="text" id="namee" name="name" value="{{old('name')}}"  class="form-control input-md floatlabel" placeholder="name">
                            <small style="color: red;">@foreach($errors->get('name') as $message ) {{$message}}   @endforeach</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="2" maxlength="25" type="text" id="familyy" name="family" value="{{old('family')}}"  class="txtOnly form-control input-md" placeholder="family">
                            <small style="color: red;">@foreach($errors->get('family') as $message ) {{$message}}   @endforeach</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="3" id="usernamee" readonly="readonly" type="text" maxlength="25" name="username" value="{{old('username')}}" class="form-control input-md" placeholder="username">
                            <small style="color: red;">@foreach($errors->get('username') as $message ) {{$message}}   @endforeach</small>
                            <small id="usernamewarnn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-6 col-md-6">
                        <div class="form-group">
                            <input tabindex="4" disabled type="text" name="birth_date" id="bdd" value="{{old('birth_date')}}"  class="form-control input-md floatlabel" placeholder="birth date">
                            <small style="color: red;">@foreach($errors->get('birth_date') as $message ) {{$message}}   @endforeach</small>
                            <small id="bdwarnn" style="display: none;color: red;">فرمت تاریخ صحیح نیست</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-8 col-md-8">
                        <div class="form-group">
                            <input tabindex="5" id="nacc" type="number" disabled min="0" step="1" data-bind="value:nac" name="national_code" value="{{old('national_code')}}" class="form-control input-md floatlabel" placeholder="national id">
                            <small style="color: red;">@foreach($errors->get('national_code') as $message ) {{$message}}   @endforeach</small>
                            <small id="nacwarnn" style="display: none;color: red;">کد ملی نمی تواند کمتر از 10 رقم باشد</small>
                            <small id="nacwarnmoree" style="display: none;color: red;">کد ملی نمی تواند بیشتر از 10 رقم باشد</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-4 col-md-4">
                        <div class="form-group">
                            <select name="gender" disabled id="genderr" tabindex="6" class="form-control" placeholder="gender">
                                <option value="آقا">آقا</option>
                                <option value="خانم">خانم</option>
                                <option selected disabled value="">gender</option>
                            </select>
                            <small style="color: red;">@foreach($errors->get('gender') as $message ) {{$message}}   @endforeach</small>
                            <small id="genwarnn" style="display: none;color: red;">جنسیت خود را انتخاب کنید</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-8 col-md-8">
                        <div class="form-group">
                            <input tabindex="7" id="emaill" type="email" maxlength="40" name="email" value="{{old('email')}}" class="form-control input-md floatlabel" placeholder="email address">
                            <small style="color: red;">@foreach($errors->get('email') as $message ) {{$message}}   @endforeach</small>
                            <small id="emailwarnn" style="display: none;color: red;">****</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-4 col-md-4">
                        <div class="form-group">
                            <input tabindex="8" id="celll" type="number" disabled min="0" step="1" data-bind="value:cell" maxlength="11" name="cell_phone"  value="{{old('cell_phone')}}" class="form-control input-md" placeholder="phone number">
                            <small style="color: red;">@foreach($errors->get('cell_phone') as $message ) {{$message}}   @endforeach</small>
                            <small id="cellwarnn" style="display: none;color: red;">شماره تلفن نمی تواند کمتر از 11 رقم باشد</small>
                            <small id="cellwarnmoree" style="display: none;color: red;">شماره تلفن نمی تواند بیشتر از 11 رقم باشد</small>
                        </div>
                    </div>
                </div>
                <progress id="updateProg" max="100" value="0" style="display: none"></progress>
                <div class="row modal-footer">
                    <br>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" value="Back" onclick="arash()" data-dismiss="modal" class="btn btn-danger btn-block"  />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" name="submit" value="Save" class="btn btn-success btn-block">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
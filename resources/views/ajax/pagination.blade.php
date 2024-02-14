@include('ajax.updateStudent')
@include('ajax.addStudent')
@include('ajax.updatepass')
@include('ajax.AccessUser')
@include('ajax.cheangeimage')
@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
<link rel="stylesheet" href="{{asset('css\cropIt.css')}}"/>
<link rel="stylesheet" href="{{asset('css\modalConfigs.css')}}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('js\ImageCropShow.js')}}"></script>
<script src="{{asset('js\cropit.js')}}"></script>
<script src="{{asset('js\showHideModals.js')}}" ></script>
    <div id="doloading" class="modal fade bd-example-modal-lg" style="visibility: visible;position: static;top:auto" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>operation done with success</strong>
    </div>

    <div class="alert alert-warning" id="warning-alert" style="display: none">
        <strong>you don't have access to other users</strong>
    </div>

    <div class="alert alert-warning" id="create-alert" style="display: none">
        <strong>you don't have permission to create user</strong>
    </div>

    <div class="alert alert-danger" id="remove-alert" style="display: none">
        <strong>user removed successfully</strong>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12"><br>
                <div class="panel panel-default border" style="margin-right: 30px !important;">
                    <div class="panel-heading text-center border body">Users</div>
                    <div>
                        <form method="post" action="{{route('searchName')}}" class="form-horizontal" id="formSearch">
                            <div class="input-group">
                               <input type="text" class="form-control" name="contactname" id="txtSearch" placeholder="type username and press enter to show">
                               <span class="input-group-btn">
                                    <button id="btnSearch" type="submit" style="border: none">
                                    <i class="btn btn-info btn-md" style="width: 70px;font-size: 12px">Search</i> </button>
                               </span>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body" id="posts">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th class="text-center" style="font-size: 12px;font-weight: bold">Email</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Username</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Family</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Name</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Operation</th>

                            </tr>
                            </thead>
                            <tbody id="student-info" class="text-center" style="font-size: 12px">
                            @foreach($contacts as $value)

                                <tr id="{{$value->id}}">
                                    <td style="font-size: 12px">{{$value->email}}</td>
                                    <td style="font-size: 12px">{{$value->username}}</td>
                                    <td style="font-size: 12px">{{$value->family}}</td>
                                    <td style="font-size: 12px">{{$value->name}}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="{{$value->id}}">Password</a>
                                        <a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="{{$value->id}}">Edit user</a>
                                        <a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="{{$value->id}}">Access</a>
                                        <a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="{{$value->id}}">Remove</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a href="#" class="btn btn-success" id="addoneuser">Add new user</a>
                           </span>
                            <div style="float: right">
                                {{ $contacts->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>

    <script type="text/javascript">
        var universal = null;
        $(function () {
            $("#success-alert").hide();
        });

        $('#add_new_image').click(function (e) {
            $('#changeimage').modal('show');
        });

        $('#add_new_imagee').click(function (e) {
            $('#changeimage').modal('show');
        });

        //-------------------------------------Show User Password------------------------------------

        $('body').delegate('#student-info #view','click',function (e) {
            var id = $(this).data('id');
            var url = "{{ URL::to('student/showpassword') }}" + "?id=" + encodeURIComponent(id);
            modal();
            e.preventDefault();
            $.ajax({
                type:'GET',
                url:url,
                success:function (data) {
                    hidmodal();
                    if(data === 'fail') {
                        $('#warning-alert').css('display','block');
                        $("#warning-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#warning-alert").slideUp(500);
                        });
                    } else {
                        $('#changingpass').find('#id').val(data.id);
                        $('#changingpass').find('#passs').val(data.name);
                        $('#changingpass').find('#passconff').val(data.name);
                        $('#changingpass').modal('show');
                    }
                }
            });
        });

        //-----------------------------Do User Password------------------------------------

        $('#changepass').on('submit',function (e) {
            var userpass = $('#password').val();
            var userid = $('#changingpass').find('#id').val();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type:post,
                url:url,
                data:{mypass : userpass,myid : userid},
                dataty:'json',
                beforeSend:function () {
                    $('#changingpass').find('#updateProg').css('display','block');
                    $('#changingpass').find('#updateProg').attr('value',0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#changingpass').find('#updateProg').attr('value',percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success:function (data) {
                    $('#changingpass').find('#updateProg').css('display','none');
                    $('#changingpass').find('#updateProg').attr('value',0);
                    $('#changingpass').modal('hide');
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });

        //-----------------------------------Show Add New User-------------------------------

        $('body').delegate('#addoneuser','click',function (e) {
            var url = "{{ URL::to('student/addNewStudent') }}";
            modal();
            e.preventDefault();
            $.ajax({
                type:'GET',
                url:url,
                success:function (data) {
                    hidmodal();
                    if(data === 'fail') {
                        $('#create-alert').css('display','block');
                        $("#create-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#create-alert").slideUp(500);
                        });
                    } else {
                        $('#myModal').modal('show');
                    }
                }
            });
        });

        //------------------------------------Do Add New User-----------------------------------

        $('#frm-insert').on('submit',function (e) {
            universal = null;
            if($('#userimage').val() !== "") {
                universal = null;
                $('#frm-insert').passdata = null;
                $('#cropitbaby').on('submit', function (e) {
                    e.preventDefault();
                });
                $('#cropitbaby').submit();
                universal = $("input#image-data").val();
                console.log(universal);
            }
            $("input#usercropedimage").val(universal);
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type:post,
                url:url,
                data:data,
                dataty:'json',
                beforeSend:function () {
                    $('#myModal').find('#updateProg').css('display','block');
                    $('#myModal').find('#updateProg').attr('value',0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#myModal').find('#updateProg').attr('value',percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success:function (data) {
                    if(data === 'fail') {
                        $('#myModal').find('#updateProg').css('display','none');
                        $('#myModal').find('#updateProg').attr('value',0);
                        $('#create-alert').css('display','block');
                        $("#create-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#create-alert").slideUp(500);
                        });
                    } else {
                        $('#myModal').find('#updateProg').css('display','none');
                        $('#myModal').find('#updateProg').attr('value',0);
                        $('#myModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        var tr = $('<tr/>', {
                            id: data.id
                        });
                        tr.append($('<td/>', {
                            text: data.email
                        })).append($('<td/>', {
                            text: data.username
                        })).append($('<td/>', {
                            text: data.family
                        })).append($('<td/>', {
                            text: data.name
                        })).append($('<td/>', {
                            html: '<a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="' + data.id + '">Password</a> '
                                + '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">Edit user</a> ' +
                                '<a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="' + data.id + '">Access</a> ' +
                                '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">Remove</a>'
                        }));
                        $('#userimage').val('');
                        universal = null;
                        $('#student-info').append(tr);
                        $('#success-alert').css('display','block');
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#success-alert").slideUp(500);
                        });
                    }
                }
            });
        });

        //----------------------------------Delete User--------------------------------------

        $('body').delegate('#student-info #del','click',function (e) {
            var id = $(this).data('id');
            var url = "{{URL::to("student/destroy")}}" + "?id=" + encodeURIComponent(id);
            modal();
            e.preventDefault();
            $.ajax({
                type:'POST',
                url:url,
                success:function (data) {
                    hidmodal();
                    if(data === 'fail') {
                        hidmodal();
                        $('#warning-alert').css('display','block');
                        $("#warning-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#warning-alert").slideUp(500);
                        });
                    } else {
                        hidmodal();
                        $('tr#'+id).remove();
                        $('#remove-alert').css('display','block');
                        $("#remove-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#remove-alert").slideUp(500);
                        });
                    }
                }
            });
        });

        //---------------------------------Show User Access----------------------------------------

        $('body').delegate('#student-info #chaccess','click',function (e) {
            var id = $(this).data('id');
            var url = "{{URL::to('student/showaccess')}}" + "?id=" + encodeURIComponent(id);
            var post = $(this).attr('method');
            modal();
            e.preventDefault();
            $.ajax({
                type:'GET',
                url:url,
                success:function (data) {
                    if(data === 'fail') {
                        hidmodal();
                        $('#warning-alert').css('display','block');
                        $("#warning-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#warning-alert").slideUp(500);
                        });
                    } else {
                        hidmodal();
                        if(data) {
                            $('#frm-access').find('#id').val(data.id);
                            $('#frm-access').find('#thisusername').text(data.username);
                            $('#frm-access').find('#thisuser_name').text(data.name + ' ' + data.family);
                            if (data[0].acuser === 1) {
                                $('#user-access').find('#access_managing_users').prop("checked", true);
                            } else {
                                $('#user-access').find('#access_managing_users').prop("checked", false);
                            }

                            if (data[0].accont === 1) {
                                $('#user-access').find('#access_managing_contents').prop("checked", true);
                            } else {
                                $('#user-access').find('#access_managing_contents').prop("checked", false);
                            }

                            $('#user-access').modal('show');
                        }
                    }
                }
            });
        });

        //---------------------------------Change User access------------------------------------------

        $('#frm-access').on('submit',function (e) {
            var userid = $('#user-access').find('#id').val();
            access_user_area = 0;
            access_content_area = 0;
            if($('#user-access').find('#access_managing_users').prop("checked") ==  true) {
                access_user_area = 1;
            } else {access_user_area = 0;}
            if($('#user-access').find('#access_managing_contents').prop("checked") ==  true) {
                access_content_area = 1;
            } else {access_content_area = 0;}
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type:post,
                url:url,
                data:{this_user_id:userid,allow_user_area:access_user_area,allow_content_area:access_content_area},
                beforeSend:function () {
                    $('#user-access').find('#updateProg').css('display','block');
                    $('#user-access').find('#updateProg').attr('value',0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#user-access').find('#updateProg').attr('value',percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success:function (data) {
                    if(data === 'fail') {
                        $('#user-access').find('#updateProg').css('display','none');
                        $('#user-access').find('#updateProg').attr('value',0);
                        $('#user-access').modal('hide');
                        $('#access-alert').css('display','block');
                        $("#access-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#access-alert").slideUp(500);
                        });
                    } else {
                        $('#user-access').find('#updateProg').css('display','none');
                        $('#user-access').find('#updateProg').attr('value',0);
                        $('#user-access').modal('hide');
                        $('#success-alert').css('display','block');
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#success-alert").slideUp(500);
                        });
                    }

                }
            });
        });

        //---------------------------------Show Update User----------------------------------------


        $('body').delegate('#student-info #edit','click',function (e) {
            var id = $(this).data('id');
            var url = "{{ URL::to('users/edit') }}" + "?id=" + encodeURIComponent(id);
            var post = $(this).attr('method');
            modal();
            e.preventDefault();
            $.ajax({
                type:'GET',
                url:url,
                success:function (data) {
                    if(data === 'fail') {
                        hidmodal();
                        $('#warning-alert').css('display','block');
                        $("#warning-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#warning-alert").slideUp(500);
                        });
                    } else {
                        hidmodal();
                        $('#frm-update').find('#id').val(data.id);
                        $('#frm-update').find('#namee').val(data.name);
                        $('#frm-update').find('#familyy').val(data.family);
                        $('#frm-update').find('#usernamee').val(data.username);
                        $('#frm-update').find('#bdd').val(data.birth_date);
                        $('#frm-update').find('#celll').val(data.cell_phone);
                        $('#frm-update').find('#nacc').val(data.national_code);

                        $('#frm-update').find('#emaill').val(data.email);
                        $('#frm-update').find('#genderr').val(data.gender);
                        universal = data[0].image;

                        if(typeof data[0] !== 'undefined') {

                            $('#defaultimagee').attr('src', data[0].image);

                        }

                        $('#student-update').modal('show');
                    }
                }
            });
        });


        //---------------------------------Do Update User----------------------------------------


        $('#frm-update').on('submit',function (e) {
            if($("#userimage").val() !== "") {
                universal = null;
                $('#frm-insert').passdata = null;
                $('#cropitbaby').on('submit',function (e) {
                    e.preventDefault();
                });
                $('#cropitbaby').submit();
                universal = $("input#image-data").val();
//                console.log(universal);
                $("input#usercropedimagee").val(universal);
            }

            $("input#usercropedimagee").val(universal);
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            e.preventDefault();
            $.ajax({
                type: post,
                url: url,
                data: data,
                dataty:'json',
                beforeSend:function () {
                    $('#student-update').find('#updateProg').css('display','block');
                    $('#student-update').find('#updateProg').attr('value',0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#student-update').find('#updateProg').attr('value',percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    $('#student-update').find('#updateProg').css('display','none');
                    $('#student-update').find('#updateProg').attr('value',0);
                    $('#student-update').modal('hide');
                    var tr = $('<tr/>',{
                        id : data.id
                    });
                    tr.append($('<td/>',{
                        text:data.email
                    })).append($('<td/>',{
                        text:data.username
                    })).append($('<td/>',{
                        text:data.family
                    })).append($('<td/>',{
                        text:data.name
                    })).append($('<td/>',{
                        html : '<a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="' + data.id + '">Password</a> '
                            + '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">Edit user</a> ' +
                            '<a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="' + data.id + '">Access</a> ' +
                            '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">Remove</a>'
                    }));

                    $('#userimage').val('');
                    universal = null;

                    $('#student-info tr#' + data.id).replaceWith(tr);
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                }
            });
        });

        //------------------------------------Search User-----------------------------------

        $('#formSearch').on('submit', function (e) {
            e.preventDefault();
            var name = $('#txtSearch').val();
            var url = $('#formSearch').attr('action');
            var post = $('#formSearch').attr('method');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: post,
                url: url,
                data: {name: name},
                success: function (data) {
                    $('#success-alert').css('display','block');
                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert").slideUp(500);
                    });
                    var arr = Object.values(data);

                    $('#frm-update').find('#id').val(arr[0]['id']);
                    $('#frm-update').find('#namee').val(arr[0]['name']);
                    $('#frm-update').find('#familyy').val(arr[0]['family']);
                    $('#frm-update').find('#bdd').val(arr[0]['birth_date']);
                    $('#frm-update').find('#usernamee').val(arr[0]['username']);
                    $('#frm-update').find('#nacc').val(arr[0]['national_code']);
                    $('#frm-update').find('#emaill').val(arr[0]['email']);
                    $('#frm-update').find('#genderr').val(arr[0]['gender']);
                    $('#frm-update').find('#celll').val(arr[0]['cell_phone']);

                    universal = data[1]['image'];

                    if(typeof data[0] !== 'undefined') {

                        $('#defaultimagee').attr('src', data[1]['image']);

                    }

                    $('#student-update').modal('show');

                }
                ,error :function (e) {
                    $('#warning-alert').css('display','block');
                    $("#warning-alert").fadeTo(2000, 500).slideUp(500, function() {
                        $("#warning-alert").slideUp(500);
                    });
                }
            })
        })

    </script>



    <script>
        //---------------------------------------Relates to Pagination part-----------------------------------
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>

@endsection
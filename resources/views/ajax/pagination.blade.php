@include('ajax.updateStudent')
@include('ajax.addStudent')
@include('ajax.updatepass')
@include('ajax.AccessUser')
@include('ajax.cheangeimage')
@extends('Layouts.UpdeRegis')

@section('URS')
    {{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        .modal { overflow: auto !important; }

        .bd-example-modal-lg .modal-dialog{
            display: table;
            position: relative;
            margin: 0 auto;
            top: calc(50% - 24px);
        }

        .bd-example-modal-lg .modal-dialog .modal-content{
            background-color: transparent;
            border: none;
        }
    </style>
    <script>
        function modal(){
            $('#doloading').modal('show');
        }
        function hidmodal() {
            $('#doloading').modal('hide');
        }
    </script>
    <div id="doloading" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>عملیات با موفقیت انجام شد</strong>
    </div>

    <div class="alert alert-warning" id="warning-alert" style="display: none">
        <strong>شما اجازه ی دسترسی به کاربران دیگر را ندارید</strong>
    </div>

    <div class="alert alert-warning" id="create-alert" style="display: none">
        <strong>شما جازه ی ایجاد کاربر جدید ندارید</strong>
    </div>

    <div class="alert alert-danger" id="remove-alert" style="display: none">
        <strong>کاربر حذف شد</strong>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">کاربران</div>
                    <div dir="rtl">
                        <form method="post" action="{{route('searchName')}}" class="form-horizontal" id="formSearch">
                            <div class="input-group">
                                <input type="text" class="form-control" name="contactname" id="txtSearch">
                               <span class="input-group-btn">
                                   <button id="btnSearch" type="submit" style="border: none">
                                <i class="btn btn-info btn-md" style="width: 70px;font-size: 12px">جستجو</i> </button>
                               </span>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body" id="posts">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th class="text-center" style="font-size: 12px;font-weight: bold">انجام عملیات</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">شماره تلفن</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">پست الکترونیکی</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تاریخ ایجاد</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">جنسیت</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام کاربری</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام خانوادگی</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام</th>

                            </tr>
                            </thead>
                            <tbody id="student-info" class="text-center" style="    font-size: 12px">
                            @foreach($contacts as $value)

                                <tr id="{{$value->id}}">

                                    <td>

                                        <a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="{{$value->id}}">تغییر رمز</a>
                                        <a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="{{$value->id}}">ویرایش</a>
                                        <a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="{{$value->id}}">دسترسی ها</a>
                                        <a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="{{$value->id}}">حذف</a>

                                    </td>

                                    <td style="font-size: 12px">{{$value->cell_phone}}</td>
                                    <td style="font-size: 12px">{{$value->email}}</td>
                                    <td style="font-size: 12px">{{$value->created_at_shamsi}}</td>
                                    <td style="font-size: 12px">{{$value->gender}}</td>
                                    <td style="font-size: 12px">{{$value->username}}</td>
                                    <td style="font-size: 12px">{{$value->family}}</td>
                                    <td style="font-size: 12px">{{$value->name}}</td>


                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <div style="float: left">
                                {{ $contacts->render() }}
                            </div>
                            <span class="input-group-btn">
                              <a href="#" class="btn btn-success" id="addoneuser">کاربر جدید</a>
                           </span>
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
                            html: '<a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="' + data.id + '">تغییر رمز</a> '
                            + '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                            '<a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="' + data.id + '">دسترسی ها</a> ' +
                            '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                        })).append($('<td/>', {
                            text: data.cell_phone
                        })).append($('<td/>', {
                            text: data.email
                        })).append($('<td/>', {
                            text: data.created_at_shamsi
                        })).append($('<td/>', {
                            text: data.gender
                        })).append($('<td/>', {
                            text: data.username
                        })).append($('<td/>', {
                            text: data.family
                        })).append($('<td/>', {
                            text: data.name
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
                        html : '<a href="#" class="btn btn-info btn-sm" style="width: 70px;font-size: 12px" id="view" data-id="' + data.id + '">تغییر رمز</a> '
                        + '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                        '<a href="#" class="btn btn-warning btn-sm" style="width: 70px;font-size: 12px" id="chaccess" data-id="' + data.id + '">دسترسی ها</a> ' +
                        '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                    })).append($('<td/>',{
                        text:data.cell_phone
                    })).append($('<td/>',{
                        text:data.email
                    })).append($('<td/>',{
                        text:data.created_at_shamsi
                    })).append($('<td/>',{
                        text:data.gender
                    })).append($('<td/>',{
                        text:data.username
                    })).append($('<td/>',{
                        text:data.family
                    })).append($('<td/>',{
                        text:data.name
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
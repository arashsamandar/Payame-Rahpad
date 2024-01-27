@include('ajax.UpdateContent')
@include('ajax.AddContentImages')
@extends('Layouts.UpdeRegis')

@section('URS')
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

        .btn span.glyphicon {
            opacity: 0;
        }
        .btn.active span.glyphicon {
            opacity: 1;
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
        <strong>پیام ذخیره شد</strong>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">پیام ها</div>
                    <div class="panel-body" id="posts">
                        <table class="table table-bordered" id="message_table">
                            <thead>
                            <tr>

                                <th class="text-center" style="font-size: 12px;font-weight: bold">وضعیت محتوا</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">پیام مدیریت</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">پیام شما</th>

                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @foreach($messages as $message)

                                <tr id="{{$message->id}}" style="cursor: pointer" onclick="showMessages({{$message->id}})"
                                    @if($message->user_seen == 0) bgcolor="#EEE" @endif
                                    @if(\App\Http\Controllers\AjaxMessageController::change_message_color($message->id) == 1) bgcolor=#E7FFE5 @endif
                                    @if(\App\Http\Controllers\AjaxMessageController::change_message_color($message->id) == 2) bgcolor=#FFEBE5 @endif
                                    @if(\App\Http\Controllers\AjaxMessageController::change_message_color($message->id) == 0) bgcolor=#FFFFFF @endif
                                >

                                    <td style="font-size: 12px" id="message_status">{{\App\Http\Controllers\AjaxMessageController::check_the_status_of_contents_for_user_message_page($message->id)}}</td>
                                    <td style="font-size: 12px">{{$message->user_message}}</td>
                                    <td style="font-size: 12px">{{$message->admin_message}}</td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <div style="float: left">
                                {{ $messages->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" id="approveOptions" style="display: none">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body"><i id="loading_approve_progress" style="font-size:24px;margin: 10px"></i>پاسخ و تایید</div>
                    <div class="panel-body" id="posts">
                        <textarea name="admin_comment" dir="rtl"  id="user_comment" readonly="true" disabled  maxlength="250" style="resize: none;width: 45%;height: 150px;margin-left: 5%" placeholder="در صورت تمایل میتوانید توضیحات را وارد کنید . این توضیحات به صورت پیام برای کاربر ارسال خواهد شد"></textarea>
                        <textarea name="user_comment" dir="rtl"  id="admin_comment" maxlength="250" style="resize: none;width: 45%;height: 150px;margin-right: 4.5%" placeholder="در صورت تمایل میتوانید توضیحات را وارد کنید . این توضیحات به صورت پیام برای مدیر سایت ارسال خواهد شد"></textarea>
                        <input type="hidden" id="id">
                        <br>

                        <div class="btn-group" data-toggle="buttons" style="margin-right: 5%">

                            <label>
                                <button type="button" class="btn btn-info" style="margin-right: 20%" id="show_relative_content" onclick="showUpdateContent()" value="ارسال پیام">محتوای مربوط به این پیام</button>
                            </label>
                            <label>
                                <button type="button" class="btn btn-success" style="margin-right: 1%" id="approve_or_dismiss" value="ارسال پیام">ارسال پیام</button>
                            </label>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('contents')}});</script>

    <script type="text/javascript">
        $(function () {
            $("#success-alert").hide();
        });

        $('#add_content_images').click(function (e) {
            $('#addcontentimages').modal('show');
        });

        $('#add_content_imagess').click(function (e) {
            var id = $('#frm-updatecontentform').find('#id').val();
            $('#addcontentimages').modal('show');

        });

        //--------------------------------------Show Message-------------------------------------

        function showMessages($rowid) {
            var url = "{{URL::to('UserMessageViewAndSend')}}" + "?id=" + encodeURI($rowid);
            modal();
            $('#admin_comment').val('');
            $('#user_comment').val('');
            $.ajax({
                type:'GET',
                url:url,
                success:function (data) {
                    if (data === 'fail') {
                        hidmodal();
                        $('#access-alert').css('display','block');
                        $('#access-alert').fadeTo(2000,500).slideUp(500,function () {
                            $('#access-alert').slideUp(500);
                        });
                    } else {
                        hidmodal();
                        $('#approveOptions').css('display','block');
                        $('#id').val(data.id);
                        if(data.admin_message !== '') $('#admin_comment').val(data.admin_message);
                        if(data.user_message !== '') $('#user_comment').val(data.user_message);
                    }
                }
            });
        }

        //---------------------------------Update User Message---------------------------------

        $('body').delegate('#approve_or_dismiss','click',function (e) {
            var message_id = $('#id').val();
            var textarea_message = $('#admin_comment').val();
            var textarea_admin_message = $('#user_comment').val();
            $('#loading_approve_progress').addClass('fa fa-refresh fa-spin');
            var url = "{{URL::to('send_user_message')}}";
            $.ajax({
                type:'POST',
                url:url,
                data:{this_message_id:message_id,user_message:textarea_message,admin_message:textarea_admin_message},
                success:function (data) {
                    $('#loading_approve_progress').removeClass('fa fa-refresh fa-spin');
                    var tr = $('<tr/>', {
                        id: data.message_ids
                    });
                    tr.append($('<td/>', {
                        text:$('#content-info').find('#message_status').text()
                    })).append($('<td/>', {
                        text: data.admin_messages
                    })).append($('<td/>', {
                        text: data.user_messages
                    }));
                    tr.click(function () {
                        showMessages(data.message_ids);
                    });

                    $('#message_table tr#' + data.message_ids).replaceWith(tr);
                    $('tr#' + data.mrid).css('background-color','#e0fde0');
                }
            })

        });


        function showUpdateContent() {

            var message_id = $('#id').val();
            var url = "{{URL::to('content/edit')}}" + "?id=" + encodeURI(message_id);
            modal();
            $.ajax({
                type:'GET',
                url:url,
                success:function (data) {
                    if (data === 'fail') {
                        hidmodal();
                        $('#access-alert').css('display','block');
                        $('#access-alert').fadeTo(2000,500).slideUp(500,function () {
                            $('#access-alert').slideUp(500);
                        });
                    } else {
                        hidmodal();
                        $('#frm-updatecontentform').find('#id').val(data.id);
                        $('#frm-updatecontentform').find('#titlee').val(data.title);
                        $('#frm-updatecontentform').find('#brieff').val(data.brief);
                        $('#frm-updatecontentform').find('#inputatt').val(data.input_at);
                        $('#frm-updatecontentform').find('#commentarea').val(data[0].admin_message);
                        $('#frm-updatecontentform').find('#savecontent').css('display','none');
                        $('#frm-updatecontentform').find('#add_content_imagess').css('display','none');
                        $('#frm-updatecontentform').find('#user_comments').css('display','none');
                        if (data.definition === '') {
                            tinyMCE.activeEditor.setContent('');
                        }
                        else if (data.definition != '') {
                            tinyMCE.activeEditor.setContent(data.definition);
                        }
                        $('#frm-updatecontentform').find('#page_addresss').val(data.page_address);
                        $('#frm-updatecontentform').find('#start_datee').val(data.Begin_at);
                        $('#frm-updatecontentform').find('#end_datee').val(data.End_at);
                        universal = data[0].imageone;
                        $('#large_image').attr('src', data[0].imageone);
                        $('#small_image').attr('src', data[0].imagetwo);
                        $('#verysmall_image').attr('src', data[0].imagethree);
                        $('#modal-updatecontent').modal('show');
                    }
                }
            });
        }
    </script>

    <script>
        //---------------------------------------Relates to Pagination part-----------------------------------
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>

@endsection
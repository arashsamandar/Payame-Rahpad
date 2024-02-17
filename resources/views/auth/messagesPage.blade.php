@include('ajax.UpdateContent')
@include('ajax.AddContentImages')
@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css\datepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('css\cropIt.css')}}"/>
    <link rel="stylesheet" href="{{asset('css\modalConfigs.css')}}" />
    <link rel="stylesheet" href="{{asset('css\dropDownForUsersPage.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js\ImageCropShow.js')}}"></script>
    <script src="{{asset('js\rejs.js')}}"></script>
    <script src="{{asset('js\cropit.js')}}"></script>
    <script src="{{asset('js\showHideModals.js')}}" ></script>
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
    <div id="doloading" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px;visibility: visible;position: static;top:auto">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>Content saved</strong>
        <br>
        <strong>please wait for admin approval</strong>
    </div>

    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>Content could not be found</strong>
    </div>

    <div class="alert alert-danger" id="remove-alert" style="display: none">
        <strong>Content removed</strong>
    </div>

    <div class="alert alert-warning" id="access-alert" style="display: none">
        <strong>you do not have access to other users</strong>
    </div>

    <div class="alert alert-warning" id="create-alert" style="display: none">
        <strong>you are not allowed to create content, please wait ...</strong>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border" style="margin-right: 30px !important;">
                    <div class="panel-heading text-center border body">Messages ( click on your message )</div>
                    <div class="panel-body" id="posts">
                        <table class="table table-bordered" id="content_section_table">
                            <thead>
                            <tr>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Content status</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Admin message</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">User message</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Username</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Name</th>
                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @if(\App\Http\Controllers\PermissionController::This_is_Admin_or_ContentManager())
                                @foreach($messages as $message)
                                    <tr id="{{$message->id}}" style="cursor: pointer" onclick="showMessages({{$message->id}})"
                                        @if($message->admin_seen == 0) bgcolor="#EEE" @endif
                                        @if(\App\Http\Controllers\AjaxMessageController::change_message_color($message->id) == 1) bgcolor=#E7FFE5 @endif
                                        @if(\App\Http\Controllers\AjaxMessageController::change_message_color($message->id) == 2) bgcolor=#FFEBE5 @endif
                                        @if(\App\Http\Controllers\AjaxMessageController::change_message_color($message->id) == 0) bgcolor=#FFFFFF @endif
                                    >
                                        <td style="font-size: 12px" id="message_status">{{\App\Http\Controllers\AjaxMessageController::check_the_status_of_content_for_messages_page($message->id)}}</td>
                                        <td style="font-size: 12px">{{$message->user_message}}</td>
                                        <td style="font-size: 12px">{{$message->admin_message}}</td>
                                        <td style="font-size: 12px" id="user_username">{{$message->username}}</td>
                                        <td style="font-size: 12px" id="user_nameAndfamily">{{$message->name}} {{$message->family}}</td>
                                    </tr>
                                @endforeach
                            @endif
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
                <div class="panel panel-default border" style="margin-right: 30px !important;">
                    <div class="panel-heading text-center border body"><i id="loading_approve_progress_for_message_show" style="font-size:24px;margin: 10px"></i>َApprove & Answer</div>
                    <div class="panel-body" id="posts">
                        <textarea name="user_comment"  id="user_comment" maxlength="250" style="resize: none;width: 48%;height: 150px;" placeholder="you may write your message here, your message would be sent to user"></textarea>
                        <textarea name="admin_comment" id="admin_comment" readonly="true" disabled  maxlength="250" style="resize: none;width: 48%;height: 150px;margin-left: 2%" placeholder="you may write your message here, your message would be sent to user"></textarea>
                        <input type="hidden" id="id">
                        <br>
                        <div class="btn-group" data-toggle="buttons">
                            <div>
                                <label class="btn btn-success" id="ap">Approve content
                                    <input type="radio" name="opt" checked  id="approve_user_content_message" value="1" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </label>
                                <label class="btn btn-warning" id="ed">Reject & Message
                                    <input type="radio" name="opt"  id="approve_user_content_message" value="2" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </label>
                                <label class="btn btn-danger" id="re">Remove
                                    <input type="radio" name="opt" id="RemoveThisUserContent" value="3" autocomplete="off">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </label>
                            </div>
                            <label>
                                <button type="button" class="btn btn-default" id="show_user_content" onclick="showUpdateContent()" value="send message" style="border: 1px dashed black;margin-top:4px;">See Relative Content</button>
                            </label>
                        </div><br/><br/>
                        <button type="button" class="btn btn-success" id="approve_or_dismiss" value="Submit & Send" style="margin: 0 auto">Submit The Operation</button>
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
            var url = "{{URL::to('AdminApproveOrMessageController')}}" + "?id=" + encodeURI($rowid);
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
                        $('#ed').removeClass('active');
                        $('#EditAndMessage').prop('checked',false);
                        if(data.admin_message !== '') $('#admin_comment').val(data.admin_message);
                        if(data.user_message !== '') $('#user_comment').val(data.user_message);
                        if(data.is_confirmed === 0 && data.is_confirmed !== 2)
                        {
                            $('#ed').addClass('active');
                            $('#EditAndMessage').prop('checked',true);
                            $('#ApproveThisContent').prop('checked',false)
                            $('#ap').removeClass('active');
                        }
                        if(data.is_confirmed === 1){
                            $('#ApproveThisContent').prop('checked',true)
                            $('#ap').addClass('active');
                            $('#EditAndMessage').prop('checked',false);
                            $('#ed').removeClass('active');
                        }
                        if(data.is_confirmed === 2) {
                            $('#ApproveThisContent').prop('checked',false)
                            $('#ap').removeClass('active');
                            $('#EditAndMessage').prop('checked',false);
                            $('#ed').removeClass('active');
                        }
                    }
                }
            });
        }


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
                        $('#frm-updatecontentform').find('#commentarea').attr('readonly','readonly');
                        $('#frm-updatecontentform').find('#admin_options').css('display','none');
                        $('#frm-updatecontentform').find('#optional_descriptions').css('display','none');
                        if(data.user_message !== '') $('#frm-updatecontentform').find('#commenting').val(data[0].user_message);
                        if(data.is_confirmed === 0 ? $('#frm-updatecontentform').find('#EditAndMessage').prop('checked',true) : $('#frm-updatecontentform').find('#EditAndMessage').prop('checked',false));
                        if(data.is_confirmed === 1 ? $('#frm-updatecontentform').find('#ApproveThisContent').prop('checked',true) : $('#frm-updatecontentform').find('#ApproveThisContent').prop('checked',false));
                        if (data.definition === '') {
                            tinyMCE.activeEditor.setContent('');
                        }
                        else if (data.definition !== '') {
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

        //---------------------------------Update Admin Message---------------------------------

        $('body').delegate('#approve_or_dismiss','click',function (e) {
            var message_id = $('#id').val();
            var check_Approved = $('input[name=opt]:checked').val();
            var textarea_message = $('#user_comment').val();
            var textarea_user = $('#admin_comment').val();
            $('#loading_approve_progress_for_message_show').addClass('fa fa-refresh fa-spin');
            var url = "{{URL::to('approve_or_message_for_message_page')}}";
            $.ajax({
                type:'POST',
                url:url,
                data:{this_message_id:message_id,approve_Check:check_Approved,admin_message:textarea_message,user_message_text:textarea_user},
                success:function (data) {
                    if(data.respond === 'approved') {
                        $('#loading_approve_progress_for_message_show').removeClass('fa fa-refresh fa-spin');


                        var tr = $('<tr/>', {
                            id: data.mid
                        });
                        tr.css('background-color','#e0fde0');
                        tr.css('cursor','pointer');
                        tr.append($('<td/>', {
                            text:$('#content_section_table').find('#message_status').text()
                        })).append($('<td/>', {
                            text: data.admin_messages
                        })).append($('<td/>', {
                            text: data.user_messages
                        })).append($('<td/>', {
                            text:$('#content_section_table').find('#user_username').text()
                        })).append($('<td/>', {
                            text:$('#content_section_table').find('#user_nameAndfamily').text()
                        }));
                        tr.click(function () {
                            showMessages(data.mid);
                        });

                        $('#content_section_table tr#' + data.mid).replaceWith(tr);
                    }
                    else if(data.respond === 'message') {
                        $('#loading_approve_progress_for_message_show').removeClass('fa fa-refresh fa-spin');


                        var tr = $('<tr/>', {
                            id: data.mid
                        });
                        tr.css('background-color','#ffebe5');
                        tr.css('cursor','pointer');
                        tr.append($('<td/>', {
                            text:$('#content_section_table').find('#message_status').text()
                        })).append($('<td/>', {
                            text: data.admin_messages
                        })).append($('<td/>', {
                            text: data.user_messages
                        })).append($('<td/>', {
                            text:$('#content_section_table').find('#user_username').text()
                        })).append($('<td/>', {
                            text:$('#content_section_table').find('#user_nameAndfamily').text()
                        }));
                        tr.click(function () {
                            showMessages(data.mid);
                        });

                        $('#content_section_table tr#' + data.mid).replaceWith(tr);
                    }
                }
            })

        });

        //------------------------------------Show Add Content----------------------------------


        $('body').delegate('#addOneContent','click',function (e) {
            var url = "{{ URL::to('content/addOneContent') }}";
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
                        $('#modal-newcontent').modal('show');
                    }
                }
            });
        });

        //----------------------------------Delete Content--------------------------------------

        $('body').delegate('#content-info tr #del','click',function () {
            var id = $(this).data('id');
            var url = "{{URL::to('content/destroy')}}" + '?id=' + encodeURI(id);
            modal();
            $.ajax({
                type:'POST',
                url:url,
                success:function (data) {
                    if(data === 'fail') {
                        hidmodal();
                        $('#access-alert').css('display','block');
                        $("#access-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#access-alert").slideUp(500);
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


        $('#frm-updatecontentform').on('submit',function (e) {

            var imageData = null;
            var imageData2 = null;
            var imageData3 = null;




            $('#cropcontentimages').on('submit', function (e) {
                e.preventDefault();
            });
            $('#cropcontentimages').submit(function (e) {
                if($('#user_content_image').val() !== "") {
                    imageData = $('.image-editor').cropit('export');
                    $('.hidden-image-data').val(imageData);
                }
                if($('#user_content_image_small').val() !== "") {
                    imageData2 = $('#second-image-editor').cropit('export');
                }
                imageData3 = $('#third-image-editor').cropit('export');
                $('.second-hidden-image-data').val(imageData2);
                $('.third-hidden-image-data').val(imageData3);
            });

            $('#cropcontentimages').submit();

            $("input#user_large_croped_image").val(imageData);
            $("input#user_small_croped_image").val(imageData2);
            $("input#user_verysmall_croped_image").val(imageData3);


            $("input#user_large_croped_image").val(imageData);
            $("input#user_small_croped_image").val(imageData2);
            $("input#user_verysmall_croped_image").val(imageData3);

            tinyMCE.triggerSave();


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
                    $('#modal-updatecontent').find('#updateProg').css('display','block');
                    $('#modal-updatecontent').find('#updateProg').attr('value',0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#modal-updatecontent').find('#updateProg').attr('value',percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    if (data[0].change_denied === 'change_denied') {
                        $('#modal-updatecontent').find('#updateProg').css('display', 'none');
                        $('#modal-updatecontent').find('#updateProg').attr('value', 0);
                        $('#modal-updatecontent').modal('hide');
                        $('#user_content_image_small').val('');
                        $('#user_content_image').val('');
                        $('#content-info tr#' + data.id).replaceWith(tr);

                    } else {
                        $('#modal-updatecontent').find('#updateProg').css('display', 'none');
                        $('#modal-updatecontent').find('#updateProg').attr('value', 0);
                        $('#modal-updatecontent').modal('hide');
                    }
                }
            });
        });

    </script>

    <script>
        //---------------------------------------Relates to Pagination part-----------------------------------
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>

@endsection
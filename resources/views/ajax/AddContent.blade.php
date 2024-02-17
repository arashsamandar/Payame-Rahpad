@include('ajax.NewContentAdd')
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
    <div id="doloading" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px;visibility: visible;position: static;top:auto">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>Content saved successfully</strong><br>
        <strong>Please wait for admin approval</strong>
    </div>

    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>Could not find content</strong>
    </div>

    <div class="alert alert-danger" id="remove-alert" style="display: none">
        <strong>Content removed successfully</strong>
    </div>

    <div class="alert alert-warning" id="access-alert" style="display: none">
        <strong>you do not have access to other users</strong>
    </div>

    <div class="alert alert-warning" id="create-alert" style="display: none">
        <strong>You can not create another content until your last one is approved by admin</strong><br>
        <strong>Please wait for your content to be approved</strong>
    </div>

    <div class="alert alert-warning" id="change-alert" style="display: none">
        <strong>Content edited successfully</strong><br>
        <strong>Please wait for admin to approve your content</strong><br>
        <strong>Thanks for your patience</strong><br>
    </div>
    <br>
    <div class="container" id="">
        <div class="row">
            <div class="col-md-12 col-md-offset-2" style="margin: 0 auto;"><br>
                <div class="panel panel-default border" style="margin-right: 30px !important;">
                    <div class="panel-heading text-center border body">Contents</div>
                    <div>
    {{--            give action="{{route('searchName')}} and method="POST" to the Form & Fix The Underlying Method Of Action            --}}
                        <form class="form-horizontal" id="formSearch">
                            <div class="input-group">
                                <input type="text" class="form-control" name="contactname" id="txtSearch">
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
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Title</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Brief</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Place</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Page address</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Start date</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">End date</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">Operation</th>
                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @foreach($contents as $value)
                                <tr id="{{$value->id}}" style="cursor: pointer" onclick="showUpdateContent({{$value->id}})"
                                    @if(\App\Http\Controllers\AjaxMessageController::checkIfApprovedForTR($value->id) == 1) bgcolor="#e0fde0" title="Content is approved"
                                        @elseif(\App\Http\Controllers\AjaxMessageController::checkIfApprovedForTR($value->id) == 0)bgcolor="#ffebe5" title="Edit sent for approval"
                                        @elseif(\App\Http\Controllers\AjaxMessageController::checkIfApprovedForTR($value->id) == 4)bgcolor="#EEE" title="Content is not approved yet"
                                    @endif>
                                    <td style="font-size: 12px">{{$value->title}}</td>
                                    <td style="font-size: 12px">{{$value->brief}}</td>
                                    <td style="font-size: 12px">{{$value->input_at}}</td>
                                    <td style="font-size: 12px">{{$value->page_address}}</td>
                                    <td style="font-size: 12px">{{$value->Begin_at}}</td>
                                    <td style="font-size: 12px">{{$value->End_at}}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="{{$value->id}}">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="{{$value->id}}">Remove</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <div style="float: left">
                                {{ $contents->render() }}
                            </div>
                            @if(\App\Http\Controllers\PermissionController::User_have_permission_to_create_content(\Auth::user()->id))
                                <span class="input-group-btn">
                                    <button class="btn btn-success" data-toggle="modal" id="addOneContent">Add new content</button>
                                </span>
                           @elseif(Auth::guard('admin')->check())
                                <span class="input-group-btn">
                                    <button class="btn btn-success" data-toggle="modal" id="addOneContent">Add new content</button>
                                </span>
                           @endif
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
                        $("#create-alert").fadeTo(2000, 5000).slideUp(5000, function() {
                            $("#create-alert").slideUp(500);
                        });
                    } else {
                        $('#modal-newcontent').modal('show');
                    }
                }
            });
        });

        //------------------------------------Add New Content-----------------------------------

        $('#frm-newcontentform').on('submit',function (e) {
            var imageData = null;
            var imageData2 = null;
            var imageData3 = null;


                $('#cropcontentimages').on('submit', function (e) {
                    e.preventDefault();
                });
                $('#cropcontentimages').submit(function (e) {
                    imageData = $('.image-editor').cropit('export');
                    imageData2 = $('#second-image-editor').cropit('export');
                    imageData3 = $('#third-image-editor').cropit('export');
                    $('.hidden-image-data').val(imageData);
                    $('.second-hidden-image-data').val(imageData2);
                    $('.third-hidden-image-data').val(imageData3);
                });

                $('#cropcontentimages').submit();

            $("input#user_large_croped_image").val(imageData);
            $("input#user_small_croped_image").val(imageData2);
            $("input#user_verysmall_croped_image").val(imageData3);


            tinyMCE.triggerSave();
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
                    $('#modal-newcontent').find('#updateProg').css('display','block');
                    $('#modal-newcontent').find('#updateProg').attr('value',0);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#modal-newcontent').find('#updateProg').attr('value',percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success:function (data) {
                    if(data === 'false') {
                        $('#modal-newcontent').find('#updateProg').css('display','none');
                        $('#modal-newcontent').find('#updateProg').attr('value',0);
                        $('#create-alert').css('display','block');
                        $("#create-alert").fadeTo(2000, 500).slideUp(500, function() {
                            $("#create-alert").slideUp(500);
                        });

                    } else {
                        $('#modal-newcontent').find('#updateProg').css('display','none');
                        $('#modal-newcontent').find('#updateProg').attr('value',0);
                        $('#myModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        var tr = $('<tr/>',{
                            id : data.id
                        });
                        tr.css('background-color','#EEE')
                        tr.append($('<td/>',{
                            text:data.End_at
                        })).append($('<td/>',{
                            text:data.Begin_at
                        })).append($('<td/>',{
                            text:data.page_address
                        })).append($('<td/>',{
                            text:data.input_at
                        })).append($('<td/>',{
                            text:data.brief
                        })).append($('<td/>',{
                            text:data.title
                        })).append($('<td/>',{
                            html :
                                '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">Edit</a> ' +
                                '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">Remove</a>'
                        }));

                        $('#user_content_image').val('');
                        $('#modal-newcontent').modal('hide');
                        $('#content-info').append(tr);
                        $('#success-alert').css('display','block');
                        $("#success-alert").fadeTo(2000, 5000).slideUp(5000, function() {
                            $("#success-alert").slideUp(500);
                        });
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

        //---------------------------------Show Update Content----------------------------------------

        $('body').delegate('#content-info #edit','click',function (e) {
           var id = $(this).data('id');
           var url = "{{URL::to('content/edit')}}" + "?id=" + encodeURI(id);
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
        });

        function showUpdateContent($rowid) {

                var url = "{{URL::to('content/edit')}}" + "?id=" + encodeURI($rowid);
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


        //---------------------------------Do Update Content----------------------------------------


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
                        var tr = $('<tr/>', {
                            id: data.id
                        });
                        tr.css('background-color', data[0].message_color);
                        tr.append($('<td/>', {
                            text: data.End_at
                        })).append($('<td/>', {
                            text: data.Begin_at
                        })).append($('<td/>', {
                            text: data.page_address
                        })).append($('<td/>', {
                            text: data.input_at
                        })).append($('<td/>', {
                            text: data.brief
                        })).append($('<td/>', {
                            text: data.title
                        })).append($('<td/>', {
                            html:
                                '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">Edit</a> ' +
                                '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">Remove</a>'
                        }));
                        $('#user_content_image_small').val('');
                        $('#user_content_image').val('');
                        $('#content-info tr#' + data.id).replaceWith(tr);
                        $('#change-alert').css('display', 'block');
                        $("#change-alert").fadeTo(2000, 500).slideUp(5000, function () {
                            $("#change-alert").slideUp(500);
                        });
                    } else {
                        $('#modal-updatecontent').find('#updateProg').css('display', 'none');
                        $('#modal-updatecontent').find('#updateProg').attr('value', 0);
                        $('#modal-updatecontent').modal('hide');
                        var tr = $('<tr/>', {
                            id: data.id
                        });
                        tr.css('background-color', data[0].message_color);
                        tr.append($('<td/>', {
                            text: data.title
                        })).append($('<td/>', {
                            text: data.brief
                        })).append($('<td/>', {
                            text: data.input_at
                        })).append($('<td/>', {
                            text: data.page_address
                        })).append($('<td/>', {
                            text: data.Begin_at
                        })).append($('<td/>', {
                            text: data.End_at
                        })).append($('<td/>', {
                            html:
                                '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">Edit</a> ' +
                                '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">Remove</a>'
                        }));
                        $('#user_content_image_small').val('');
                        $('#user_content_image').val('');
                        $('#content-info tr#' + data.id).replaceWith(tr);
                        $('#success-alert').css('display', 'block');
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
                            $("#success-alert").slideUp(500);
                        });
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
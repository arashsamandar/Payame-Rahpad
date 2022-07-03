@include('ajax.NewContentAdd')
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
        <strong>محتوا ذخیر شد</strong><br>
        <strong>لطفا منتظر تایید محتوا باشید</strong>
    </div>

    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>محتوای مورد نظر یافت نشد</strong>
    </div>

    <div class="alert alert-danger" id="remove-alert" style="display: none">
        <strong>محتوای مورد نظر حذف شد</strong>
    </div>

    <div class="alert alert-warning" id="access-alert" style="display: none">
        <strong>شما اجازه ی دسترسی به کاربران دیگر را ندارید</strong>
    </div>

    <div class="alert alert-warning" id="create-alert" style="display: none">
        <strong>تا زمان تایید محتوای قبلی اجازه ی ایجاد محتوای جدید ندارید</strong><br>
        <strong>لطفا منتظر تایید محتوای قبلی خود بمانید</strong>
    </div>

    <div class="alert alert-warning" id="change-alert" style="display: none">
        <strong>محتوا ویرایش شد</strong><br>
        <strong>لطفا برای نمایش آن منتظر تایید مدیر سایت باشید</strong><br>
        <strong>با تشکر از شکیبایی شما ...</strong><br>
    </div>
    <br>
    <div class="container" id="">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">محتوا</div>
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
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تاریخ خاتمه</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تاریخ شروع</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">آدرس صفحه</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">محل درج</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">خلاصه</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">عنوان</th>

                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @foreach($contents as $value)

                                <tr id="{{$value->id}}" style="cursor: pointer" onclick="showUpdateContent({{$value->id}})" @if(\App\Http\Controllers\AjaxMessageController::checkIfApprovedForTR($value->id) == 1) bgcolor="#e0fde0" title="محتوا تایید شده است"
                                        @elseif(\App\Http\Controllers\AjaxMessageController::checkIfApprovedForTR($value->id) == 0)bgcolor="#ffebe5" title="درخواست ویراش ارسال شده"
                                        @elseif(\App\Http\Controllers\AjaxMessageController::checkIfApprovedForTR($value->id) == 4)bgcolor="#EEE" title="محتوا تایید نشده است"
                                        @endif>

                                    <td>

                                        <a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="{{$value->id}}">ویرایش</a>
                                        <a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="{{$value->id}}">حذف</a>

                                    </td>

                                    <td style="font-size: 12px">{{$value->End_at}}</td>
                                    <td style="font-size: 12px">{{$value->Begin_at}}</td>
                                    <td style="font-size: 12px">{{$value->page_address}}</td>
                                    <td style="font-size: 12px">{{$value->input_at}}</td>
                                    <td style="font-size: 12px">{{$value->brief}}</td>
                                    <td style="font-size: 12px">{{$value->title}}</td>



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
                              <button class="btn btn-success" data-toggle="modal" id="addOneContent">محتوای جدید</button>
                           </span>
                           @elseif(Auth::guard('admin')->check())
                                <span class="input-group-btn">
                              <button class="btn btn-success" data-toggle="modal" id="addOneContent">محتوای جدید</button>
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
                            html :
                            '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                            '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                        })).append($('<td/>',{
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
                            html:
                            '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                            '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                        })).append($('<td/>', {
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
                            html:
                            '<a href="#" class="btn btn-success btn-sm" style="width: 70px;font-size: 12px" id="edit" data-id="' + data.id + '">ویرایش</a> ' +
                            '<a href="#" class="btn btn-danger btn-sm" style="width: 70px;font-size: 12px" id="del" data-id="' + data.id + '">حذف</a>'
                        })).append($('<td/>', {
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
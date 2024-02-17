<link rel="stylesheet" href="{{asset('css\progressStyle.css')}}" />
<style>
    .modal-content {
        visibility: hidden;
        position: absolute;
        top: -9999px;
    }
</style>
<script>
    //----------------------------------Close Modal Function-------------------------------
    function closecontent() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('#modal-newcontent').modal('hide');
    }
</script>
<div id="modal-newcontent" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl" style="width: 1000px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new content</h4>
            </div>

            <form id="frm-newcontentform" action="{{route('saveContent')}}" method="post">

                <input type="hidden" name="user_small_croped_image" id="user_small_croped_image" class="usercropedimage" />
                <input type="hidden" name="user_large_croped_image" id="user_large_croped_image" class="usercropedimage" />
                <input type="hidden" name="user_verysmall_croped_image" id="user_verysmall_croped_image" class="usercropedimage" />

                <input type="hidden" name="id" id="id" />
                <div class="row"  style="clear: both">
                    {{--<div class="form-group">--}}
                    <br>
                    <div style="margin-right: 50px;margin-left:50px;font-size: 18px;">
                        <label for="title" >Title :</label>
                        <input type="text" id="title" name="title" class="form-control input-md"  placeholder="enter title" maxlength="30" />
                    </div>
                    {{--</div>--}}
                </div>
                <div class="row"  style="clear: both">
                    {{--<div class="form-group">--}}
                    <div style="margin-right: 50px;margin-left:50px;font-size: 18px;">
                        <label for="brief" style="margin-top: 10px" >Brief :</label>
                        <input type="text" id="brief" name="brief" class="form-control input-md"  placeholder="enter brief" maxlength="300" />
                    </div>
                    {{--</div>--}}
                </div>
                <div class="row" style="clear: both;">
                    <div style="margin-right: 50px;margin-left:50px;font-size: 18px">
                        <label for="inputat" style="margin-top: 10px">Add to landing page :</label>
                        <select name="inputat" id="inputat" class="form-control">
                            <option value="1" style="font-weight: bold">Slider</option>
                            <option value="2" style="font-weight: bold">Bottom images</option>
                            <option selected disabled value="">enter the place of your advertisement</option>
                        </select>
                        <small style="color: red;">@foreach($errors->get('inputat') as $message ) {{$message}}   @endforeach</small>
                        <small style="display: none;color: red;">enter the place of your advertisement</small>
                    </div>
                </div><br><br>
                <div class="row">
                    <div style="width:925px;margin-right: 50px;margin-left:50px;margin-top:0;font-size: 18px;">
                            <label for="input_definition">Description :</label>
                                <textarea class="form-control input_definition" style="margin-top: 0;" name="input_definition" id="input_definition" rows="10"></textarea>
                    </div>
                </div>
                <div class="row"  style="clear: both">
                    {{--<div class="form-group">--}}
                    <div style="margin-right: 50px;margin-left:50px;font-size: 18px;">
                        <label for="page_address" style="margin-top: 30px" >Website address</label>
                        <input type="text" id="page_address" name="page_address" class="form-control input-md"  placeholder="enter your website address" maxlength="30" />
                    </div>
                    {{--</div>--}}
                </div>
                <div class="row" style="width:850px;margin-right: 20px;margin-left:19px;margin-top:10px;font-size: 18px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Starts at :</label>
                            <input tabindex="4" type="text" name="start_date" id="start_date" value="{{old('start_date')}}"  class="form-control input-md floatlabel" placeholder="start's date">
                            <small style="color: red;">@foreach($errors->get('birth_date2') as $message ) {{$message}}   @endforeach</small>
                            <small id="bdwarn" style="display: none;color: red;">date format is invalid</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Ends at :</label>
                            <input tabindex="4" type="text" name="end_date" id="end_date" value="{{old('end_date')}}"  class="form-control input-md floatlabel" placeholder="end's date">
                            <small style="color: red;">@foreach($errors->get('birth_date') as $message ) {{$message}}   @endforeach</small>
                            <small id="end_date_warn" style="display: none;color: red;">date format is invalid</small>
                        </div>
                    </div>
                </div>
                <div class="row" style="width:850px;margin-right: 35px;margin-left:30px;margin-top:10px;font-size: 18px;">
                    <div class="feedback left">
                        <div class="tooltips">
                            <div class="btn-group">

                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    message ( optional )
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-form" style="width: 100%">
                                    <li>
                                        <div class="report">
                                            <textarea name="comment" maxlength="250" style="width: 100%;height: 100%"></textarea>
                                            <i id="approve_loading" style="text-align:center;font-size:24px;"></i>
                                        </div>
                                        <div class="btn-group" style="width: 100%">
                                            <button type="button" id="send_message_to_admin_button" class="btn btn-default" style="width: 50%"><i class="fa fa-remove"></i>reject</button>
                                            <button type="button" class="btn btn-default" style="width: 50%"><i class="fa fa-send"></i>send message</button>
                                        </div>
                                    </li>
                                </ul>
                                <a class="btn btn-success" id="add_content_images">Add Photos</a>
                                <h4 id="mission"></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <progress id="updateProg" max="100" value="0" style="display: none;direction: ltr"></progress>
                <div class="row" style="font-size: 18px;width: 100%;margin:15px auto">
                    <div class="col-md-6" style="width: 50%;">
                        <div>
                            <input type="button" value="Back" data-dismiss="modal" onclick="closecontent()" class="btn btn-danger btn-block"  />
                        </div>
                    </div>
                    <div class="col-md-6" style="width: 50%;">
                        <div>
                            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{URL::to('src/js/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
{{--<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>--}}

<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.input_definition",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    tinymce.init(editor_config);
</script>
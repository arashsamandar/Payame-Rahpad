<style>
    .material-switch > input[type="checkbox"] {
        display: none;
    }
    .material-switch > label {
        cursor: pointer;
        height: 0px;
        position: relative;
        width: 40px;
    }
    .material-switch > label::before {
        background: rgb(0, 0, 0);
        box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        content: '';
        height: 16px;
        margin-top: -8px;
        position:absolute;
        opacity: 0.3;
        transition: all 0.4s ease-in-out;
        width: 40px;
    }
    .material-switch > label::after {
        background: rgb(255, 255, 255);
        border-radius: 16px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        content: '';
        height: 24px;
        left: -4px;
        margin-top: -8px;
        position: absolute;
        top: -4px;
        transition: all 0.3s ease-in-out;
        width: 24px;
    }
    .material-switch > input[type="checkbox"]:checked + label::before {
        background: inherit;
        opacity: 0.5;
    }
    .material-switch > input[type="checkbox"]:checked + label::after {
        background: inherit;
        left: 20px;
    }
</style>
<link rel="stylesheet" href="{{asset('css\progressStyle.css')}}" />
<script>
    function samandar() {
        $('#user-access')
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        $('#user-access').modal('hide');
    }
    $(document).on('show.bs.modal','#user-access', function () {
        $("#userimagee").value = "";
        $("input#image-data").cropit('destroy');
        $("input#usercropedimage").cropit('destroy');
        $('#user-access')
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    });
    $(document).on('hidden.bs.modal','#user-access', function () {
        $("#userimagee").value = "";
        $("input#image-data").cropit('destroy');
        $("input#usercropedimage").cropit('destroy');
        $('#user-access')
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    });
</script>


<div id="user-access" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User's Access Management</h4>
            </div>
            <form id="frm-access" role="form" method="post" action="{{ URL::to('student/changaccess') }}">
                <input type="hidden" name="id" id="id" />
                <div class="row"  style="clear: both">
                    <div>
                        <div class="form-group">
                            <br>
                            <div style="margin-right: 50px;font-size: 18px;">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-heading" style="border:1px solid #eee;font-weight: bold">
                    <span>username : </span>
                    <span id="thisusername"></span>
                    <br/>
                    <span >name : </span>
                    <span id="thisuser_name"></span>
                    <span id="thisuser_family"></span>
                </div>

                <!-- List group -->
                <ul class="list-group" style="margin: 30px;">
                    <li class="list-group-item" style="border: none">
                        <div style="padding-left: 50px">
                            content management
                        </div>
                        <div class="material-switch" style="border: none">
                            <input id="access_managing_contents" name="access_managing_contents" type="checkbox"/>
                            <label for="access_managing_contents" class="label-warning"></label>
                        </div>
                    </li>
                    <li class="list-group-item" style="border:none">
                        <div style="padding-left: 50px">
                            user management
                        </div>
                        <div class="material-switch" style="border: none;">
                            <input id="access_managing_users" name="access_managing_users" type="checkbox"/>
                            <label for="access_managing_users" class="label-danger"></label>
                        </div>
                    </li>
                </ul>

                <progress id="updateProg" max="100" value="0" style="display: none"></progress>

                <div class="row modal-footer" style="margin: 30px;">

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="button" value="Back" onclick="samandar()" class="btn btn-danger btn-block"  />
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
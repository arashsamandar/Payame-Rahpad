@extends('Layouts.UpdeRegis')
@section('URS')
    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>عملیات با موفقیت انجام شد</strong>
    </div>

    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>محتوای مورد نظر یافت نشد</strong>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border text-right">
                    <div class="panel-heading text-center border body">گزارشات</div>
                    <div dir="rtl">
                        <form method="post" action="{{route('adminSearchName')}}" class="form-horizontal" id="formSearch">
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

                                <th class="text-center" style="font-size: 12px;font-weight: bold">تغییر کننده</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">تغییر دهنده</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">در زمانِ</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">در تاریخِ</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">شرح</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">نام کاربر</th>

                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @foreach($allLogs as $log)

                                <tr id="{{$log->logid}}">

                                    <td style="font-size: 12px">{{\App\Http\Controllers\AdminController::returnUsername($log->Reserved2)}}</td>
                                    <td style="font-size: 12px">{{\App\Http\Controllers\AdminController::returnUsername($log->Reserved1)}}</td>
                                    <td style="font-size: 12px">{{$log->logTime}}</td>
                                    <td style="font-size: 12px">{{$log->logDate}}</td>
                                    <td style="font-size: 12px">{{$log->log_desc}}</td>
                                    <td style="font-size: 12px">{{\App\Http\Controllers\AdminController::returnUsername($log->user_id)}}</td>

                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="input-group">
                            <div style="float: left">
                                {{ $allLogs->render() }}
                            </div>
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


        //----------------------------------- Search Username ----------------------------------

//        $('#formSearch').on('submit', function (e) {
//            var name = $('#txtSearch').val();
//            var url = $('#formSearch').attr('action');
//            var post = $('#formSearch').attr('method');
//            e.preventDefault();
//            $.ajax({
//                type: post,
//                url: url,
//                data:{username:name}
//            });
//        });

    </script>

    <script>
        //---------------------------------------Relates to Pagination part-----------------------------------
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>

@endsection
@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')
    <title>Reports ( Admin )</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css\dropDownForUsersPage.css')}}" />

    <div class="alert alert-success" id="success-alert" style="display: none">
        <strong>Operation Successfull</strong>
    </div>
    <div class="alert alert-danger" id="warning-alert" style="display: none">
        <strong>Content wasn't found</strong>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 " style="margin: 0 auto;padding-top: 30px"><br>
                <div class="panel panel-default border" style="margin-right: 30px !important;">
                    <div class="panel-heading text-center border body">Reports</div>
                    <div>
                        <form method="post" action="{{route('adminSearchName')}}" class="form-horizontal" id="formSearch">
                            <div class="input-group">
                                <input type="text" class="form-control" name="contactname" id="txtSearch" placeholder="type a username and see his/her actions">
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
                                <th class="text-center" style="font-size: 12px;font-weight: bold">username</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">description</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">date</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">time</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">modifier</th>
                                <th class="text-center" style="font-size: 12px;font-weight: bold">modified</th>
                            </tr>
                            </thead>
                            <tbody id="content-info" class="text-center" style="font-size: 12px;">
                            @foreach($allLogs as $log)
                                <tr id="{{$log->logid}}">
                                    <td style="font-size: 12px">{{\App\Http\Controllers\AdminController::returnUsername($log->user_id)}}</td>
                                    <td style="font-size: 12px">{{$log->log_desc}}</td>
                                    <td style="font-size: 12px">{{$log->logDate}}</td>
                                    <td style="font-size: 12px">{{$log->logTime}}</td>

                                    <td style="font-size: 12px">{{\App\Http\Controllers\AdminController::returnUsername($log->Reserved1)}}</td>

                                    <td style="font-size: 12px">{{\App\Http\Controllers\AdminController::returnUsername($log->Reserved2)}}</td>
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
    </script>
    <script>$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});</script>

@endsection
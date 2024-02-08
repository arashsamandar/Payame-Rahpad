<!doctype html>
<html style="margin: 0;padding: 0;height: 100%">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Rahpad-group"/>
    <meta name="viewport"
          content="width=330px, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf" value="{{ csrf_token() }}">
    @include('Layouts.headerCssFiles')
    <style>
        .btn-info {
            background-color: #002A39 !important;
        }

        .btn-info:hover {
            background-color: #17a2b8 !important;
        }

        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 250px;
            height: 250px;
        }

        .cropit-preview-image-container {
            cursor: move;
        }

        .image-size-label {
            margin-top: 10px;
        }

        #result {
            margin-top: 10px;
            width: 900px;
        }

        #result-data {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
            integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <script src="{{asset('js\rejs.js')}}"></script>
    <script src="{{asset('js\cropit.js')}}"></script>
    <script>$(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#defaultimage').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#userimage").change(function () {
                readURL(this);
            });
        });
        $(function () {
            $('.image-editor').cropit();
            $('form').submit(function () {
                var imageData = $('.image-editor').cropit('export');
                $('.hidden-image-data').val(imageData);
                var formValue = $(this).serialize();
                $('#result-data').text(formValue);
            });
        });</script>
    <title>
        @if(isset($page_title))
            {{$page_title}}
        @else
            Arash Application
        @endif
    </title>
</head>
<body style="margin: 0;padding: 0;height:100%;width: 100%;">

<div class="containss">

    @if(Auth::user() || Auth::guard('admin')->check())
        <div class="container">
            <div class="dropdown" style="position: absolute;right: 20px;top:30px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">

                    @if(Auth::guard('admin')->check())
                        <img alt="user image" src="{{asset('images/default1.jpg')}}" class="ThisUserImage"/><br>
                        <span class="glyphicon glyphicon-menu-hamburger ThisuserNameAndFamily"> {{\App\Http\Controllers\AdminNameController::adminName()}} {{\App\Http\Controllers\AdminNameController::adminFamily()}} </span>
                </button>
                </button>
                @elseif(Auth::user())
                    @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
                        <img alt="user image" class="ThisUserImage"
                             src="{{ route('userimage',['id' => Auth::user()->id  ])}}"/><br>
                    @else
                        <img alt="user image" src="{{asset('images/default1.jpg')}}" class="ThisUserImage"/><br>
                    @endif
                @endif
                @if(Auth::user() && !Auth::guard('admin')->check())
                    <span class="glyphicon glyphicon-menu-hamburger ThisuserNameAndFamily"> {{Auth::user()->name}} {{Auth::user()->family}} </span></figure></button>
                @endif

                <ul class="dropdown-menu dropdown-toggle" aria-labelledby="dropdownMenu1"
                    style="position: absolute;left:0px;top: 110px;">
                    <li style="text-align: center"><a href="{{route('userspagination')}}"><span
                                    class="glyphicon glyphicon-user"> کاربران </span></a></li>
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center"><a href="{{route('addcontent')}}"><span
                                    class="glyphicon glyphicon-pencil"> محتوا </span></a></li>
                    @if(\App\Http\Controllers\PermissionController::This_is_Admin_or_ContentManager())
                        <li role="separator" class="divider"></li>
                        <li style="text-align: center"><a href="{{route('uppass')}}"><span
                                        class="glyphicon glyphicon-lock"> تغییر-رمز-عبور </span></a></li>
                        <li role="separator" class="divider"></li>
                        @if(Auth::guard('admin')->check())
                            <li style="text-align: center"><a href="{{route('Logs.View')}}"><span
                                            class="glyphicon glyphicon-envelope"> گزارشات </span></a></li>
                            <li role="separator" class="divider"></li>
                        @endif

                        <li style="text-align: center;"><a href="{{route('message.page')}}"><span><span
                                            class="badge">{{\App\Http\Controllers\AjaxMessageController::Count_unread_admin_messages()}}</span>پیام</span></a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li style="text-align: center;"><a href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"> خروج </span>
                            </a></li>
                    @else
                        <li role="separator" class="divider"></li>
                        <li style="text-align: center"><a href="{{route('update')}}"><span
                                        class="glyphicon glyphicon-edit"> ویرایش </span></a></li>
                        <li role="separator" class="divider"></li>
                        <li style="text-align: center"><a href="{{route('uppass')}}"><span
                                        class="glyphicon glyphicon-lock"> تغییر-رمز-عبور </span></a></li>
                        <li role="separator" class="divider"></li>
                        <li style="text-align: center;"><a href="{{route('user.messages')}}"><span
                                        class="glyphicon glyphicon-envelope"> پیام <span
                                            class="badge">{{\App\Http\Controllers\AjaxMessageController::Count_unread_user_message()}}</span></span></a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li style="text-align: center;"><a href="{{route('logout')}}"><span
                                        class="glyphicon glyphicon-log-out"> خروج </span></a></li>
                    @endif
                </ul>
            </div>
        </div>
    @endif

    <div id="header">
        <div class="treedash" onclick="openNav()">&#9776;</div>
        <div id="prlogo"><img src="{{asset('images/pr.png')}}" class="sitelogo"/></div>

        <nav id="navigation">
            <a href="{{route('home')}}"><input type="button" value="صفحه اصلی" class="btns"/></a>
            <a href="{{route('ourServices')}}"><input type="button" value="خدمات" class="btns"/></a>
            <a href="{{route('aboutUs')}}"><input type="button" value="درباره ما" class="btns"/></a>
            <a href="{{route('contactUs')}}"><input type="button" value="تماس با ما" class="btns"/></a>
            @if(Auth::user())

            @else
                <a href="{{route('login')}}"><input type="button" value="ورود به سایت" class="btns"
                                                    style="float: left;"/></a>
                <a href="{{route('register')}}"><input type="button" value="ثبت نام" class="btns" style="float: left;"/></a>
            @endif
        </nav>

    </div>

    <div id="mySidenav" class="sidenav" style="text-align: center">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{route('home')}}" class="sbtn">صفحه اصلی</a>
        <a href="{{route('ourServices')}}" class="sbtn">خدمات</a>
        <a href="{{route('aboutUs')}}" class="sbtn">درباره ما</a>
        <a href="{{route('contactUs')}}" class="sbtn">تماس با ما</a>
        <br>
        @if(Auth::user())
            <a href="{{route('logout')}}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">خروج</a>
        @else
            <a href="{{route('login')}}">ورود</a>
            <a href="{{route('register')}}">ثبت نام</a>
        @endif
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    @yield('URS')

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "170px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        function openUserNav() {
            document.getElementById("userSideNav").style.width = "170px";
        }

        function closeUserNav() {
            document.getElementById("userSideNav").style.width = "0";
        }
    </script>

    <div class="ftrr">
        کلیه حقوق مادی و معنوی این سایت متعلق به کانون تبلیغاتی <a style="color: #F26622">پیام رهپاد</a> می باشد
        <br>
        <a href="https://www.facebook.com/PayameRahpad/">
            <img src="{{asset('images/prfacebook.png')}}" style="width: 60px;height: 60px;padding: 10px"/>
        </a>
        <a href="http://instagram.com/rahpadads">
            <img src="{{asset('images/prinstagram.png')}}" style="width: 60px;height: 60px;padding: 10px"/>
        </a>
        <a href="https://t.me/Payam_e_Rahpad">
            <img src="{{asset('images/prtelegram.png')}}" style="width: 60px;height: 60px;padding: 10px"/>
        </a>
        <br>
        طراحی و راه اندازی پایگاه اینترنتی <a style="color:#F26622;">گروه رهپاد</a>
    </div>

</div>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf" value="{{ csrf_token() }}">
    <meta name="author" content="Rahpad-group" />
    <title>کانون تبلیغات و آگهی پیام رهپاد</title>
    <meta name="keywords" content=" کانون تبلیغات و آگهی پیام رهپاد , کانون تبلیغاتی , تبلیغات , تبلیغ , طراحی سایت, SEO , تولید نرم افزار , طراحی لوگو , طراحی سربرگ , طراحی کاتالوگ , برگزاری همایش , انتشار آگهی نامه , ساختمان , صنعت ساختمان , آگهی نامه صنعت ساختمان , آگهی نامه کاربردهای اداری فناوری اطلاعات و ارتباطات , گروه رهپاد ,  مدیریت شهری ,  خدمات شهری ,  Rahpad Group"/>
    <meta name="description" content=" ارائه دهنده کلیه خدمات انتشار آگهی نامه های تخصصی در حوزه های فناوری اطلاعات، عمران، مدیریت شهری و ..." />
    <meta name="viewport" content="width=330px, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css\header.css')}}" />
    <link rel="stylesheet" href="{{asset('css\mainpage.css')}}" />
    <link rel="stylesheet" href="{{asset('css\footer.css')}}" />
    <style type="text/css">
        @font-face{
            font-family:'Yekan';
            src:url("{{asset('fonts/BYekan.ttf')}}") format('truetype'),
            url("{{asset('fonts/BYekan.eot?#')}}") format('eot'),
            url("{{asset('fonts/BYekan.woff')}}") format('woff');}

        .carousel-caption {
            top: 82%;
            right: 0;
            bottom: auto;
        }
    </style>

    <script
            src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&amp;language=fa-IR&key=AIzaSyBPE7WWdaSiKs5_qtd4U7agoJ1jmCJ6XbE">
    </script>

</head>
<body dir="rtl" style="text-align: right;font-family: Yekan;margin: 0;padding: 0;width: 100%;">

@if(Auth::user() || Auth::guard('admin')->check())

    <div class="container">
        {{--<button class="btn btn-default btn-lg btn-link" id="messageButton" >--}}
            {{--<span class="glyphicon glyphicon-envelope" id="messageIcon" style="color: orange;position: absolute;top: 15px;left:20px;"></span>--}}
        {{--</button>--}}
        <div class="dropdown" style="position: absolute;left: 20px;top:30px;">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><figure>

                    @if(Auth::guard('admin')->check())
                        <img src="{{asset('images/default1.jpg')}}" class="ThisUserImage" /><br>
                        <span class="glyphicon glyphicon-menu-hamburger ThisuserNameAndFamily"> {{\App\Http\Controllers\AdminNameController::adminName()}} {{\App\Http\Controllers\AdminNameController::adminFamily()}} </span></figure></button>
            </figure></button>
            @elseif(Auth::user())
                @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
                    <img class="ThisUserImage" src="{{ route('userimage',['id' => Auth::user()->id  ])}}" /><br>
                @else
                    <img src="{{asset('images/default1.jpg')}}" class="ThisUserImage" /><br>
                @endif
            @endif
            @if(Auth::user() && !Auth::guard('admin')->check())
                <span class="glyphicon glyphicon-menu-hamburger ThisuserNameAndFamily"> {{Auth::user()->name}} {{Auth::user()->family}} </span></figure></button>
            @endif

            <ul class="dropdown-menu dropdown-toggle" aria-labelledby="dropdownMenu1" style="position: absolute;left:0px;top: 110px;">
                <li style="text-align: center"><a href="{{route('userspagination')}}"><span class="glyphicon glyphicon-user"> کاربران </span></a></li>
                <li role="separator" class="divider"></li>
                <li style="text-align: center"><a href="{{route('addcontent')}}"><span class="glyphicon glyphicon-pencil"> محتوا </span></a></li>
                @if(\App\Http\Controllers\PermissionController::This_is_Admin_or_ContentManager())
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center"><a href="{{route('uppass')}}"><span class="glyphicon glyphicon-lock"> تغییر-رمز-عبور </span></a></li>
                    <li role="separator" class="divider"></li>
                @if(Auth::guard('admin')->check())
                    <li style="text-align: center"><a href="{{route('Logs.View')}}"><span class="glyphicon glyphicon-envelope"> گزارشات </span></a></li>
                        <li role="separator" class="divider"></li>
                @endif

                    <li style="text-align: center;"><a href="{{route('message.page')}}"><span> پیام <span class="badge">{{\App\Http\Controllers\AjaxMessageController::Count_unread_admin_messages()}}</span></span></a></li>
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center;"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"> خروج </span>
                        </a></li>
                @else
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center"><a href="{{route('update')}}"><span class="glyphicon glyphicon-edit"> ویرایش </span></a></li>
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center"><a href="{{route('uppass')}}"><span class="glyphicon glyphicon-lock"> تغییر-رمز-عبور </span></a></li>
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center;"><a href="{{route('user.messages')}}"><span class="glyphicon glyphicon-envelope"> پیام <span class="badge">{{\App\Http\Controllers\AjaxMessageController::Count_unread_user_message()}}</span></span></a></li>
                    <li role="separator" class="divider"></li>
                    <li style="text-align: center;"><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out"> خروج </span></a></li>
                @endif
            </ul>
        </div>
    </div>
@endif


<div id="header">
    <div class="treedash" onclick="openNav()">&#9776;</div>
    <div id="prlogo"> <img src="{{asset('images/pr.png')}}" class="sitelogo" /></div>

    <nav id="navigation">
        <a href="{{route('home')}}"><input type="button" value="صفحه اصلی" class="btns"  /></a>
        <a href="{{route('ourServices')}}"><input type="button" value="خدمات" class="btns" /></a>
        <a href="{{route('aboutUs')}}"><input type="button" value="درباره ما" class="btns" /></a>
        <a href="{{route('contactUs')}}"><input type="button" value="تماس با ما" class="btns" /></a>
        @if(Auth::user())

        @elseif(!Auth::user() && !Auth::guard('admin')->check())
            <a href="{{route('login')}}"><input type="button" value="ورود به سایت" class="btns" style="float: left;" /></a>
            <a href="{{route('register')}}"><input type="button" value="ثبت نام" class="btns" style="float: left;" /></a>
        @endif
        @if(Auth::guard('admin')->check())

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
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">خروج</a>
    @elseif(!Auth::user() && !Auth::guard('admin')->check())
        <a href="{{route('login')}}">ورود</a>
        <a href="{{route('register')}}">ثبت نام</a>
    @elseif(Auth::guard('admin')->check())
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">خروج</a>
    @endif
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

@yield('contents')

@extends('Layouts.footer')



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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

</body>
</html>
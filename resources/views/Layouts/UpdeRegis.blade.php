<!doctype html>
<html style="margin: 0;padding: 0;height: 100%">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Rahpad-group" />
    <meta name="viewport" content="width=330px, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css\mainpage.css')}}" />
    <link rel="stylesheet" href="{{asset('css\footer.css')}}" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/black-tie/jquery-ui.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
            <script src="{{asset('js\rejs.js')}}"></script>
            <script src="{{asset('js\cropit.js')}}"></script>
            <script>$(function () {function readURL(input) {if (input.files && input.files[0]) {var reader = new FileReader();reader.onload = function (e) {$('#defaultimage').attr('src', e.target.result);};reader.readAsDataURL(input.files[0]);}}$("#userimage").change(function(){readURL(this);});});$(function() {$('.image-editor').cropit();$('form').submit(function() {var imageData = $('.image-editor').cropit('export');$('.hidden-image-data').val(imageData);var formValue = $(this).serialize();$('#result-data').text(formValue);});});</script>
    <title>
        @if(isset($page_title))
            {{$page_title}}
        @else
            پیام رهپاد
        @endif
    </title>
    <link rel="stylesheet" href="{{asset('css\datepicker.css')}}" />
    <style>
        @font-face{
            font-family:'Yekan';
            src:url("{{asset('fonts/BYekan.ttf')}}") format('truetype'),
            url("{{asset('fonts/BYekan.eot?#')}}") format('eot'),
            url("{{asset('fonts/BYekan.woff')}}") format('woff');}

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
    <link rel="stylesheet" href="{{asset('css\header.css')}}" />
</head>
<body style="text-align: right;font-family: Yekan;margin: 0;padding: 0;height:100%;width: 100%;">

<div class="containss">

    @if(Auth::user() || Auth::guard('admin')->check())

        <div class="container">
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

                        <li style="text-align: center;"><a href="{{route('message.page')}}"><span><span class="badge">{{\App\Http\Controllers\AjaxMessageController::Count_unread_admin_messages()}}</span>پیام</span></a></li>
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

<div dir="rtl" id="header">
    <div class="treedash" onclick="openNav()">&#9776;</div>
    <div id="prlogo"> <img src="{{asset('images/pr.png')}}" class="sitelogo" /></div>

    <nav id="navigation">
        <a href="{{route('home')}}"><input type="button" value="صفحه اصلی" class="btns"  /></a>
        <a href="{{route('ourServices')}}"><input type="button" value="خدمات" class="btns" /></a>
        <a href="{{route('aboutUs')}}"><input type="button" value="درباره ما" class="btns" /></a>
        <a href="{{route('contactUs')}}"><input type="button" value="تماس با ما" class="btns" /></a>
        @if(Auth::user())

        @else
            <a href="{{route('login')}}"><input type="button" value="ورود به سایت" class="btns" style="float: left;" /></a>
            <a href="{{route('register')}}"><input type="button" value="ثبت نام" class="btns" style="float: left;" /></a>
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
        <img src="{{asset('images/prfacebook.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <a href="http://instagram.com/rahpadads">
        <img src="{{asset('images/prinstagram.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <a href="https://t.me/Payam_e_Rahpad">
        <img src="{{asset('images/prtelegram.png')}}" style="width: 60px;height: 60px;padding: 10px" />
    </a>
    <br>
    طراحی و راه اندازی پایگاه اینترنتی <a style="color:#F26622;">گروه رهپاد</a>
</div>

</div>
<script>
    jQuery(function(a){a.datepicker.regional.fa={calendar:JalaliDate,closeText:"بستن",prevText:"قبل",nextText:"بعد",currentText:"امروز",monthNames:["فروردين","ارديبهشت","خرداد","تير","مرداد","شهريور","مهر","آبان","آذر","دي","بهمن","اسفند"],monthNamesShort:["فروردين","ارديبهشت","خرداد","تير","مرداد","شهريور","مهر","آبان","آذر","دي","بهمن","اسفند"],dayNames:["يکشنبه","دوشنبه","سه شنبه","چهارشنبه","پنجشنبه","جمعه","شنبه"],dayNamesShort:["يک","دو","سه","چهار","پنج","جمعه","شنبه"],dayNamesMin:["ي","د","س","چ","پ","ج","ش"],weekHeader:"ه",dateFormat:"dd/mm/yy",firstDay:6,isRTL:true,showMonthAfterYear:false,yearSuffix:"",calculateWeek:function(b){var c=new JalaliDate(b.getFullYear(),b.getMonth(),b.getDate()+(b.getDay()||7)-3);return Math.floor(Math.round((c.getTime()-new JalaliDate(c.getFullYear(),0,1).getTime())/86400000)/7)+1}};a.datepicker.setDefaults(a.datepicker.regional.fa)});function JalaliDate(i,h,f){var d;var a;if(!isNaN(parseInt(i))&&!isNaN(parseInt(h))&&!isNaN(parseInt(f))){var c=j([parseInt(i,10),parseInt(h,10),parseInt(f,10)]);e(new Date(c[0],c[1],c[2]))}else{e(i)}function j(l){var k=0;if(l[1]<0){k=leap_persian(l[0]-1)?30:29;l[1]++}var g=jd_to_gregorian(persian_to_jd(l[0],l[1]+1,l[2])-k);g[1]--;return g}function b(k){var g=jd_to_persian(gregorian_to_jd(k[0],k[1]+1,k[2]));g[1]--;return g}function e(g){if(g&&g.getGregorianDate){g=g.getGregorianDate()}d=new Date(g);d.setHours(d.getHours()>12?d.getHours()+2:0);if(!d||d=="Invalid Date"||isNaN(d||!d.getDate())){d=new Date()}a=b([d.getFullYear(),d.getMonth(),d.getDate()]);return this}this.getGregorianDate=function(){return d};this.setFullDate=e;this.setMonth=function(l){a[1]=l;var k=j(a);d=new Date(k[0],k[1],k[2]);a=b([k[0],k[1],k[2]])};this.setDate=function(l){a[2]=l;var k=j(a);d=new Date(k[0],k[1],k[2]);a=b([k[0],k[1],k[2]])};this.getFullYear=function(){return a[0]};this.getMonth=function(){return a[1]};this.getDate=function(){return a[2]};this.toString=function(){return a.join(",").toString()};this.getDay=function(){return d.getDay()};this.getHours=function(){return d.getHours()};this.getMinutes=function(){return d.getMinutes()};this.getSeconds=function(){return d.getSeconds()};this.getTime=function(){return d.getTime()};this.getTimeZoneOffset=function(){return d.getTimeZoneOffset()};this.getYear=function(){return a[0]%100};this.setHours=function(g){d.setHours(g)};this.setMinutes=function(g){d.setMinutes(g)};this.setSeconds=function(g){d.setSeconds(g)};this.setMilliseconds=function(g){d.setMilliseconds(g)}};
</script>
</body>
</html>
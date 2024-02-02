<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href={{asset('css/englishStyle.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(0).fadeIn(500);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(0).fadeOut(500);
            });
        });
    </script>
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img src="{{asset('images/ArashLogo.png')}}" style="width: 291px;height: 54" alt="Company Logo" />
            </div>
        </div>
    </div>
    <div class="container">
        <div class="top-navbar">
            <p class="mb-0 mt-0 d-inline-flex float-right">
                @if(!Auth::user() && !Auth::guard('admin')->check())
                    <a href="{{route('register')}}" class="top-navbar-links d-flex"><span><i>Register</i></span></a>
                    <a  class="d-flex"><span><i>&nbsp;/&nbsp;</i></span></a>
                    <a href="{{route('login')}}" class="top-navbar-links d-flex"><span><i>Login</i></span></a>
                @elseif(Auth::user() && !Auth::guard('admin')->check())
                    <a href="{{route('update')}}" class="top-navbar-links d-flex"><span><i>{{Auth::user()->name . ' ' . Auth::user()->family}}</i></span></a>
                @endif
                @if(Auth::guard('admin')->check())
                    <a href="#" class="top-navbar-links d-flex" style="padding-right: 20px"><span><i>{{\App\Http\Controllers\AdminNameController::adminName()}}</i></span></a>
                @endif
            </p>
        </div>
        <nav class="navbar navbar-expand-lg ftco-navbar-light" id="ftco-navbar">
            <div class="container user-image">
                <div class="order-lg-last">
                    @if(Auth::user() || Auth::guard('admin')->check())
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::guard('admin')->check())
                                <img src="{{asset('images/default1.jpg')}}" class="img-user-image" alt="User Image">
                            @elseif(Auth::user())
                                @if(Auth::user()->hasOne('App\UserImages','user_id','id')->first())
                                    <img src="{{route('userimage',['id'=>Auth::user()->id])}}" class="img-user-image" alt="User Image">
                                @else
                                    <img src="{{asset('images/default1.jpg')}}" class="img-user-image" alt="User Image">
                                @endif
                            @endif
                        </button>
                        @if(Auth::user() || Auth::guard('admin')->check())
                            <div class="dropdown-menu" style="margin:0;padding:0;font-family: Azonix" aria-labelledby="dropdownMenuButton">
                                <a href="{{route('userspagination')}}" class="dropdown-item"><span class="fa fa-user"><span class="Azonix-style">&nbsp;Users</span></span></a>
                                <a href="{{route('addcontent')}}" class="dropdown-item"><span class="fa fa-edit"><span class="Azonix-style">&nbsp;Contents</span></span></a>
                                @if(Auth::guard('admin')->check())
                                    <a class="dropdown-item" href="{{route('message.page')}}"><span class="fa fa-envelope"><span class="Azonix-style">&nbsp;Messages</span></span><span class="badge bg-warning">{{\App\Http\Controllers\AjaxMessageController::Count_unread_admin_messages()}}</span></a>
                                    <a class="dropdown-item" href="{{route('Logs.View')}}"><span class="fa fa-eye"><span class="Azonix-style">&nbsp;Reports</span></span></a>
                                @elseif(Auth::user())
                                    <a class="dropdown-item" href="{{route('user.messages')}}"><span class="fa fa-envelope"><span class="Azonix-style">&nbsp;Messages</span></span><span class="badge bg-warning">{{\App\Http\Controllers\AjaxMessageController::Count_unread_user_message()}}</span></a>
                                @endif
                                @if(Auth::user())
                                    <a class="dropdown-item" href="{{route('update')}}"><span class="fa fa-address-card"><span class="Azonix-style">&nbsp;Edit {{Auth::user()->name}}&nbsp;{{Auth::user()->family}}</span></span></a>
                                @endif
                                <a class="dropdown-item" href="{{route('uppass')}}"><span class="fa fa-lock"><span class="Azonix-style">&nbsp;Change Password</span></span></a>
                                <a class="dropdown-item" href="{{route('logout')}}"><span class="fa fa-window-close"><span class="Azonix-style">&nbsp;Exit</span></span></a>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div id="ftco-nav" class="collapse navbar-collapse CustomFont @if(Auth::user() || Auth::guard('admin')->check()) mainMenuPaddingLeft @endif">
                    <ul class="navbar-nav mr-auto ml-auto" >
                        <li class="nav-item"><a href="#" class="nav-link">HOME</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">ABOUT</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">SITES</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">CONTACTS</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav - Still Ftco-section -->
        @yield('ContentsOfTheSite')
        <div class="footer">
            <div>
                here goes your footer as of now
            </div>
        </div>
    </div>
</section>
</body>
</html>
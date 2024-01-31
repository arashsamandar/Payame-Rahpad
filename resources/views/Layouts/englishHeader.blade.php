<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href={{asset('css/englishStyle.css')}}>
    <title>Header</title>
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">ICON-HERE</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="top-navbar">
            <p class="mb-0 mt-0 d-inline-flex float-right">
                <a href="#" class="top-navbar-links d-flex"><span><i>Register</i></span></a>
                <a  class="d-flex"><span><i>&nbsp;/&nbsp;</i></span></a>
                <a href="#" class="top-navbar-links d-flex"><span><i>Login</i></span></a>
            </p>
        </div>
        <nav class="navbar navbar-expand-lg ftco-navbar-light" id="ftco-navbar">
            <div class="container user-image">
                <div class="order-lg-last">
                        <img src="{{asset('images/default1.jpg')}}" class="img-user-image" />
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse CustomFont" id="ftco-nav">
                    <ul class="navbar-nav mr-auto ml-auto" >
                        <li class="nav-item"><a href="#" class="nav-link">HOME</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">ABOUT</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">SITES</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">CONTACTS</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->
        <div style="margin-top: 200px">
            your content goes here...
        </div>
    </div>
</section>
</body>
</html>
@extends('Layouts.englishHeader')
@section('ContentsOfTheSite')

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page</title>
</head>
<body>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    {{--                     Slider Buttons For Jump                     --}}
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    {{--                     Slider Main Body                     --}}
    <div class="carousel-inner" style="min-height: 400px">
        <div class="carousel-item active">
            <img class="w-100 placeholder" src="{{asset('images/loqQuality-Placeholder.png')}}" alt="First slide Low Image">
            <img class="d-block w-100 loaded" src="{{asset('images/ntwo.jpg')}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>10 Years A Programmer</h5>
                <p>you will get at the very least a 10 years experienced programmer</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="w-100 placeholder" src="{{asset('images/loqQuality-Placeholder.png')}}" alt="First slide Low Image">
            <img class="d-block w-100 loaded" src="{{asset('images/none.jpg')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="w-100 placeholder" src="{{asset('images/loqQuality-Placeholder.png')}}" alt="First slide Low Image">
            <img class="d-block w-100 loaded" src="{{asset('images/nthree.jpg')}}" alt="Third slide">
        </div>
    </div>
    {{--                     Slider Next & Previous Buttons                     --}}
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    {{--                     End Slider                     --}}

<script>
    window.onload = function() {
        var images = document.querySelectorAll(".carousel-item img.loaded");
        images.forEach(function(img) {
            img.previousElementSibling.style.opacity = 0; // Hide the placeholder
            img.style.opacity = 1; // Show the main image
        });

        var placeholders = document.querySelectorAll('.placeholder');
        placeholders.forEach(function(placeholder) {
            placeholder.style.display = 'none'; // Hide the placeholder
        });
    };

</script>
</body>
</html>

@endsection
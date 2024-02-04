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
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin:0;padding:0">
    {{--                     Slider Buttons For Jump                     --}}
    @php $global_imageItterator = \App\Http\Controllers\ImageController::checkContent_Image_Number() @endphp
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        @if(!empty($global_imageItterator))
            @for($i=2;($i - 2)<count($global_imageItterator[0]);$i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
            @endfor
        @endif
    </ol>
    {{--                     Slider Main Body                     --}}
    <div class="carousel-inner carouselInner">
        <div class="carousel-item active">
            <a href="http://localhost:8000/login">
            <img class="w-100 placeholder" src="{{asset('images/loqQuality-Placeholder.png')}}" alt="First slide Low Image">
            <img class="d-block w-100 loaded" src="{{asset('images/ntwo.jpg')}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>10 Years A Programmer</h5>
                <p>you will get at the very least a 10 years experienced programmer</p>
            </div>
            </a>
        </div>
        <div class="carousel-item">
            <a href="http://localhost:8000/register">
            <img class="w-100 placeholder" src="{{asset('images/loqQuality-Placeholder.png')}}" alt="First slide Low Image">
            <img class="d-block w-100 loaded" src="{{asset('images/image-two2.png')}}" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Arash Aghashahi</h5>
                <p>Software Engineer & Web Developer For Monthly Only 3000$</p>
            </div>
            </a>
        </div>
        @if(!empty($global_imageItterator))
            @for($i=0; $i < count($global_imageItterator[0]); $i++)
                <div class="carousel-item">
                    <a href="{{route('page_caller',['page_address' => $global_imageItterator[1][$i]])}}">
                    <img class="w-100 placeholder" src="{{asset('images/loqQuality-Placeholder.png')}}" alt="First slide Low Image" width="100%">
                    <img class="d-block w-100 loaded" src="{{ $global_imageItterator[3][$i] }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $global_imageItterator[1][$i]  }}</h5>
                        <p>{{ $global_imageItterator[2][$i]  }}</p>
                    </div>
                    </a>
                </div>
          @endfor
        @endif
    {{--    Ok sir now it only remains to reload images from the Database to here with captions and such    --}}
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{--                     Slider Next & Previous Buttons                     --}}

</div>
    {{--                     End Slider                     --}}
<div id="test" style="margin-top: 20px">
    <div id="myDiv">
        <div class="row">
            <div class="col-md-4">
                <div class="image-container">
                    <img src="{{asset('images/none.jpg')}}" alt="arashTalentOne" />
                    <div class="caption">Caption 1</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="image-container">
                    <img src="{{asset('images/ntwo.jpg')}}" alt="arashTalentOne" />
                    <div class="caption">Caption 2</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="image-container">
                    <img src="{{asset('images/nthree.jpg')}}" alt="arashTalentOne" />
                    <div class="caption">Caption 3</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="test" style="margin-top: 20px">
    {{--  Add Dynamic Images In Here
          They could all have "col-md-4 as there class and `image-container` & 'caption` class as their image and Caption--}}
</div>
<script>
    {{--  ---------------------------- For Lazy Load PlaceHolder Images In Sliders  ----------------------------}}
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
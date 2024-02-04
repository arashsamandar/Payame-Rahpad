@extends('Layouts.header')
@section('contents')
<!-- Start Slider Container Start  -->
    <div class="container">
        <br><br><br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">

        @php $global_imageItterator = \App\Http\Controllers\ImageController::checkContent_Image_Number() @endphp
            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="position: relative;width: 100%">

                @if(!empty($global_imageItterator))
                    @for ($i = 0; $i < count($global_imageItterator[0]); $i++)

                        <figure class="item" style="background-color: rgba(0, 0, 0, 0.6);color: white;width: 100%">
                            <a href="{{route('page_caller',['page_address' => $global_imageItterator[1][$i]])}}">
                                <img src="{{ $global_imageItterator[3][$i]  }}" style="width:100%;" />
                                <div class="carousel-caption" id="alphablackback" style="background-color: rgba(0, 0, 0, 0.6);color: white;width: 100%;text-align: right;padding-right: 20px" >
                                    <h3 class="h3padding">{{ $global_imageItterator[1][$i]  }}</h3>
                                    <p class="ppadding">{{ $global_imageItterator[2][$i]  }}</p>
                                </div>
                            </a>
                        </figure>
                    @endfor
                @endif
                <!-- Start Slider Default Pictures -->
                <figure class="item">
                    <a href="{{route('ShahrPaad')}}"><img src="{{asset('images/Atehran.jpg')}}" alt="پروژه شهرپاد" title="شهرپاد به یاری فعالان در حوزه مدیریت شهری و روستایی کشور می شتابد. اطلاعات کلیه ارائه دهندگان محصولات و خدمات در حوزه مدیریت شهری و روستایی را جمع آوری کرده و بدون واسطه در اختیار کلیه نیازمندان به این اطلاعات قرار می دهد."  style="width:100%;"></a>
                </figure>

                <figure class="item active">
                    <a href="#"><img src="{{asset('images/Bwebdesign.jpg')}}"  alt="ارائه خدمات طراحی، راه اندازی و پشتیبانی سایت های اینترنتی با استفاده از فناوری های روز دنیا از قبیل PHP، MySQL، Bootstrap، Jscript، Ajax و ..." title="ارائه خدمات طراحی، راه اندازی و پشتیبانی سایت های اینترنتی با استفاده از فناوری های روز دنیا از قبیل PHP، MySQL، Bootstrap، Jscript، Ajax و ..."  style="width:100%;"></a>
                </figure>

                <figure class="item">
                    <a href="#"><img src="{{asset('images/offices.jpg')}}" alt="" title=""  style="width:100%;"></a>
                </figure>

                <figure class="item">
                    <a href="{{route('UrbanManagementAdd')}}"><img src="{{asset('images/zolo.jpg')}}" alt="آگهی نامه مدیریت شهری" title="چاپ و انتشار آگهی نامه ای در حوزه مدیریت شهری و خدمات مرتبط"  style="width:100%;"></a>
                </figure>

            </div>
            <!-- Finish Slider Default Pictures -->
            <!-- Left and right controls -->
            <a class="left carousel-control"  href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            <!-- End Left and right controls -->
        </div>

    </div>
<!-- Finish Slider Container -->
    <br><br><br>

    <div  style="width: 100%;margin: 0 auto;">

        <figure class="prImageNumberOne">
            <a href="{{route('page_caller',['page_address' => 'aboutUs'])}}"><img src="{{asset('images/Bwebdesign.jpg')}}" alt="ارائه خدمات طراحی، راه اندازی و پشتیبانی سایت های اینترنتی با استفاده از فناوری های روز دنیا از قبیل PHP، MySQL، Bootstrap، Jscript، Ajax و ..." title="ارائه خدمات طراحی، راه اندازی و پشتیبانی سایت های اینترنتی با استفاده از فناوری های روز دنیا از قبیل PHP، MySQL، Bootstrap، Jscript، Ajax و ..." class="img-responsive" /></a>
            <figcaption class="Images_figCaption">طراحی و پشتیبانی سایت های اینترنتی</figcaption>

        </figure>

        <figure class="prImageNumberTwo">
            <a href="{{route('ShahrPaad')}}"><img src="{{asset('images/Atehran.jpg')}}" alt="پروژه شهرپاد" title="شهرپاد به یاری فعالان در حوزه مدیریت شهری و روستایی کشور می شتابد. اطلاعات کلیه ارائه دهندگان محصولات و خدمات در حوزه مدیریت شهری و روستایی را جمع آوری کرده و بدون واسطه در اختیار کلیه نیازمندان به این اطلاعات قرار می دهد." class="img-responsive" /></a>
            <figcaption class="Images_figCaption">پروژه شهرپاد</figcaption>
        </figure>
        <figure class="prImageNumberThree">
            <a href="{{route('UrbanManagementAdd')}}"><img src="{{asset('images/zolo.jpg')}}" alt="آگهی نامه مدیریت شهری" title="چاپ و انتشار آگهی نامه ای در حوزه مدیریت شهری و خدمات مرتبط" class="img-responsive" /></a>
            <figcaption class="Images_figCaption">آگهی نامه مدیریت شهری</figcaption>
        </figure>

    </div>

    @php
        $global_imageIterator_bellowSlider = \App\Http\Controllers\ImageController::checkContent_Image_Number_Bellow_Slider();
        if(!empty($global_imageIterator_bellowSlider)) {
            $number_ofImages = count($global_imageIterator_bellowSlider[0]);
            $counter = 0;
        }

    @endphp

    @if(!empty($global_imageIterator_bellowSlider))
        @while($counter < $number_ofImages)
            <div  style="width: 100%;">
                @if(isset($global_imageIterator_bellowSlider[0][$counter]))
                    <figure class="ImageNumberOne">
                        <a href="{{route('page_caller',['page_address' => $global_imageIterator_bellowSlider[1][$counter]])}}"><img src="{{$global_imageIterator_bellowSlider[3][$counter++]}}" class="img-responsive" /></a>
                        <figcaption class="Images_figCaption">{{$global_imageIterator_bellowSlider[1][$counter -1]}}</figcaption>
                    </figure>
                @endif
                @if(isset($global_imageIterator_bellowSlider[0][$counter]))
                    <figure class="ImageNumberTwo" >
                        <a href="{{route('page_caller',['page_address' => $global_imageIterator_bellowSlider[1][$counter]])}}"><img src="{{$global_imageIterator_bellowSlider[3][$counter++]}}" class="img-responsive" /></a>
                        <figcaption class="Images_figCaption">{{$global_imageIterator_bellowSlider[1][$counter -1]}}</figcaption>
                    </figure>
                @endif
                @if(isset($global_imageIterator_bellowSlider[0][$counter]))
                    <figure class="ImageNumberThree" >
                        <a href="{{route('page_caller',['page_address' => $global_imageIterator_bellowSlider[1][$counter]])}}"><img src="{{$global_imageIterator_bellowSlider[3][$counter++]}}" class="img-responsive" /></a>
                        <figcaption class="Images_figCaption">{{$global_imageIterator_bellowSlider[1][$counter -1]}}</figcaption>
                    </figure>
                @endif
            </div>
        @endwhile
    @endif


@endsection
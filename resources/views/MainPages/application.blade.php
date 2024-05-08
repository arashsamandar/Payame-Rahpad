@extends('Layouts.englishHeader')
<title>
    Application Documentation
</title>
@section('ContentsOfTheSite')

    <div class="pageContent_OuterDiv">
        <h3 class="pageContent_Header">
            Application Documentation :
        </h3>

        <div class="pageContent_InnerDiv">
            Hello and Welcome to my personal website :<br>
            Although this is a personal website it is also a web application that you could use to put your site address and web apps that i have wrote
            for you or to promote a service.
            you can generate content and put it in the first page ( i will see it and approve or message you within this site ).
            if you need just login and play with it :) . i would be happy to help or show your site and content. Go Register & Use.
        </div>
        <div style="">
            <img class="application-image" src="{{asset('/images/user-page.pn.jpg')}}" alt="user page" style="display: block; margin: auto; max-width: 100%; height: auto;" />
        </div>

    </div>
@endsection

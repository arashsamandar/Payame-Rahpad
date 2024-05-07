@extends('Layouts.englishHeader')
<title>
    Application Documentation
</title>
@section('ContentsOfTheSite')

    <div style="width: 100%;height: auto;margin: 50px auto;border:#eee solid 1px;border-radius: 5px;">
        <h3 style="margin-left:100px;margin-right:50px;padding:10px;border:#eee solid 1px;border-radius: 5px;">
            Application Documentation :
        </h3>

        <div style="margin-left:100px;margin-right:50px;margin-bottom:30px;padding:10px;border-radius: 5px;overflow:auto;text-align: justify;">
            Hello and Welcome to my personal website :<br>
            Although this is a personal website it is also a web application that you could use to put your site address and web apps that i have wrote
            for you or to promote a service.
            you can generate content and put it in the first page ( i will see it and approve or message you within this site ).
            if you need just login and play with it :) . i would be happy to help or show your site and content. Go Register & Use.
        </div>
        <div style="text-align: center; margin: 0 auto;">
            <img src="{{asset('/images/user-page.pn.jpg')}}" alt="user page" style="display: block; margin: auto; max-width: 100%; height: auto;" />
        </div>

    </div>
@endsection

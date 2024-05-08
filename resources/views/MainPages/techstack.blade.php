@extends('Layouts.englishHeader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-mfizz/2.4.1/font-mfizz.min.css" />
<title>
    Arash Tech Stack
</title>
<style type="text/css">
    .glyph-sample {cursor: pointer;}
    .glyph-sample:hover { color:darkblue; }
</style>
@section('ContentsOfTheSite')

    <div class="pageContent_OuterDiv">
        <h3 class="pageContent_Header">
            Arash Tech_Stack :
        </h3>

        <div class="pageContent_InnerDiv">
            Hello and Welcome to my personal website :<br>
            My name is arash i am 35 and i am a freelancer<br>
            Bellow you can see a recent list of the technologies i have worked with <br>( The technologies i have worked for but forgot are not listed otherwise the list would be much longer )

            <br><br>

            <span style="font-weight: bold">Servers & OS  &nbsp;</span>
            <i class="fab fa-windows glyph-sample" style="font-size: 3em"></i>
            <i class="icon-centos glyph-sample" style="font-size: 3em"></i>
            <i class="icon-ubuntu glyph-sample" style="font-size: 3em"></i>
            <i class="icon-apache glyph-sample" style="font-size: 3em"></i>
            <i class="icon-nginx glyph-sample" style="font-size: 3em"></i>
            <i class="fab fa-android glyph-sample" style="font-size: 3em"></i>
            <br><br>

            <span style="font-weight: bold">Version Control &nbsp;</span>
            <i class="icon-git glyph-sample" style="font-size: 3em"></i><br><br>


            <span style="font-weight: bold">Databases &nbsp;</span>
            <i class="icon-mongodb glyph-sample" style="font-size: 3em"></i>
            <i class="icon-mysql glyph-sample" style="font-size: 3em"></i>
            <i class="icon-mssql glyph-sample" style="font-size: 3em"></i><br><br>

            <span style="font-weight: bold">Frameworks &nbsp;</span>
            <i class="icon-bootstrap glyph-sample" style="font-size: 3em"></i>
            <i class="icon-jquery glyph-sample" style="font-size: 3em"></i>
            <i class="icon-laravel glyph-sample" style="font-size: 3em"></i>
            <i class="icon-reactjs glyph-sample" style="font-size: 3em"></i>
            <img style="vertical-align:baseline" src="{{asset('/images/nextjs.webp')}}" width="6%" alt="next.js" />
            <br><br>

            <span style="font-weight: bold">Programming Languages &nbsp;</span>
            <i class="icon-html5 glyph-sample" style="font-size: 3em"></i>
            <i class="icon-css3 glyph-sample" style="font-size: 3em"></i>
            <i class="icon-javascript glyph-sample" style="font-size: 3em"></i>
            <i class="icon-php glyph-sample" style="font-size: 3em"></i>
            <i class="icon-java-bold glyph-sample" style="font-size: 3em"></i>
            <br><br>


            <span style="font-weight: bold">Runtime & PackageManagers &nbsp;</span>
            <i class="icon-nodejs glyph-sample" style="font-size: 3em"></i>
            <i class="icon-npm glyph-sample" style="font-size: 3em"></i><br><br>

            <span style="font-weight: bold">Responsive & MobileFirst &nbsp;</span>
            <i class="icon-mobile-device glyph-sample" style="font-size: 3em"></i><br><br>
        </div>
    </div>
@endsection

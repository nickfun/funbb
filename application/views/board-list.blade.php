<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('top-title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        {{ Asset::container('bootstrapper')->styles(); }}
        @yield('style-sheets')
        <style>
        body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
        </style>
        {{ Asset::container('bootstrapper')->scripts(); }} 
        @yield('scripts')
    </head>
    <body>

        <div class="container">

            <div class="hero-unit">
                <h1>FunBB - Discussions for everyone!</h1>
                <p>Welcome to our website about talking and communication</p>
            </div>

            <div class="span12">
                <p>Here are the boards</p>
            </div>

            @foreach( $boardlist as $board )
            <div class="row">
                <div class="span1 well"> <h3> &gt; &gt; &gt; </h3> </div>
                <div class="span10 well "> <h3>{{$board->description}}</h3> </div>
            </div>
            @endforeach


        </div>

    </body>
</html>
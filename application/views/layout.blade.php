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

            @yield('content')

        </div>

    </body>
</html>
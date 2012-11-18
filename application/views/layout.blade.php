<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FunBB :: @yield('top-title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="{{URL::to_asset('css/funbb.css')}}">
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

            {{-- Setup the Navigation Bar --}}
            <ul class="nav nav-pills">
                <li><a href="{{URL::to('/')}}">Home</a></li>
                <li><a href="{{URL::to('auth/users')}}">User list</a></li>
                @if( Auth::guest() )
                <li><a href="{{URL::to('auth/login')}}">Login</a></li>
                <li><a href="{{URL::to('auth/register')}}">Register</a></li>
                @else
                <li><a href="{{URL::to('auth/logout')}}">Logout</a></li>
                @endif
            </ul>

            {{-- Setup the little notification widgets --}}

            @if( Session::get('status') == 'login-success')
            <div class="row">
                <div class="span6 alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    You are now logged in!
                </div>
            </div>
            @endif

            @if( Session::get('status') == 'login-fail')
            <div class="row">
                <div class="span6 alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    Login Failed!
                </div>
            </div>
            @endif

            @if( Session::get('status') == 'logout')
            <div class="row">
                <div class="span6 alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    You are now logged out
                </div>
            </div>
            @endif

            @if( Session::get('status') == 'register-success')
            <div class="row">
                <div class="span6 alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    You have registered! You are now logged in
                </div>
            </div>
            @endif

            {{-- SHOW THE REAL CONTENTS HERE --}}

            @yield('content')

            {{-- Misc stuff after the contents --}}

            @if( Auth::guest() )
            <div class="row">
                <div class="span12 alert">
                    <a href="{{URL::to('auth/login')}}">You need to login</a>
                </div>
            </div>
            @endif

        </div>

    </body>
</html>
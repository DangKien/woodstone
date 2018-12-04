<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        {{--<title> @yield('title') </title>--}}
        @yield('meta')
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <script>
            var SiteUrl = '{{url("/")}}';
        </script>
        @includeif ('Frontend.Layouts._css_default')
        @yield('myCss')
        @includeif ('Frontend.Layouts._angular')
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        @php
            $logo = app('Setting')->getLogo();
            $contact = app('Setting')->getContact();
            $menus = app('Home')->getMenu();
        @endphp
        <div class="main-wrapper">
            <div class="main-content-wrapper">
                @includeif ('Frontend.Layouts._header')
                @yield('slide')
                @yield('content')
                @includeif ('Frontend.Layouts._footer')
            </div>
            @includeif ('Frontend.Layouts._js_default')
            @yield('myJs')
        </div>
    </body>
</html>

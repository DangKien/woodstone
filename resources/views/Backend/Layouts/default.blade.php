<!DOCTYPE html>
<html>
    <head>
        <title> {{ __('backend.name_website') }} </title>
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Open Graph -->
        <meta property="og:title" content="@yield('metaTitle')" />
        <meta property="og:url" content="{{ url()->full() }}" />
        <meta property="og:image" content="@yield('metaImage')"/>
        <meta property="og:description" content="@yield('meta_description')" />
        <meta property="fb:app_id" content=""/>
        
        <!-- Schema.org markup for Google+ --> 
        <meta itemprop="name" content="@yield('metaTitle')">
        <meta itemprop="description" content="@yield('metaDescription')">
        <meta itemprop="image" content="@yield('metaImage')"> 

        <!-- meta -->
        <meta name="description" content="@yield('metaDescription')">
        <meta name="keywords" content="@yield('metaKeyword')">
        <meta name="news_keywords" content="@yield('metaKeyword')" />
        <meta name="google-site-verification" content="" />

        <meta name="rating" content="general"/>
        <meta name="robots" content="all"/>
        <meta name="robots" content="index, follow"/>
        <meta name="revisit-after" content="1 days"/>

        <script>
            var SiteUrl = '{{url("/")}}';
            var headingNotifi = {
                success: '{!! trans("confirm.success")!!}',
                failue: '{!! trans("confirm.failue")!!}',
                warning: '{!! trans("confirm.warning") !!}'
            };
            var messageNotifi = {
                success: '{!! trans("confirm.message_success") !!}',
                failue: '{!! trans("confirm.message_failue")!!}',
                warning: '{!! trans("confirm.message_warning") !!}'
            };
            var ConfirmBtn = {
                confirm: '{!! trans("confirm.btn_confirm")!!}',
                cancel: '{!! trans("confirm.btn_cancel")!!}',
            };
            var textConfirm = '{!! trans("confirm.text_confirm") !!}';
        </script>
        @includeif ('Backend.Layouts._css_default')
        @includeif ('Backend.Layouts._css')
        @yield('myCss')
        @includeif ('Backend.Layouts._angular')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
    </head>
    <body ng-app="ngApp" ng-cloak class="nifty-ready pace-done">
        <div id="container" class="effect mainnav-lg">
            <div class="boxed">
                @includeif ('Backend.Layouts._header')

                @yield('content')

                @includeif ('Backend.Layouts._menu')
             </div>
            @includeif ('Backend.Layouts._js_default')
            @includeif ('Backend.Layouts._js')
            @yield('myJs')
            @includeif ('Backend.Layouts._footer')
        </div>
    </body>
</html>

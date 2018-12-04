<div class="header_top_area">
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="login_bx">
                    <a href="{{ route('home.index') }}"><i class="fa  fa"></i>{{ __('frontend.lable.home') }}</a>
                    <a href="{{ route('home.contact') }}">|<i class="fa  fa"></i>{{ __('frontend.lable.contact_us') }} </a>
                    <a>|</a>
                    <a class="{{ App::getLocale() == 'en' || isset($_COOKIE['locale']) && $_COOKIE['locale'] == 'en' ? 'active' : '' }}" href="{{ route('home.locale', ['locale' => 'en']) }}"> En {{ $_COOKIE['locale'] }} </a>
                    <a>|</a>
                    <a class="{{ ( isset($_COOKIE['locale']) && $_COOKIE['locale'] == 'tw'  ) ? 'active' : '' }}" href="{{ route('home.locale', ['locale' => 'tw']) }}"> Tw </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navigation -->
<div class="navigation_area">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header col-md-2 col-sm-2">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="{{ route('home.index') }}"><img src="{{ url('').@$logo->setting->top }}" alt="logo"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse col-md-7 col-sm-8" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    {{ showMenuTop($menus, 0) }}
                    <li> <a href="{{ route('home.news') }}">{{ __('frontend.lable.new_center') }}</a> </li>
                    <li> <a href="{{ route('home.about') }}">{{ __('frontend.lable.company') }}</a> </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
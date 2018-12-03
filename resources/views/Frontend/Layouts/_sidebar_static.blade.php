<div class="col-md-4">
    <div class="shop_sidebar">
        <div class="block_categories">
            <div class="category_top_menu widget">
                <div class="widget_title">
                    <h3>{{ __('frontend.sidebar.company') }}</h3>
                </div>
                <ul class="shop_toggle">
                    <li class="{{ request()->is('about-us.html') ? 'active' : '' }}">
                        <p><a href="{{ route('home.about') }}">{{ __('frontend.label.about') }} <span class="holder"></span></a></p>
                    </li>
                    <li class="{{ request()->is('quality.html') ? 'active' : '' }}">
                        <p><a href="{{ route('home.quality') }}">{{ __('frontend.label.quality') }} <span class="holder"></span></a></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
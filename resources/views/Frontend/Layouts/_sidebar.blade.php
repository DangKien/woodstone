@php
    $categories = app('Home')->getMenu();
    $active = @$depth ? explode('/', $depth) : array();
@endphp
<div class="col-md-4">
    <div class="shop_sidebar">
        <div class="block_categories">
            <div class="category_top_menu widget">
                <div class="widget_title">
                    <h3>{{ __('frontend.sidebar.product') }}</h3>
                </div>
                {{ showCategory($categories, 0, $active) }}
            </div>
        </div>
    </div>
</div>
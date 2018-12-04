@php
    $slides = app('Home')->getSlide();
@endphp

<div class="slider_area">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($slides as $key => $slide)
                <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                    {{ $key + 1 }}
                </li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach ($slides as $key => $slide)
                <div class="item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ url('').$slide->image }}" alt="Chania">
                </div>
            @endforeach
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="fa fa-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="fa fa-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>
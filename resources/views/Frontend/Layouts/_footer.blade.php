<div class="clearfix"></div>
@php
    $categories = app('Home')->getCateFooter();
    $count = 0;
@endphp
<footer>
    <div class="container">
        <div class="row">
            <div class="footer_area">
                @foreach ($categories as $key => $item)
                    @if ($item->parent_id == 0)
                        <div class="footer_bx footer_bx{{ $count+1 }}">
                            <h3>{{ $item->name }}</h3>
                            @foreach ($categories as $value)
                                @if ($value->parent_id == $item->id)
                                    <h6><span>- {{ $value->name }}</span></h6>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
                <div class="footer_bx footer_bx3">
                    <img src="{{ url('').@$logo->setting->bottom }}" alt="">
                    <h6><span>{{ __('frontend.contact.fax') }}:</span> {{ @$contact->setting->fax }}</h6>
                    <h6><span>{{ __('frontend.contact.email') }}:</span> {{ @$contact->setting->email }}</h6>
                    <h6><span>{{ __('frontend.contact.location') }}:</span>  {{ @$contact->setting->address }} </h6>
                    <h6><span>{{ __('frontend.contact.phone') }}:</span> {{ @$contact->setting->phone }}</h6>
                </div>
            </div>
            <div class="copyright_area"><span>Cassandra</span> -  Design by <span><a href="" target="_blank">DigitalCenturySF</a></span></div>holder
        </div>
    </div>
</footer>
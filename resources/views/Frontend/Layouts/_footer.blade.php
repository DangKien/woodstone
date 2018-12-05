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
                    <h6><span>{{ __('frontend.contact.fax') }}:</span> {{ @$contact->setting['fax'][$lang->id] }}</h6>
                    <h6><span>{{ __('frontend.contact.email') }}:</span> {{ @$contact->setting['email'][$lang->id] }}</h6>
                    <h6><span>{{ __('frontend.contact.location') }}:</span>  {{ @$contact->setting['address'][$lang->id] }} </h6>
                    <h6><span>{{ __('frontend.contact.phone') }}:</span> {{ @$contact->setting['phone'][$lang->id] }}</h6>
                </div>
            </div>
            <div class="copyright_area"><span>{{ @$contact->setting['copy_right'][$lang->id] }}</span></div>
        </div>
    </div>
</footer>
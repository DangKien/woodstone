@extends('Frontend.Layouts.default')

@section ('content')
    @php
        $banners = app('Setting')->getBanner();
        $contact = app('Setting')->getContact();
    @endphp
    <div class="inner_top_area mrzn_zero" style="background-image: url({{ url('').@$banners->setting->contact }});">
        <h2>{{ __('frontend.label.contact') }}</h2>
        <h5><a href="{{ route('home.index') }}">{{ __('frontend.lable.home') }}</a> | {{ __('frontend.label.contact') }} </h5>
    </div>
    <div class="cnct_wrapper">
        <div class="container">
            <div class="row">
                <div class="cnct_section1">
                    <ul>
                        <li>
                            <figure><img src="{{ url('Frontend') }}/images/location_icon.png" alt="location Icon"></figure>
                            <div class="cnct_des">
                                <h4>{{ __('frontend.contact.location') }}</h4>
                                <h6> {{ @$contact->setting['address'][$lang->id] }} </h6>
                            </div>
                        </li>
                        <li>
                            <figure><img src="{{ url('Frontend') }}/images/work_icon.png" alt="location Icon"></figure>
                            <div class="cnct_des">
                                <h4>{{ __('frontend.contact.email') }}</h4>
                                <h6>{{ @$contact->setting['email'][$lang->id] }}</h6>
                            </div>
                        </li>
                        <li>
                            <figure><img src="{{ url('Frontend') }}/images/phone_icon.png" alt="location Icon"></figure>
                            <div class="cnct_des">
                                <h4>{{ __('frontend.contact.phone') }}</h4>
                                <h6>{{ __('frontend.contact.phone') }}: {{ @$contact->setting['phone'][$lang->id] }}<br>
                                    {{ __('frontend.contact.fax') }}: {{ @$contact->setting['fax'][$lang->id] }}
                                </h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cnct_map">
            {!!  @$contact->setting['google_map'][$lang->id]  !!}
        </div>
    </div>
@endsection
@section ('myJs')
@endsection
@section ('myCss')
@endsection
@section ('meta')
    @php
        $arrMeta['title'] = __('frontend.label.contact');
        $arrMeta['meta_image'] = '';
        $arrMeta['meta_keyword'] = '';
        $arrMeta['meta_description'] = '';
    @endphp
    @includeIf('Frontend.Layouts._meta', $arrMeta)
@endsection
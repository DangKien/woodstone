@extends('Frontend.Layouts.default')

@section ('content')
    @php
        $contact = app('Setting')->getContact();
    @endphp
    <div class="inner_top_area mrzn_zero">
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
                                <h6> {{ @$contact->setting->address }} </h6>
                            </div>
                        </li>
                        <li>
                            <figure><img src="{{ url('Frontend') }}/images/work_icon.png" alt="location Icon"></figure>
                            <div class="cnct_des">
                                <h4>{{ __('frontend.contact.email') }}</h4>
                                <h6>{{ @$contact->setting->email }}</h6>
                            </div>
                        </li>
                        <li>
                            <figure><img src="{{ url('Frontend') }}/images/phone_icon.png" alt="location Icon"></figure>
                            <div class="cnct_des">
                                <h4>Phone No</h4>
                                <h6>{{ __('frontend.contact.phone') }}: {{ @$contact->setting->phone }}<br>
                                    {{ __('frontend.contact.fax') }}: {{ @$contact->setting->fax }}
                                </h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <div class="cnct_frm">
            <div class="container">
                <div class="row">
                    <div class="blog_section3">
                        <div class="site-section-area">
                            <h2>Have Any Question</h2>
                            <h6>The Best Choice of Organic Foods</h6>
                        </div>
                        <div class="comment_frm">
                            <ul>
                                <li>
                                    <input type="text" placeholder="Your Name*">
                                </li>
                                <li>
                                    <input type="text" placeholder="Your Email*">
                                </li>
                                <li>
                                    <input type="text" placeholder="Phone No*">
                                </li>
                                <li>
                                    <input type="text" placeholder="Subject*">
                                </li>
                                <li>
                                    <textarea placeholder="Your Review*"></textarea>
                                </li>
                            </ul>
                            <p>
                                <button class="cmn_btn1">send message</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="cnct_map">
            {{ @$contact->setting->gg_map }}
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
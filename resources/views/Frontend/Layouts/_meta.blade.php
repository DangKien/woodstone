@php
    $metaDefault = app('Setting')->getSeo();
@endphp
<!-- Mobile Specific Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Favicon-->
<link rel="shortcut icon" href="img/fav.png">
<!-- Author Meta -->
<meta name="author" content="colorlib">
<!-- Meta Description -->
<meta property="og:title" content="{{ empty(@$arrMeta['title']) ? @$metaDefault->setting->title : @$arrMeta['title'] }}" />
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:image" content="{{ url('') }}{{ empty(@$arrMeta['meta_image']) ? '' : @$arrMeta['meta_image'] }}"/>
<meta property="og:description" content="{{ empty(@$arrMeta['meta_description']) ? @$metaDefault->setting->description : @$arrMeta['meta_description'] }}" />
<meta property="fb:app_id" content=""/>

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ empty(@$arrMeta['meta_keyword']) ? '' : @$arrMeta['meta_keyword'] }}">
<meta itemprop="description" content="{{ empty(@$arrMeta['meta_description']) ? @$metaDefault->setting->description : @$arrMeta['meta_description'] }}">
<meta itemprop="image" content="{{ url('') }}{{ empty(@$arrMeta['meta_image']) ? @$metaDefault->setting->image : @$arrMeta['meta_image'] }}">

<!-- meta -->
<meta name="description" content="{{ empty(@$arrMeta['meta_description']) ? @$metaDefault->setting->description : @$arrMeta['meta_description'] }}">
<meta name="keywords" content="{{ empty(@$arrMeta['meta_keyword']) ? @$metaDefault->setting->keyword : @$arrMeta['meta_keyword'] }}">
<meta name="news_keywords" content="{{ empty(@$arrMeta['meta_keyword']) ? @$metaDefault->setting->keyword : @$arrMeta['meta_keyword'] }}" />
<meta name="google-site-verification" content="{{ @$metaDefault->setting->google_site }}" />

<meta name="rating" content="general"/>
<meta name="robots" content="all"/>
<meta name="robots" content="index, follow"/>
<meta name="revisit-after" content="1 days"/>
<!-- Site Title -->

<title> {{ !empty(@$arrMeta['title']) ? @$arrMeta['title'] : @$metaDefault->setting->title  }} </title>
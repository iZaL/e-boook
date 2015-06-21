@include('partials.fonts')
<link rel="stylesheet" href="/css/app.css"/>
@if(App::getLocale() === 'ar')
    <link href="/css/bootstrap-rtl.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom_ar.css">
@endif
{{--<link rel="stylesheet" href="/bower_components/nivoslider/nivo-slider.css">
<link rel="stylesheet" href="/bower_components/colorbox/example1/colorbox.css">
<link rel="stylesheet" href="/bower_components/nivoslider/themes/bar/bar.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="/bower_components/nivoslider/themes/light/light.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="/bower_components/fontawesome/css/font-awesome.min.css" type="text/css"/>
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/custom.css">--}}
<link rel="stylesheet" href="/css/everything.css"/>
@if(App::getLocale() === 'en')
    <link rel="stylesheet" href="/css/custom_en.css">
@endif
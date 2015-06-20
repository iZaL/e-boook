<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"><![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="nl"><![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="nl"><![endif]-->
<!--[if IE]>
<html class="no-js ie" lang="nl"><![endif]-->
<!--[if !IE]><!-->
<html class="no-js" lang="nl"><!--<![endif]-->

<head>

    <meta charset="utf-8">
    <title>@yield(strip_tags('title'),'E-Boook')</title>
    <meta name="description" content="Page description here">
    <meta name="author" content="BigBase - D. Tiems">
    <meta name="viewport" content="width=device-width">
    @section('style')
        @include('partials.fonts')
        <link rel="stylesheet" href="/css/app.css"/>
        @if(App::getLocale() == 'ar')
            <link href="css/bootstrap-rtl.css" rel="stylesheet">
            <link rel="stylesheet" href="/css/custom_ar.css">
        @endif

        <link rel="stylesheet" href="/css/everything.css"/>
        @if(App::getLocale() == 'en')
            <link rel="stylesheet" href="/css/custom_en.css">
        @endif

    @show

    @section('script')
        <script src="/js/config.js"></script>
        <script src="/bower_components/modernizr/modernizr.js"></script>

        <script src="/js/app.js"></script>

        <script src="/bower_components/nivoslider/jquery.nivo.slider.pack.js"></script>
        <script src="/bower_components/colorbox/jquery.colorbox-min.js"></script>
        <script src="/bower_components/respond/dest/respond.min.js"></script>
        <script src="/js/script.js"></script>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES * * */
            var disqus_shortname = 'ebookapp';

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function () {
                var s = document.createElement('script'); s.async = true;
                s.type = 'text/javascript';
                s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
            }());
        </script>
    @show

</head>

<body>

<div class="header-shadow"></div>

<div class="container">

    @include('partials.header')

    <h4>@yield('title')</h4>

    @include('partials.notifications')

    @section('content')
    @show

    @include('partials.subfooter')

</div>



</body>


</html>

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
        @include('partials.styles')

    @show



</head>

<body>

<div class="header-shadow"></div>

<div class="container">

    @include('admin.partials.header')

    @yield('title')

    @include('admin.partials.notifications')

    @section('content')
    @show

    @include('partials.subfooter')

    {{--@include('partials.footer')--}}

</div>
@section('script')
    @include('partials.scripts')
@show
</body>


</html>

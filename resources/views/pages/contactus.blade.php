@extends('layouts.one_col')
@section('content')
    <div class="row">

        @include('forms.contactus')
        <div class="col-xs-12 col-sm-6">
            <div class="well">

                <!-- START CONTENT ITEM -->
                <address>
                    <strong>{{ $contactusInfo->company }}</strong><br>
                    {{ $contactusInfo->address }}<br>
                    {{ $contactusInfo->zipcode }}<br>
                    {{ $contactusInfo->country }}<br>
                    <br>
                    <strong>Phone</strong>: {{ $contactusInfo->phone }}<br>
                    <strong>Phone</strong>: {{ $contactusInfo->mobile }}<br>
                    <strong>E-mail</strong>: {{ $contactusInfo->email }}<br>
                </address>
                <div class="googlemap">
                    <img src="/img/logo.png" alt="" class="img-responsive text-center col-lg-3 col-md-3 col-lg-offset-4 col-md-offset-4"/>
                </div>
                <!-- END CONTENT ITEM -->

            </div>
        </div>

    </div>

@stop
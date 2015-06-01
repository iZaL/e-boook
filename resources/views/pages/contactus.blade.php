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
                    <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;ll=42.065607,-77.189941&amp;spn=15.324445,23.620605&amp;t=m&amp;z=6&amp;output=embed"></iframe>
                </div>
                <!-- END CONTENT ITEM -->

            </div>
        </div>

    </div>

@stop
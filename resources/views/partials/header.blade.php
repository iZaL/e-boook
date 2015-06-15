<header>

    <!-- Facebook div for like button -->
    <div id="fb-root"></div>

    <!-- toolbar -->
    @include('partials.toolbar')

    <div class="row header-top hidden-print">
        <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2 ">

            <!-- START CONTENT ITEM -->
            <img src="/img/logo.png" alt="Logo" class="img-responsive logo" style="max-width: 110px;">
            <!-- END CONTENT ITEM -->

        </div>

        <div class="hidden-xs hidden-sm col-md-offset-6 col-lg-offset-5 col-md-3 col-lg-4">


            <!-- START CONTENT ITEM -->
            {!! Form::open(['action'=>'BookController@showSearchResults','method'=>'get']) !!}
            <div class="input-group form-search header-search">
                <input class="form-control search-query" type="text" placeholder="Search all books..." name="search">
                <span class="input-group-btn">
                    {!! Form::submit(trans('word.search'), ['class' => 'btn btn-default form-control']) !!}
                </span>
            </div>
            {!! Form::close() !!}
            <!-- END CONTENT ITEM -->

{{--            <img src="/img/banner_top.jpg" alt="No shipping" class="img-responsive">--}}

        </div>
    </div>
        @include('partials.mainmenu')
</header>
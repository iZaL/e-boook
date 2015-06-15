<header>

    <!-- Facebook div for like button -->
    <div id="fb-root"></div>

    <!-- toolbar -->
@include('admin.partials.toolbar')

    <div class="row header-top hidden-print">

        <div class="col-xs-12 col-sm-5 col-md-1 col-lg-1 ">
            <!-- START CONTENT ITEM -->
            <img src="/img/logo.png" alt="Logo" class="img-responsive logo" style="max-width: 70px;">
            <!-- END CONTENT ITEM -->
        </div>


        <div class="col-lg-4 pull-right">
            <h2>{{ trans('word.control-panel') }}</h2>
        </div>


    </div>
        @include('admin.partials.mainmenu')
</header>
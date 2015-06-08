<div class="row hidden-print ethiopic">
    <div class="col-xs-12">

        <!-- START CONTENT ITEM -->
        <nav class="navbar navbar-default main-nav" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left {{ App::getLocale() === 'ar' ? 'pull-right': '' }}">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ trans('word.home') }}</a></li>
                    <li><a href="{{ route('category.index') }}">{{ trans('word.categories') }}</a></li>
                    <li><a href="{{ route('book.index') }}">{{ trans('word.books') }}</a></li>
                    {{--<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('word.read') }} <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/home/15">{{ trans('word.books') }}</a></li>
                            <li><a href="#">{{ trans('word.poems') }}</a></li>
                        </ul>
                    </li>--}}
                    <li><a href="{{ url('contactus') }}">{{ trans('word.contact-us') }}</a></li>
                </ul>
            </div>
        </nav>
        <!-- END CONTENT ITEM -->

    </div>
</div>
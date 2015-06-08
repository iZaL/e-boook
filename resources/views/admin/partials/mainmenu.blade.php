<div class="row hidden-print ethiopic">
    <div class="col-xs-12">

        <!-- START CONTENT ITEM -->
        <nav class="navbar navbar-inverse main-nav" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ action('Admin\AdminBookController@index') }}"><i class="fa fa-mortar-board"></i>&nbsp;{{ trans('word.control-panel') }}</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left {{ App::getLocale() == 'ar' ? 'pull-right': '' }}">
                    <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i>&nbsp; {{ trans('word.go-back-home') }}</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="/admin/book"><i class="fa fa-book fa-aw"></i>&nbsp; {{ trans('word.books') }} <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('Admin\AdminBookController@index') }}"><i class="fa fa-pencil fa-fw"></i>&nbsp;{{ trans('word.books') }}</a></li>
                            <li><a href="{{ action('Admin\AdminBookController@create') }}"><i class="fa fa-pencil fa-fw"></i>&nbsp;{{ trans('word.create-book') }}</a></li>
                            <li><a href="/admin/book/create"><i class="fa fa-align-center fa-fw"></i>&nbsp;{{ trans('word.create-poem') }}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="/category"><i class="fa fa-folder-open-o fa-aw"></i>&nbsp;{{ trans('word.categories') }} <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('CategoryController@index') }}"><i class="fa fa-indent fa-fw"></i>&nbsp;{{ trans('word.categories') }}</a></li>
                            <li><a href="{{ action('Admin\AdminCategoryController@create') }}"><i class="fa fa-indent fa-fw"></i>&nbsp;{{ trans('word.create-category') }}</a></li>
                        </ul>
                    <li><a href="{{ action('Admin\AdminContactUsController@edit') }}"><i class="fa fa-indent fa-fw"></i>&nbsp;{{ trans('word.contact-us') }}</a></li>
                    </li>


                </ul>
            </div>
        </nav>
        <!-- END CONTENT ITEM -->

    </div>
</div>
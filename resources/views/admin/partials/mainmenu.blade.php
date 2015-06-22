
<div class="row hidden-print ethiopic">
    <div class="col-xs-12">

        <!-- START CONTENT ITEM -->
        <nav class="navbar navbar-inverse main-nav" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ (Session::get('role.admin')) ? route('app.admin.book.index') : route('app.editor.book.index')  }}"><i class="fa fa-mortar-board"></i>&nbsp;{{ trans('word.control-panel') }}</a>
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
                    @if(Session::get('role.admin'))
                    <li><a href="{{ action('Admin\AdminUserController@index') }}"><i class="fa fa-users"></i>&nbsp; {{ trans('word.users') }}</a></li>
                    {{--<li><a href="{{ action('Admin\BookController@getOrders') }}"><i class="fa fa-home"></i>&nbsp; {{ trans('word.users') }}</a></li>--}}
                    @endif
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="/admin/book"><i class="fa fa-book fa-aw"></i>&nbsp; {{ trans('word.books') }} <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @if(Session::get('role.admin'))
                                <li><a href="{{ route('app.admin.book.index') }}"><i class="fa fa-pencil fa-fw"></i>&nbsp;{{ trans('word.all-book-poem') }}</a></li>
                                <li><a href="{{ route('app.admin.book.create') }}"><i class="fa fa-pencil fa-fw"></i>&nbsp;{{ trans('word.create-book') }} || {{ trans('word.poem') }}</a></li>
                            @elseif(Session::get('role.editor'))
                                <li><a href="{{ route('app.editor.book.index') }}"><i class="fa fa-pencil fa-fw"></i>&nbsp;{{ trans('word.all-book-poem') }}</a></li>
                                <li><a href="{{ route('app.editor.book.create') }}"><i class="fa fa-pencil fa-fw"></i>&nbsp;{{ trans('word.create-book') }} || {{ trans('word.poem') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    @if(Session::get('role.admin'))
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-folder-open-o fa-aw"></i>&nbsp;{{ trans('word.categories') }} <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('Admin\AdminCategoryController@index') }}"><i class="fa fa-indent fa-fw"></i>&nbsp;{{ trans('word.categories') }}</a></li>
                            <li><a href="{{ action('Admin\AdminCategoryController@create') }}"><i class="fa fa-indent fa-fw"></i>&nbsp;{{ trans('word.create-category') }}</a></li>
                        </ul>
                    <li><a href="{{ action('Admin\AdminContactUsController@edit') }}"><i class="fa fa-indent fa-fw"></i>&nbsp;{{ trans('word.contact-us') }}</a></li>
                    </li>
                    @endif


                </ul>
            </div>
        </nav>
        <!-- END CONTENT ITEM -->

    </div>
</div>
<div class="row hidden-print">
    <div class="col-xs-12">
        <!-- START CONTENT ITEM -->
        <nav class="navbar navbar-right header-nav" role="navigation">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user() ? trans('word.account') : trans('word.login')}}</a>
                    <ul class="dropdown-menu">
                        <li>
                            @if(Auth::user())
                                <div class="dropdown-content col-md-4 col-lg-3">
                                    <a href="/profile/{{Auth::id()}}" class="btn btn-primary col-lg-12"><i class="fa fa-user fa-aw"></i>&nbsp;{{ trans('word.profile') }}</a>
                                        <a href="/admin" class="btn btn-primary col-lg-12"><i class="fa fa-user fa-aw"></i>&nbsp;{{ trans('word.admin-panel') }}</a>

                                    <a href="/auth/logout" class="btn btn-danger col-lg-12"><i class="fa fa-sign-out fa-aw"></i>&nbsp;{{ trans('word.logout') }}</a>
                                </div>
                            @else
                                <div class="dropdown-content col-md-4 col-lg-3">
                                    {!! Form::open(['url' => '/auth/login', 'method' => 'post']) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                        {!! Form::text('email', null , ['class' => 'form-control','placeholder'=>trans('word.email')]) !!}
                                    </div>
                                    <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                        {!! Form::password('password', ['class' => 'form-control','placeholder'=>trans('word.password')]) !!}
                                    </div>
                                    {!! Form::submit(trans('word.login'), ['class' => 'form-control btn btn-primary']) !!}

                                    <a class="col-md-12 btn btn-danger" href="/auth/register">{{ trans('word.register') }}</a>


                                    {!! Form::close() !!}

                                </div>
                            @endif
                        </li>
                    </ul>
                </li>
                @if(App::getLocale() === 'en')
                    <li><a href="{{ action('LanguageController@changeLocale',['lang'=>'ar'])}}">العربية</a></li>
                @else
                    <li><a href="{{ action('LanguageController@changeLocale',['lang'=>'en'])}}">En</a></li>
                @endif
            </ul>
        </nav>
        <!-- END CONTENT ITEM -->

    </div>
</div>
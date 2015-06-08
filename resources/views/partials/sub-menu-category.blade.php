<div class="col-xs-12 col-sm-3">

    <br>

    <!-- Category Sub Menu -->
    <div class="row">
        <div class="col-xs-12">
            <div class="well well-small">
                <ul class="nav nav-list">
                    <li class="nav-header">Books</li>
                    @foreach($categories as $category)
                        <li class="active"><a href="{{ action('CategoryController@show',$category->id) }}"><i class="fa fa-fw fa-book"></i> {{ $category->__get('name') }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- END CONTENT ITEM -->



</div>
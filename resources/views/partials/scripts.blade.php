{{--<script src="/js/config.js"></script>
      <script src="/bower_components/modernizr/modernizr.js"></script>--}}

<!-- jQuery -->
{{--<script src="/bower_components/jquery/dist/jquery.min.js"></script>--}}

<!-- Bootstrap Core JavaScript -->
{{--<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}

<script src="/js/app.js"></script>
{{--
        <script src="/bower_components/nivoslider/jquery.nivo.slider.pack.js"></script>
        <script src="/bower_components/colorbox/jquery.colorbox-min.js"></script>
        <script src="/bower_components/respond/dest/respond.min.js"></script>
        <script src="/js/script.js"></script>--}}
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'ebookapp';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());

    $('.nav-tabs > li[id^="tab-"]').on('click', function () {
        var idVal = $(this).attr('id');
        var tabLink = idVal.split('-');
        var tabLink = 'step'+tabLink[1];
        $.cookie("tabLastSelected", idVal);
        $.cookie('TabHrefLastSelected',tabLink);
        console.log('Clicked : ' + idVal);
    });

    if($.cookie('tabLastSelected')) {
        var idVal = $.cookie('tabLastSelected');
        var tabLink = $.cookie('TabHrefLastSelected');
        console.log('From Inside If Statement : ' + idVal);
        $('#'+idVal+'> a').trigger('click');
    }

</script>
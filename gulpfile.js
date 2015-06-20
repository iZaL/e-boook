var elixir = require('laravel-elixir');

elixir(function (mix)
{
 /*mix
  // sass files in assets
     .copy('public/bower_components/bootstrap-sass/assets', 'resources/assets/sass/bootstrap')
  // css files in the public
     .copy('public/bower_components/bootstrap-timepicker/css/bootstrap-timepicker.min.css','public/css/bootstrap-timepicker.min.css')
  // js files
     .copy('public/bower_components/jquery/dist/jquery.js', 'resources/assets/sass/bootstrap/javascripts/jquery.js')
    // .copy('vendor/bower_components/bootstrap-sass/assets/javascripts', 'resources/assets/sass/vendor/bootstrap/javascripts')
  //.copy('vendor/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.min.js','resources/assets/sass/vendor/bootstrap/javascripts/bootstrap-timepicker.min.js')
  // fonts
     //.copy('vendor/bower_components/bootstrap-sass/assets/fonts*//*', 'public/css/fonts')
  // ... and so on
 ;*/
 mix.sass([
  'app.scss' // this is file where I @import all vendor styles and my own styles
 ]);

 mix.styles([
  "../bower_components/nivoslider/nivo-slider.css",
  "../bower_components/colorbox/example1/colorbox.css",
  "../bower_components/nivoslider/themes/bar/bar.css",
  "../bower_components/nivoslider/themes/light/light.css",
  "../bower_components/fontawesome/css/font-awesome.min.css",
  "style.css",
  "admin.css",
  "sb-admin-2.css",
  "custom.css",
 ], 'public/css/everything.css');

 mix.scripts([
   'bower_components/jquery/dist/jquery.min.js',
   'sass/bootstrap/javascripts/bootstrap.min.js',
   "bower_components/modernizr/modernizr.js",
    'bower_components/nivoslider/jquery.nivo.slider.pack.js',
    'bower_components/colorbox/jquery.colorbox-min.js',
    'bower_components/respond/dest/respond.min.js',
    'js/script.js',
    'js/sb-admin-2.js',
    'js/config.js'
 ], 'public/js/app.js','resources/assets/','./');
 mix.version([
  'public/css/app.css',
  'public/js/app.js'
 ]);
});


/*
* 1- elixir(function (mix){
* mix.sass(["name of the file within the resources/assets/ then create a folder sass if you will use sass or create less folder"]);
* mix.scripts([list of files that will be cloned in the public/js],'path to the file in public','base path for cloned files','./');
* mix.version(['public/css/app.css','public/js/app.js']);
* });
*
* 2- within the app.sass you will import all files needed
* @import url (whatever)
* */
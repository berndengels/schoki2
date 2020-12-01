const mix = require('laravel-mix');
/*
mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/admin.js', 'public/js')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .copy('resources/css/app.css', 'public/css');
*/
mix
    .js('resources/js/app.js', 'public/js')
    .js(['resources/js/admin/admin.js'], 'public/js')
//    .postCss('resources/css/app.css', 'public/css', [])
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
;

if (mix.inProduction()) {
    mix.version();
}

const mix = require('laravel-mix');
mix.webpackConfig({
    target: 'node',
    resolve: {
        alias: {
            jquery: "jquery/src/jquery"
        }
    },
    externals: {
        canvas: "commonjs canvas" // Important (2)
    }
});

mix.autoload({
        'jquery': ['jQuery', '$']
    })
    .js('resources/js/app.js', 'public/js')
    .js(['resources/js/admin/admin.js'], 'public/js')
    .sass('resources/sass/admin/admin.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/red.scss', 'css/red.css')
    .sass('resources/sass/dark.scss', 'css/dark.css')
    .copy('resources/vendor/calendar/zabuto_calendar.min.css', 'public/vendor/calendar/css')
    .copy('resources/vendor/calendar/zabuto_calendar.min.js', 'public/vendor/calendar/js')
    .copy('node_modules/jstree/dist/jstree.min.js', 'public/vendor/jstree/js')
    .copy('node_modules/jstree/dist/themes', 'public/vendor/jstree/css')
    .copy('node_modules/leaflet/dist', 'public/vendor/leaflet')
//    .postCss('resources/css/app.css', 'public/css', [])
;

if (mix.inProduction()) {
    mix.version();
}

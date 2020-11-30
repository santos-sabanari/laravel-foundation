const mix = require('laravel-mix');

mix.setPublicPath('public');
mix.setResourceRoot('../');

/* CSS */
mix.sass('resources/assets/sass/app.scss', 'public/css/app.css');
mix.sass('resources/assets/sass/coreui.scss', 'public/css/coreui.css');

/* JS */
mix.js('resources/assets/js/app.js', 'public/js/app.js');
mix.js('resources/assets/js/coreui.js', 'public/js/coreui.js');

mix.sourceMaps();

mix.version();
// if (mix.inProduction()) {
//     mix.version();
// } else {
//     // Uses inline source-maps on development
//     mix.webpackConfig({
//         devtool: 'inline-source-map'
//     });
// }

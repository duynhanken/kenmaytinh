import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
            'public/css/sb-admin-2.min.css',
            //datatables
            'public/css/datatables.css',

            'public/vendor/fontawesome-free/css/all.min.css',
            //js
            'public/vendor/jquery/jquery.min.js',
            'public/vendor/bootstrap/js/bootstrap.bundle.min.js',
            'public/vendor/jquery-easing/jquery.easing.min.js',
            'public/js/sb-admin-2.min.js',
            'public/vendor/chart.js/Chart.min.js',
            'public/js/demo/chart-area-demo.js',
            'public/js/demo/chart-pie-demo.js',


            //client
            'public/client/assets/css/style-starter.css',
            // 'public/client/assets/js/jquery-3.3.1.min.js',
            // 'public/client/assets/js/jquery-2.1.4.min.js',
            'public/client/assets/js/minicart.js',
            'public/client/assets/js/jquery.magnific-popup.js',
            'public/client/assets/js/bootstrap.min.js',


            //layout cart
            'public/layout/assets/css/main.css',
            'public/layout/assets/css/custom.css',
            'public/layout/assets/js/vendor/modernizr-3.6.0.min.js',
            'public/layout/assets/js/vendor/jquery-3.6.0.min.js',
            'public/layout/assets/js/vendor/jquery-migrate-3.3.0.min.js',
            'public/layout/assets/js/vendor/bootstrap.bundle.min.js',
            'public/layout/assets/js/plugins/slick.js',
            'public/layout/assets/js/plugins/jquery.syotimer.min.js',
            'public/layout/assets/js/plugins/wow.js',
            'public/layout/assets/js/plugins/jquery-ui.js',
            'public/layout/assets/js/plugins/perfect-scrollbar.js',
            'public/layout/assets/js/plugins/magnific-popup.js',
            'public/layout/assets/js/plugins/select2.min.js',
            'public/layout/assets/js/plugins/waypoints.js',
            'public/layout/assets/js/plugins/counterup.js',
            'public/layout/assets/js/plugins/jquery.countdown.min.js',
            'public/layout/assets/js/plugins/images-loaded.js',
            'public/layout/assets/js/plugins/isotope.js',
            'public/layout/assets/js/plugins/scrollup.js',
            'public/layout/assets/js/plugins/jquery.vticker-min.js',
            'public/layout/assets/js/plugins/jquery.theia.sticky.js',
            'public/layout/assets/js/plugins/jquery.elevatezoom.js',

            'public/layout/assets/js/main.js?v=3.3',
            'public/layout/assets/js/shop.js?v=3.3',


            //ckeditor
            'public/build/ckeditor.js',

            //slider
            'public/layout/slider/jqr_css.css',
            'public/layout/slider/jqr_js.js',
            'public/layout/slider/jqr_ver.js',

            'public/layout/assets/js/moneyformat',

        ],
            refresh: true,
        }),
    ],
});

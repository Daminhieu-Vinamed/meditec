const mix = require('laravel-mix');
mix.js('resources/js/login.js', 'public/dist/js/')
mix.js('resources/js/production-order-v1.js', 'public/dist/js/')
mix.js('resources/js/production-order-v2.js', 'public/dist/js/')
mix.js('resources/js/approval-vote.js', 'public/dist/js/')
mix.js('resources/js/approval-vote-detail.js', 'public/dist/js/')
mix.js('resources/js/additional-production-order-v2.js', 'public/dist/js/')
mix.js('resources/js/scan-qr-code.js', 'public/dist/js/')
.setPublicPath('public');
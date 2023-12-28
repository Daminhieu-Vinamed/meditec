const mix = require('laravel-mix');
mix.js('resources/js/login.js', 'public/dist/js/')
mix.js('resources/js/production-order.js', 'public/dist/js/')
mix.js('resources/js/approval-vote.js', 'public/dist/js/')
mix.js('resources/js/approval-vote-detail.js', 'public/dist/js/')
mix.js('resources/js/get-time-by-shift.js', 'public/dist/js/')
.setPublicPath('public');
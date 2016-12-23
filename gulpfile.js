const elixir = require('laravel-elixir');

require('laravel-elixir-webpack-react');

elixir(mix => {
    mix
       .webpack('app.js');
});

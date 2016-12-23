<?php

namespace App\Providers;

use App\Article;
use App\Tag;
use App\Comment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        View::composer('partials.nav', function ($view) {
//            $view
//                ->with('last_comment', Comment::latest()->first())
//                ->with('count_posts', Article::get()->count())
//                ->with('count_tags', Tag::get()->count())
//                ->with('count_comments', Comment::all()->count());
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

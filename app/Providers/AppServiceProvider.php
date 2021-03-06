<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Topic;
use App\Models\Reply;
use App\observers\TopicObserver;
use App\observers\ReplyObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Illuminate\Pagination\Paginator::useBootstrap();


        Topic::observe(TopicObserver::class);
        Reply::observe(ReplyObserver::class);
    }
}

<?php

namespace App\Providers;

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
        //

        //侧边栏数据 后期添加
        view()->composer('posts._sidebar', function ($view) {
            $view->with('archives', []);
        });
        \DB::listen(function($query) {
            $tmp = str_replace('?', '"'.'%s'.'"', $query->sql);
            $tmp = vsprintf($tmp, $query->bindings);
            $tmp = str_replace("\\","",$tmp);
            \Log::info(' execution time: '.$query->time.'ms; '.$tmp."\n\n\t");

        });
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

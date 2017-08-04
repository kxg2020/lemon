<?php

namespace App\Providers;

use App\Model\Category;
use App\Model\Tag;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        view()->share('categorys', Category::select('id', 'cat_name')->where('is_nav', 1)->orderBy('cat_desc', 'desc')->get()->toArray());
        view()->share('tags', Tag::select('id', 'tag_name')->orderBy('click', 'desc')->get()->toArray());
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

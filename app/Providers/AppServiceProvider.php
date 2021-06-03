<?php

    namespace App\Providers;

    use App\Http\ViewComposers\SettingsComposer;
    use App\Models\Banner;
    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Post;
    use App\Models\PostCategory;
    use App\Observers\BannerObserver;
    use App\Observers\BrandObserver;
    use App\Observers\CategoryObserver;
    use App\Observers\PostObserver;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

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
            Schema::defaultStringLength(191);
            Banner::observe(BannerObserver::class);
            Brand::observe(BrandObserver::class);
            Category::observe(CategoryObserver::class);
            PostCategory::observe(PostObserver::class);
            Post::observe(PostObserver::class);
            View::composer(['frontend.layouts.header', 'frontend.layouts.footer'], SettingsComposer::class);
        }
    }

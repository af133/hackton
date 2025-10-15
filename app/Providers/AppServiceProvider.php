<?php

namespace App\Providers;

use App\Events\CoursePurchased;
use App\Listeners\AwardAchievementsListener;
use App\Services\AchievementService;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Cloudinary', \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::class);

        // jika perlu, register service provider
        $this->app->register(\CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            CoursePurchased::class,
            AwardAchievementsListener::class
        );
    }
}

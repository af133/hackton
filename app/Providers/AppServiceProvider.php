<?php

namespace App\Providers;

use Midtrans\Config;
use App\Events\CoursePurchased;
use Illuminate\Support\Facades\URL;
use App\Services\AchievementService;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Listeners\AwardAchievementsListener;

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
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
    }
    }
}

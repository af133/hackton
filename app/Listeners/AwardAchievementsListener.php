<?php

namespace App\Listeners;

use App\Events\CoursePurchased;
use App\Services\AchievementService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardAchievementsListener
{
    /**
     * Create the event listener.
     */
    protected AchievementService $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function handle(CoursePurchased $event): void
    {
        // Panggil service untuk mengecek semua lencana yang relevan
        $this->achievementService->checkAndAward($event->user);
    }
}

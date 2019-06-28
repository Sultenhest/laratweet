<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Achievements\FirstThousandPoints;
use App\Achievements\LaratweetMastery;

class AchievementsServiceProvider extends ServiceProvider
{
    protected $achievements = [
        FirstThousandPoints::class,
        LaratweetMastery::class
    ];

    public function boot()
    {
        \Event::listen(\Event\UserEarnedExperience::class, \Listeners\AwardAchievements::class);
    }

    public function register()
    {
        $this->app->singleton('achievements', function () {
            return collect($this->achievements)->map(function ($achievement) {
                return new $achievement;
            });
        });
    }
}

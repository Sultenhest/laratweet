<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Achievements\FirstThousandPoints;
use App\Achievements\LaratweetMastery;
use App\Achievements\FirstTenLikes;
use App\Achievements\PopularMessage;

use App\Events\UserEarnedExperience;
use App\Listeners\AwardAchievements;

class AchievementsServiceProvider extends ServiceProvider
{
    protected $achievements = [
        FirstThousandPoints::class,
        LaratweetMastery::class,
        FirstTenLikes::class,
        PopularMessage::class
    ];

    public function boot()
    {
        \Event::listen(UserEarnedExperience::class, AwardAchievements::class);
    }

    public function register()
    {
        $this->app->singleton('achievements', function () {
            //return cache()->rememberForever('achievements', function() {
                return collect($this->achievements)->map(function ($achievement) {
                    return new $achievement;
                });
            //});
        });
    }
}

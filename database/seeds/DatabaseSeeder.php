<?php

use App\User;
use App\Status;
use App\Profile;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->statuses()->save(factory(App\Status::class)->make());
        });
    }
}

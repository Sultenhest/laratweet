<?php

use App\Tag;
use App\User;
use App\Status;

use Faker\Factory as Faker;

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
        $faker = Faker::create();

        $tags = factory(App\Tag::class, 50)->create();

        $users = factory(App\User::class, 150)->create();

        foreach($users as $user) {
            $user->experience()->create([
                'points' => 0
            ]);

            $random = rand(25, 50);

            factory(App\Status::class, $random)->create(['user_id' => $user->id])->each(function ($status, $tags) {
                $random = array();
                for ($i = 0; $i <= rand(1, 10); $i++) {
                    $random[$i] = rand(1, 50);
                }
                $status->tags()->sync($random);
            });

            for ($i = 0; $i <= rand(25, 75); $i++) {
                $id = rand(0,149);

                if( $user->id != $id ) {
                    $user->addFollower( $users[$id] );
                }
            }
        }
    }
}

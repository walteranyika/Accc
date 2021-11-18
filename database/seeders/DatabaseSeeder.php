<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Faker\Factory;
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
        $faker = Factory::create();
        $userA = User::create(['name' => $faker->firstName, 'email' => $faker->email, 'password' => bcrypt('P@55W)rd1')]);
        $userB = User::create(['name' => $faker->firstName, 'email' => $faker->email, 'password' => bcrypt('P@55W)rd2')]);
        $userC = User::create(['name' => $faker->firstName, 'email' => $faker->email, 'password' => bcrypt('P@55W)rd3')]);

        $webA = Website::create(['name' => 'Website A', 'url' => 'https://website-a.com']);
        $webB = Website::create(['name' => 'Website B', 'url' => 'https://website-b.com']);
        $webC = Website::create(['name' => 'Website C', 'url' => 'https://website-c.com']);

        Subscription::create(['user_id' => $userA->id, 'website_id' => $webA->id]);
        Subscription::create(['user_id' => $userB->id, 'website_id' => $webB->id]);
        Subscription::create(['user_id' => $userC->id, 'website_id' => $webC->id]);
        Subscription::create(['user_id' => $userA->id, 'website_id' => $webB->id]);

        Post::create(['title' => $faker->sentence(6), 'body' => $faker->sentence(50), 'website_id' => $webA->id]);
        Post::create(['title' => $faker->sentence(6), 'body' => $faker->sentence(85), 'website_id' => $webA->id]);
        Post::create(['title' => $faker->sentence(6), 'body' => $faker->sentence(95), 'website_id' => $webA->id]);
        Post::create(['title' => $faker->sentence(6), 'body' => $faker->sentence(77), 'website_id' => $webA->id]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupPost;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'bartek_kilan@interia.pl',
            'username' => 'bartek-kilan',
            'first_name' => 'Bartosz',
            'second_name' => '',
            'last_name' => 'Kilan',
            'birth_date' => '1922-01-28',
            'password' => Hash::make('bartek123')
        ]);



        User::create([
            'email' => 'jannowak@interia.pl',
            'username' => 'nowakjan',
            'first_name' => 'Jan',
            'second_name' => '',
            'last_name' => 'Nowak',
            'birth_date' => '1926-01-28',
            'password' => Hash::make('bartek123')
        ]);

        User::factory()->count(40)->create();
        Post::factory()->count(150)->create();
        Comment::factory()->count(500)->create();
        Group::factory()->count(10)->create();
        for($i = 0; $i < 100; $i++) {
            GroupMember::updateOrCreate(['user_id' => rand(1, 42), 'group_id' => rand(1, 10)]);
            GroupPost::updateOrCreate(['post_id' => rand(1, 150), 'group_id' => rand(1, 10)]);
            Like::updateOrCreate(['post_id' => rand(1, 150), 'user_id' => rand(1, 42)]);

        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
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
    }
}

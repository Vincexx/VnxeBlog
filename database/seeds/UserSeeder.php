<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        if(!$user) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'api_token' => Str::random(80),
                'role' => 'admin',
            ]);

            Profile::create([
                'user_id' => 1,
                'bio' => 'Bio',
                'work' => 'Work',
                'place_of_work' => 'Place of Work'
            ]);
        }
    }
}

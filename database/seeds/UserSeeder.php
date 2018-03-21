<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Brent',
            'email' => 'brendt@stitcher.io',
            'password' => bcrypt('secret'),
        ]);
    }
}

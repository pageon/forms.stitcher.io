<?php

use App\Form;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run()
    {
        Form::query()->truncate();

        $faker = Factory::create();

        $user = User::firstOrFail();

        foreach (range(1, 10) as $i) {
            Form::create([
                'user_id' => $user->id,
                'data' => [
                    'naam' => $faker->name,
                    'email' => $faker->email,
                    'aantal' => $faker->numberBetween(1, 5),
                ]
            ]);
        }
    }
}

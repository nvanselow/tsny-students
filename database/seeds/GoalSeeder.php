<?php

use Illuminate\Database\Seeder;
use Tsny\Models\Goal;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goal::truncate();

        $faker = \Faker\Factory::create();

        Goal::create([
            'student_id' => 1,
            'user_id' => 1,
            'description' => $faker->sentence(),
            'complete' => true
        ]);

        Goal::create([
            'student_id' => 1,
            'user_id' => 2,
            'description' => $faker->sentence()
        ]);

        Goal::create([
            'student_id' => 1,
            'description' => $faker->sentence()
        ]);

        Goal::create([
            'student_id' => 2,
            'user_id' => 3,
            'description' => $faker->sentence()
        ]);

        Goal::create([
            'student_id' => 3,
            'description' => $faker->sentence()
        ]);
    }
}

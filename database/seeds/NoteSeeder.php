<?php

use Illuminate\Database\Seeder;
use Tsny\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::truncate();

        $faker = \Faker\Factory::create();

        Note::create([
            'student_id' => 1,
            'note' => $faker->sentence()
        ]);

        Note::create([
            'student_id' => 1,
            'user_id' => rand(1,4),
            'note' => $faker->sentence()
        ]);

        Note::create([
            'student_id' => 1,
            'user_id' => rand(1,4),
            'note' => $faker->sentence()
        ]);

        Note::create([
            'student_id' => 1,
            'user_id' => rand(1,4),
            'note' => $faker->sentence()
        ]);

        Note::create([
            'student_id' => 2,
            'user_id' => rand(1,4),
            'note' => $faker->sentence()
        ]);

        Note::create([
            'student_id' => 2,
            'user_id' => rand(1,4),
            'note' => $faker->sentence()
        ]);

        Note::create([
            'student_id' => 3,
            'user_id' => rand(1,4),
            'note' => $faker->sentence()
        ]);

    }
}

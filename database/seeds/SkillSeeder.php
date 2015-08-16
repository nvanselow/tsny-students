<?php

use Illuminate\Database\Seeder;
use Tsny\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::truncate();

        $faker = Faker\Factory::create();

        Skill::create([
            'student_id' => 1,
            'user_id' => rand(1, 4),
            'name' => $faker->word,
            'proficiency' => rand(0,3),
            'current' => true,
            'note' => $faker->sentence(3)
        ]);

        Skill::create([
            'student_id' => 1,
            'user_id' => rand(1, 4),
            'name' => $faker->word,
            'proficiency' => rand(0,3),
            'current' => false,
            'note' => $faker->sentence(3)
        ]);

        Skill::create([
            'student_id' => 2,
            'user_id' => rand(1, 4),
            'name' => $faker->word,
            'proficiency' => rand(0,3),
            'current' => $faker->boolean(20),
            'note' => $faker->sentence(3)
        ]);

        Skill::create([
            'student_id' => 2,
            'user_id' => rand(1, 4),
            'name' => $faker->word,
            'proficiency' => rand(0,3),
            'current' => $faker->boolean(20),
            'note' => $faker->sentence(3)
        ]);

        Skill::create([
            'student_id' => 3,
            'user_id' => rand(1, 4),
            'name' => $faker->word,
            'proficiency' => rand(0,3),
            'current' => $faker->boolean(20),
            'note' => $faker->sentence(3)
        ]);

        Skill::create([
            'student_id' => 4,
            'user_id' => rand(1, 4),
            'name' => $faker->word,
            'proficiency' => rand(0,3),
            'current' => $faker->boolean(20),
            'note' => $faker->sentence(3)
        ]);
    }
}

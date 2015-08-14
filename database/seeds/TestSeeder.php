<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(SchoolTableSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(GoalSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(NoteSeeder::class);

        Model::reguard();
    }
}

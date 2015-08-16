<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserSeeder::class);
        $this->call(SchoolTableSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(GoalSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(NoteSeeder::class);
        $this->call(SchoolStudentSeeder::class);


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Model::reguard();
    }
}

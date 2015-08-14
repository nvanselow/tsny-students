<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Tsny\Models\Student::truncate();

        factory(\Tsny\Models\Student::class, 20)->create();
    }
}

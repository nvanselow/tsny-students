<?php

use Illuminate\Database\Seeder;
use Tsny\Models\School;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::truncate();

        School::create([
            'name' => 'Boston',
        ]);

        School::create([
            'name' => 'Chicago',
        ]);


        School::create([
            'name' => 'NYC',
        ]);

        School::create([
            'name' => 'DC',
        ]);

        School::create([
            'name' => 'Los Angeles',
        ]);
    }
}

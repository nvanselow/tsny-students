<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tsny\Models\Student;

class SchoolsTest extends TestCase {

    use DatabaseTransactions;

    public function testViewSchools(){

        $this->get('/api/schools')
            ->seeJson(
                ['name' => 'Boston']
            )
            ->dontSee('Honolulu');
    }

    public function testGetStudentsAtSchool(){

        $faker = \Faker\Factory::create();

        $boston = Student::create([
            'first_name' => 'BostonStudent',
            'last_name' => 'BostonStudent',
            'nickname' => 'BostonStudent',
            'email' => $faker->email,
            'primary_school' => 2,
        ]);

        $boston->addSchool(1);
        $boston->addSchool(2);

        $chicago = Student::create([
            'first_name' => 'ChicagoStudent',
            'last_name' => 'ChicagoStudent',
            'nickname' => 'ChicagoStudent',
            'email' => $faker->email,
            'primary_school' => 2,
        ]);

        $chicago->addSchool(2);

        $nyc = Student::create([
            'first_name' => 'NYCStudent',
            'last_name' => 'NYCStudent',
            'nickname' => 'NYCStudent',
            'email' => $faker->email,
            'primary_school' => 1,
        ]);

        $nyc->addSchool(3);

        $la = Student::create([
            'first_name' => 'LAStudent',
            'last_name' => 'LAStudent',
            'nickname' => 'LAStudent',
            'email' => $faker->email,
            'primary_school' => 1,
        ]);

        $la->addSchool(4);

        $dc = Student::create([
            'first_name' => 'DCStudent',
            'last_name' => 'DCStudent',
            'nickname' => 'DCStudent',
            'email' => $faker->email,
            'primary_school' => 1,
        ]);

        $dc->addSchool(5);

        $this->get('/api/schools/1/students')
            ->see('BostonStudent')
            ->dontSee('ChicagoStudent')
            ->dontSee('NYCStudent')
            ->dontSee('LAStudent')
            ->dontSee('DCStudent')
            ->see('"id":"'. $boston->id .'"');

    }

    public function testGetStudentsWithSummaries(){
        $this->get('/api/schools/1/students/summaries');
    }

}
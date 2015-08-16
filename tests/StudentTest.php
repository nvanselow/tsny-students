<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tsny\Models\Student;

class StudentTest extends TestCase {

    use DatabaseTransactions;

    public function testAddSchool(){

        $boston = Student::create([
            'first_name' => 'BostonStudent',
            'last_name' => 'BostonStudent',
            'nickname' => 'BostonStudent',
            'email' => 'bostonstudent@tsny.com',
            'primary_school' => 2,
        ]);

        $boston->addSchool(1);

        $this->seeInDatabase('school_student', [
            'student_id' => $boston->id,
            'school_id' => 1
        ]);
    }




}
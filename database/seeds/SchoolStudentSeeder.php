<?php

use Illuminate\Database\Seeder;
use Tsny\Models\Student;

class SchoolStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = Student::find(1);
        $student->addSchool(1);
        $student->addSchool(2);
        $student->addSchool(3);

        $student = Student::find(2);
        $student->addSchool(1);
        $student->addSchool(2);
        $student->addSchool(3);

        $student = Student::find(3);
        $student->addSchool(1);

        $student = Student::find(4);
        $student->addSchool(1);

        $student = Student::find(5);
        $student->addSchool(1);

        $student = Student::find(6);
        $student->addSchool(1);

        $student = Student::find(7);
        $student->addSchool(1);

        $student = Student::find(8);
        $student->addSchool(1);

        $student = Student::find(9);
        $student->addSchool(2);

        $student = Student::find(10);
        $student->addSchool(2);

        $student = Student::find(11);
        $student->addSchool(3);

        $student = Student::find(12);
        $student->addSchool(4);

        $student = Student::find(13);
        $student->addSchool(4);

        $student = Student::find(14);
        $student->addSchool(4);

        $student = Student::find(15);
        $student->addSchool(4);
    }
}

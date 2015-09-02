<?php

namespace Tsny\Models;

use Illuminate\Database\Eloquent\Model;
use Tsny\CustomObjects\StudentSummary;

class School extends Model
{
    public function students(){
        return \DB::table('school_student')->where('school_student.school_id', $this->id)
            ->join('schools', 'schools.id', '=', 'school_student.school_id')
            ->join('students', 'students.id', '=', 'school_student.student_id')
            ->select([
                'students.id',
                'schools.id AS school_id',
                'students.first_name',
                'students.last_name',
                'students.email',
                'students.nickname',
                'students.primary_school'
            ])
            ->orderBy('students.last_name')
            ->get();
    }

    public function studentsWithSummary(){
        $students = $this->students();

        return array_map(function($student){
            $student->summary = new StudentSummary($student->id);

            return $student;
        }, $students);
    }
}

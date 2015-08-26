<?php

namespace Tsny\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Response;
use Tsny\Http\Requests;
use Tsny\Http\Controllers\Controller;
use Tsny\Models\Student;

class StudentController extends Controller
{
    public function find($student_id){
        $student = Student::find($student_id);
        return Response::json(['student' => $student->toArray(), 'details' => $student->getDetails()]);
    }

    public function search($search_text){
        $students = Student::where('first_name', 'LIKE', '%'.$search_text.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search_text.'%')
            ->orWhere('nickname', 'LIKE', '%'.$search_text.'%')
            ->join('schools', 'schools.id', '=', 'students.primary_school')
            ->select([
                'students.id',
                'first_name',
                'last_name',
                'nickname',
                'schools.name AS primary_school_name'
            ])
            ->get();

        return Response::json($students);
    }

    public function create(){
        $student = Input::get('student', ['schools' => []]);

        $new_student = Student::create(array_except($student, 'schools'));

        foreach($student['schools'] as $school){
            $new_student->addSchool($school);
        }

        return Response::json(['message' => 'Student added!']);
    }

    public function addNote($student_id){
        $student = Student::find($student_id);

        if(!$student){
            return Response::json(['message' => 'Could not find student'], 400);
        }

        $note = $student->addNote(Input::get('note'));

        return Response::json(['note' => $note]);
    }

    public function addGoal($student_id){
        $student = Student::find($student_id);
        if(!$student){
            return Response::json(['message' => 'Could not find student'], 400);
        }

        $goal = $student->addGoal(Input::get('goal'));

        return Response::json(['goal' => $goal]);
    }

    public function addSkill($student_id){
        $student = Student::find($student_id);
        if(!$student){
            return Response::json(['message' => 'Could not find student'], 400);
        }

        $skill = $student->addSkill(Input::get('skill'));

        return Response::json(['skill' => $skill]);
    }

}

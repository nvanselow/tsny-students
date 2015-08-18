<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'api'], function(){

    Route::get('schools', function(){
        return Response::json(\Tsny\Models\School::all(['id','name']));
    });

    Route::get('schools/{school_id}/students', function($school_id){
        return Response::json(\Tsny\Models\School::find($school_id)->students());
    });

    Route::get('schools/{school_id}/students/summaries', function($school_id){
        return Response::json(\Tsny\Models\School::find($school_id)->studentsWithSummary());
    });

    Route::get('student/{student_id}', function($student_id){

        $student = \Tsny\Models\Student::find($student_id);

        return Response::json(['student' => $student->toArray(), 'details' => $student->getDetails()]);

    });

    Route::post('student', function(){
        $student = Input::get('student', ['schools' => []]);

        $new_student = \Tsny\Models\Student::create(array_except($student, 'schools'));

        foreach($student['schools'] as $school){
            $new_student->addSchool($school);
        }

        return Response::json(['message' => 'Student added!']);
    });

    Route::post('student/{student_id}/note', function($student_id){

        $student = \Tsny\Models\Student::find($student_id);

        if(!$student){
            return Response::json(['message' => 'Could not find student'], 400);
        }

        $note = $student->addNote(Input::get('note'));

        return Response::json(['note' => $note]);
    });

    Route::post('student/{student_id}/goal', function($student_id){

        $student = \Tsny\Models\Student::find($student_id);
        if(!$student){
            return Response::json(['message' => 'Could not find student'], 400);
        }

        $goal = $student->addGoal(Input::get('goal'));

        return Response::json(['goal' => $goal]);

    });

    Route::post('student/{student_id}/skill', function($student_id){
        $student = \Tsny\Models\Student::find($student_id);
        if(!$student){
            return Response::json(['message' => 'Could not find student'], 400);
        }

        $skill = $student->addSkill(Input::get('skill'));

        return Response::json(['skill' => $skill]);
    });


});

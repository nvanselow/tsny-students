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

    Route::post('student', function(){
        $student = Input::get('student', ['schools' => []]);

        $new_student = \Tsny\Models\Student::create(array_except($student, 'schools'));

        foreach($student['schools'] as $school){
            $new_student->addSchool($school);
        }

        return Response::json(['message' => 'Student added!']);
    });

});

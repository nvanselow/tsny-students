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

Route::get('/home', function(){
    return View('home');
});

Route::get('/', function () {
    return view('home');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['middleware' => 'registration_code', 'uses' => 'Auth\AuthController@postRegister']);

//Reset password
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function(){

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

    Route::post('goal/{goal_id}/toggle', function($goal_id){
        $goal = \Tsny\Models\Goal::where('id', $goal_id)->select('id', 'complete')->first();

        $goal->complete = !$goal->complete;

        if($goal->save()){
            return Response::json($goal);
        } else {
            return Response::json(['message' => 'There was a problem updating the goal.'], 400);
        }
    });

    Route::post('skill/{skill_id}/toggle', function($skill_id){
        $skill = \Tsny\Models\Skill::where('id', $skill_id)->select('id', 'current')->first();

        $skill->current = !$skill->current;

        if($skill->save()){
            return Response::json($skill);
        }

        return Response::json(['message' => 'There was a problem updating the skill.'], 400);
    });

    Route::get('student/search/{search_text}', function($search_text){
        $students = \Tsny\Models\Student::where('first_name', 'LIKE', '%'.$search_text.'%')
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

    });

});

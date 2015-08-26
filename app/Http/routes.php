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

    Route::get('schools', 'SchoolController@all');
    Route::get('schools/{school_id}/students', 'SchoolController@students');
    Route::get('schools/{school_id}/students/summaries', 'SchoolController@studentsWithSummaries');

    Route::get('student/{student_id}', 'StudentController@find');
    Route::get('student/search/{search_text}', 'StudentController@search');
    Route::post('student', 'StudentController@create');
    Route::post('student/{student_id}/note', 'StudentController@addNote');
    Route::post('student/{student_id}/goal', 'StudentController@addGoal');
    Route::post('student/{student_id}/skill', 'StudentController@addSkill');

    Route::post('goal/{goal_id}/toggle', 'GoalController@toggle');

    Route::post('skill/{skill_id}/toggle', 'SkillController@toggle');
});

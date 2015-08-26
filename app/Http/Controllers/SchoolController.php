<?php

namespace Tsny\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use Tsny\Http\Requests;
use Tsny\Http\Controllers\Controller;

class SchoolController extends Controller
{
    public function all(){
        return Response::json(\Tsny\Models\School::all(['id','name']));
    }

    public function students($school_id){
        return Response::json(\Tsny\Models\School::find($school_id)->students());
    }

    public function studentsWithSummaries($school_id){
        return Response::json(\Tsny\Models\School::find($school_id)->studentsWithSummary());
    }
}

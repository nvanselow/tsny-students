<?php

namespace Tsny\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use Tsny\Http\Requests;
use Tsny\Http\Controllers\Controller;
use Tsny\Models\Goal;

class GoalController extends Controller
{
    public function toggle($goal_id){
        $goal = Goal::where('id', $goal_id)->select('id', 'complete')->first();

        $goal->complete = !$goal->complete;

        return $goal->save() ? Response::json($goal) : Response::json(['message' => 'There was a problem updating the goal.'], 400);
    }
}

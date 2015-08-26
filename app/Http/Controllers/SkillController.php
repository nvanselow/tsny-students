<?php

namespace Tsny\Http\Controllers;

use Illuminate\Http\Request;

use Response;
use Tsny\Http\Requests;
use Tsny\Http\Controllers\Controller;
use Tsny\Models\Skill;

class SkillController extends Controller
{
    public function toggle($skill_id){
        $skill = Skill::where('id', $skill_id)->select('id', 'current')->first();

        $skill->current = !$skill->current;

        if($skill->save()){
            return Response::json($skill);
        }

        return Response::json(['message' => 'There was a problem updating the skill.'], 400);
    }
}

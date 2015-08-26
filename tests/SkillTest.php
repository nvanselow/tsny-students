<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SkillTest extends TestCase {

    use DatabaseTransactions, WithoutMiddleware;

    public function testToggleGoal(){
        $skill = \Tsny\Models\Skill::find(1);

        $this->post('api/skill/1/toggle');
        $this->seeInDatabase('skills', ['id' => 1, 'current' => !$skill->current]);

        $this->post('api/skill/1/toggle');
        $this->seeInDatabase('skills', ['id' => 1, 'current' => $skill->current]);
    }

}
<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class GoalTest extends TestCase {

    use DatabaseTransactions, WithoutMiddleware;

    public function testToggleGoal(){
        $goal = \Tsny\Models\Goal::find(1);

        $this->post('api/goal/1/toggle');
        $this->seeInDatabase('goals', ['id' => 1, 'complete' => !$goal->complete]);

        $this->post('api/goal/1/toggle');
        $this->seeInDatabase('goals', ['id' => 1, 'complete' => $goal->complete]);
    }

}
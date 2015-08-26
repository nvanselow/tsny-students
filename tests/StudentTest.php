<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tsny\Models\Student;

class StudentTest extends TestCase {

    use DatabaseTransactions, WithoutMiddleware;

    public function testFindStudent(){

        $user = \Tsny\Models\Student::find(1);

        $this->get('api/student/1')
            ->seeJson([
                'student' => $user->toArray()
            ]);

    }

    public function testAddStudent(){
        $student = factory('Tsny\Models\Student')->make()->toArray();
        $student['schools'] = [1,2];

        $this->post('api/student', ['student' => $student])
            ->see('student added');

        $this->seeInDatabase('students', array_except($student, ['schools']));

        $this->seeInDatabase('school_student', ['school_id' => 1]);
        $this->seeInDatabase('school_student', ['school_id' => 2]);
    }

    public function testAddSchool(){

        $boston = Student::create([
            'first_name' => 'BostonStudent',
            'last_name' => 'BostonStudent',
            'nickname' => 'BostonStudent',
            'email' => 'bostonstudent@tsny.com',
            'primary_school' => 2,
        ]);

        $boston->addSchool(1);

        $this->seeInDatabase('school_student', [
            'student_id' => $boston->id,
            'school_id' => 1
        ]);
    }

    public function testAddNote(){
        $note = factory(\Tsny\Models\Note::class)->make()->toArray();

        $this->post('api/student/1/note', ['note' => $note])
            ->see('note');

        $note['student_id'] = 1;

        $this->seeInDatabase('notes', $note);
    }

    public function testAddGoal(){
        $goal = factory(\Tsny\Models\Goal::class)->make()->toArray();

        $this->post('api/student/1/goal', ['goal' => $goal])
            ->see('goal');

        $goal['student_id'] = 1;

        $this->seeInDatabase('goals', $goal);
    }

    public function testAddSkill(){
        $skill = factory(\Tsny\Models\Skill::class)->make()->toArray();

        $this->post('api/student/1/skill', ['skill' => $skill])
            ->see('skill');

        $skill['student_id'] = 1;

        $this->seeInDatabase('skills', $skill);
    }

    public function testSearch(){
        $response = $this->call('get', 'api/student/search/MAY');

        $this->assertCount(1, json_decode($response->getContent()));
    }
}
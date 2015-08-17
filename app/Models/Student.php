<?php

namespace Tsny\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Tsny\CustomObjects\StudentSummary;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'nickname', 'email', 'primary_school'];

    public function getDetails(){

        $this->skills = DB::table('skills')->where('student_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->select([
                'id',
                'name',
                'proficiency',
                'current',
                'note',
                'updated_at'
            ])
            ->get();

        $this->goals = DB::table('goals')->where('student_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->select([
                'id',
                'description',
                'complete',
                'updated_at'
            ])
            ->get();

        $this->notes = DB::table('notes')->where('student_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->select([
                'id',
                'note',
                'updated_at'
            ])
            ->get();

        return [
            'skills' => $this->skills,
            'goals' => $this->goals,
            'notes' => $this->notes
        ];
    }

    public function addSchool($school_id){
        if(!$school_id){
            throw new \Exception('No school id provided');
        }

        $school = School::find($school_id);

        if(!$school){
            throw new \Exception('School does not exist. Could not find school with that id.');
        }

        if(DB::table('school_student')->where('student_id', $this->id)->where('school_id', $school_id)->first()){
            throw new \Exception('School has already been linked to student. Cannot be duplicated.');
        }

        DB::table('school_student')->insert([
            'student_id' => $this->id,
            'school_id' => $school_id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        $this->schools = DB::table('school_student')->where('student_id', $this->id)->lists('school_id');

        return $this;
    }

    public function addSkill($skill) {

        $skill['id'] = DB::table('skills')->insertGetId([
            'student_id' => $this->id,
            'name' => $skill['name'],
            'proficiency' => $skill['proficiency'],
            'current' => $skill['current'],
            'note' => $skill['note'],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        return $skill;
    }

    public function removeSkill($skill_id){

        DB::table('skills')->where('student_id', $this->id)
            ->where('id', $skill_id)
            ->delete();

        return $this;
    }

    public function addGoal($goal){

        $goal['id'] = DB::table('goals')->insertGetId([
            'student_id' => $this->id,
            'description' => $goal['description'],
            'complete' => $goal['complete'],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()

        ]);

        return $goal;
    }

    public function toggleGoalCompletion($goal_id){
        $goal = DB::table('goals')->where('student_id', $this->id)->where('id', $goal_id)->first(['id', 'complete']);

        if(!$goal) { throw new \Exception('Goal not found.'); }

        $goal->complete = !$goal->complete;

        DB::table('goals')->where('id', $goal_id)->update([
            'complete' => $goal->complete,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        return $goal;
    }

    public function removeGoal($goal_id){
        DB::table('goals')->where('student_id', $this->id)
            ->where('id', $goal_id)
            ->delete();

        return $this;
    }

    public function addNote($note){
        $note['id'] = DB::table('notes')->insertGetId([
            'student_id' => $this->id,
            'note' => $note['note'],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        return $note;
    }

    public function editNote($note){
        DB::table('notes')->where('student_id', $this->id)->where('id', $note['id'])
            ->update([
                'note' => $note['note'],
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        return $this;
    }

    public function removeNote($note_id){
        DB::table('notes')->where('student_id', $this->id)->where('id', $note_id)->delete();

        return $this;
    }

    public function getSummary(){
        return new StudentSummary($this->id);
    }


}

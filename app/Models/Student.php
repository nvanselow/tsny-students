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

    public function getSummary(){
        return new StudentSummary($this->id);
    }


}

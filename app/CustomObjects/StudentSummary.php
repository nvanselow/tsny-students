<?php

namespace Tsny\CustomObjects;

use DB;

class StudentSummary {

    public $current_goals = [];
    public $current_skills = [];
    public $most_recent_notes = [];

    private $recent_notes_limit = 2;

    public function __construct($student_id){
        return $this->get($student_id);
    }

    public function get($student_id){
        $this->current_goals = DB::table('goals')->where('student_id', $student_id)
            ->where('complete', false)
            ->orderBy('created_at', 'desc')
            ->select([
                'description',
                'complete'
            ])
            ->limit(3)
            ->get();

        $this->current_skills = DB::table('skills')->where('student_id', $student_id)
            ->where('current', true)
            ->orderBy('created_at', 'desc')
            ->select([
                'name',
                'proficiency',
                'current'
            ])
            ->get();

        $this->most_recent_notes = DB::table('notes')->where('student_id', $student_id)
            ->orderBy('created_at', 'desc')
            ->select([
                'note'
            ])
            ->limit($this->recent_notes_limit)
            ->get();

        return $this;
    }

}
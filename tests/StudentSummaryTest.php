<?php


use Tsny\Models\Note;

class StudentSummaryTest extends TestCase {

    public function testGetSingleSummary(){

        $note = new Note();

        $note->student_id = 1;
        $note->note = "most recent note";
        $note->save();

        $summary = new \Tsny\CustomObjects\StudentSummary(1);

        $this->assertEquals(2, count($summary->current_goals));
        $this->assertEquals(1, count($summary->current_skills));
        $this->assertEquals(1, count($summary->most_recent_notes));

        $this->assertEquals('most recent note', $summary->most_recent_notes[0]->note);

    }

}
<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;

class SchoolsTest extends TestCase {

    use DatabaseTransactions;

    public function testViewSchools(){

        $this->get('/api/schools')
            ->seeJson(
                ['name' => 'Boston']
            )
            ->dontSee('Honolulu');
    }

}
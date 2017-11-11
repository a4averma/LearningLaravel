<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;
    
    public function aUserCanBrowseThreads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
}

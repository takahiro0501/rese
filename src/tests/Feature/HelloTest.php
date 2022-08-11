<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloTest extends TestCase
{
    public function test_example()
    {

        $this->assertTrue(true);

        $response = $this->get('/home');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);

    }
}

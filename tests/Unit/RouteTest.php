<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{

    /** @test
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get("/home");
        $response->assertStatus(200);
    }
}

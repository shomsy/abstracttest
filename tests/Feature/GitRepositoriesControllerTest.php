<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GitRepositoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    * @group i
    */
    public function it_invokes()
    {
        $this->login();

        $response = $this->get('repositories');

        $response->assertStatus(200);
    }
}

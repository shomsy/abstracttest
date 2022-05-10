<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GitCommitsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    * @group pop
    */
    public function it_invokes()
    {
        $user = $this->mockSocialiteFacade();
        $response = $this->get('auth/github/callback');

        $repos = Http::get($user->user['repos_url'])->object();
        $oneRepo =collect($repos)->first();
        $owner = $oneRepo->owner->login;
        $repo = $oneRepo->name;

        $response = $this->get("repos/{$owner}/{$repo}/commits");

        $response->assertStatus(200);
    }
}

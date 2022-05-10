<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Two\User;
use PHPUnit\Framework\MockObject\MockObject;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login()
    {
        $this->mockSocialiteFacade();

        $this->get('auth/github/callback');
    }

    /**
     * Mock the Socialite Factory, so we can hijack the OAuth Request.
     * @param string $email
     * @param string $token
     * @param string $name
     * @param int $id
     * @return MockObject|User
     */
    public function mockSocialiteFacade(string $email = 'foo@bar.com', string $token = 'foo', string $name = 'somebody', int $id = 1)
    {
        $socialiteUser = $this->createMock(User::class);
        $socialiteUser->id = $id;
        $socialiteUser->name = $name;
        $socialiteUser->email = $email;
        $socialiteUser->avatar = 'https://i.pravatar.cc/150?img=3';
        $socialiteUser->token = $token;
        $socialiteUser->user['company'] = 'My Awesome Company';
        $socialiteUser->user['repos_url'] = 'https://api.github.com/users/defunkt/repos'; // from documentation

        $provider = $this->createMock(GithubProvider::class);
        $provider->expects($this->any())
            ->method('user')
            ->willReturn($socialiteUser);

        $stub = $this->createMock(SocialiteManager::class);
        $stub->expects($this->any())
            ->method('driver')
            ->willReturn($provider);

        // Replace Socialite Instance with our mock
        $this->app->instance(Socialite::class, $stub);

        return $socialiteUser;
    }
}

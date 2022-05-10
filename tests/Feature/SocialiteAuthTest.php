<?php

namespace Tests\Feature;

use App\Events\CheckIdentity;
use App\Listeners\ConfirmIdentityEmailNotification;
use App\Listeners\SendWelcomeEmailNotificationToRegisteredUser;
use App\Notifications\ConfirmIdentityEmail;
use App\Notifications\WelcomeEmail;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\SocialiteManager;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\GithubProvider;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class SocialiteAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_redirects_to_github()
    {
        $response = $this->get('auth/github');

        $response->assertStatus(302);

        $response->assertRedirect($response->getTargetUrl());
    }

    /**
    * @test
    * @group z
    */
    public function it_retrieves_github_request_and_creates_a_new_user()
    {
        // Mock the Facade and return a User Object with the email 'foo@bar.com'
        $this->mockSocialiteFacade();
        $response = $this->get('auth/github/callback');

        $response->assertLocation('/profile');

        $this->assertDatabaseHas('users', [
            'email' => 'foo@bar.com',
            'name' => 'somebody',
            'github_id' => 1,
            'company' => 'My Awesome Company',
            'password' => 'foo',
            'github_token' => 'foo',
            'github_avatar' => 'https://i.pravatar.cc/150?img=3',
        ]);
    }

    /**
     * @return void
     * @test
     */
    public function it_retrieves_github_request_and_doesnt_create_a_new_user_if_already_exists_in_database()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'foo@bar.com',
        ]);

        $this->login();

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * @return void
     * @test
     */
    public function it_updates_user_token_in_database()
    {
        $user = \App\Models\User::factory()->create([
            'github_token' => 'abcd',
        ]);

        $this->login();

        $this->assertDatabaseHas('users', [
            'github_token' => 'foo',
        ]);
    }

    /**
     * @return void
     * @test
     * @group y
     * @throws Exception
     */
    public function it_fires_event_when_user_is_registered()
    {
        Event::fake();

        $user = \App\Models\User::factory()->create([
            'email' => 'foo@bar.com',
        ]);

        $this->login();

        Event::assertListening(
            Registered::class,
            SendWelcomeEmailNotificationToRegisteredUser::class
        );
    }

    /**
     * @return void
     * @test
     * @group y
     */
    public function it_sends_welcome_email_to_user_when_registered()
    {
        Notification::fake();
        Notification::assertNothingSent();

        $this->login();

        $user = \App\Models\User::first();

        Notification::assertSentTo($user, WelcomeEmail::class);
    }

    /**
     * @return void
     * @test
     * @group x
     * @throws Exception
     */
    public function it_fires_event_when_user_is_logged_in()
    {
        Event::fake();

        $user = \App\Models\User::factory()->create([
            'email' => 'foo@bar.com',
        ]);

        $this->login();

        Event::assertListening(
            CheckIdentity::class,
            ConfirmIdentityEmailNotification::class
        );
    }

    /**
     * @return void
     * @test
     * @group x
     * @throws Exception
     */
    public function it_sends_confirmation_identity_email_to_user_when_logged_in()
    {
        Notification::fake();
        Notification::assertNothingSent();

        $user = \App\Models\User::factory()->create([
            'email' => 'foo@bar.com',
        ]);

        $this->login();

        Notification::assertSentTo($user, ConfirmIdentityEmail::class);
    }

    /**
     * @return void
     * @test
     * @group zzz
     * @throws Exception
     */
    public function it_logges_out_user()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'foo@bar.com',
        ]);

        $this->login();

        $response = $this->get('auth/github/logout');

        $response->assertRedirect($response->getTargetUrl());
    }
}

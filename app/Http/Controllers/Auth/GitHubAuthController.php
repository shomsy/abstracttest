<?php
/** @noinspection DuplicatedCode */

namespace App\Http\Controllers\Auth;

use App\Events\CheckIdentity;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Routing\Redirector;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Stevebauman\Location\Facades\Location;

class GitHubAuthController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function gitRedirect(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }


    /**
     * @return void
     */
    public function gitCallback()
    {
        try {
            $fetchedUser = Socialite::driver('github')->user();

            if ($gitUser = User::where('github_id', $fetchedUser->id)->first()) {
                return $this->login($gitUser);
            }

            return $this->register($fetchedUser);

        } catch
        (Exception $e) {
            dd($e->getMessage());
        }
    }


    /**
     * @param  \Laravel\Socialite\Contracts\User  $authUser
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function register(\Laravel\Socialite\Contracts\User $authUser): Redirector|RedirectResponse|Application
    {
        $user = User::create(
            [
                'name' => $authUser->name,
                'email' => $authUser->email,
                'github_id' => $authUser->id,
                'company' => $authUser->user['company'],
                'password' => $authUser->token
            ]
        );

        event(new Registered($user));

        return redirect('/home');
    }

    /**
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function login(User $user): Redirector|RedirectResponse|Application
    {
        Auth::login($user);

        $userIp = shell_exec('curl ifconfig.me');
        $locationData = Location::get($userIp)->cityName;

        event(new CheckIdentity($user, $userIp, $locationData));

        return redirect('/home');
    }

    /**
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }
}

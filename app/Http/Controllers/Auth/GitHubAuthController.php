<?php

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
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Stevebauman\Location\Facades\Location;

class GitHubAuthController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
     */
    public function gitRedirect(): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * @return Redirector|RedirectResponse|Application
     */
    public function gitCallback(): Redirector|RedirectResponse|Application
    {
        try {
            $fetchedUser = Socialite::driver('github')->user();
            session()->put('OAuth', $fetchedUser);

            if ($gitUser = User::where('github_id', $fetchedUser->id)->first()) {
                if ($fetchedUser->token !== $gitUser->gitHubToken) {
                    $gitUser->update(['github_token' => $fetchedUser->token]);
                }

                return $this->login($gitUser);
            }

            return $this->register($fetchedUser);

        } catch
        (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param \Laravel\Socialite\Contracts\User $authUser
     *
     * @return Application|RedirectResponse|Redirector
     */
    private function register(\Laravel\Socialite\Contracts\User $authUser): Redirector|RedirectResponse|Application
    {
        $user = User::create(
            [
                'name' => $authUser->name ?? 'N/A',
                'email' => $authUser->email ?? 'N/A',
                'github_id' => $authUser->id,
                'company' => optional($authUser->user)['company'] ?? 'N/A',
                'password' => $authUser->token,
                'github_token' => $authUser->token,
                'github_avatar' => $authUser->getAvatar() ?? 'https://i.pravatar.cc/150?img=3',
            ]
        );

        Auth::login($user);

        event(new Registered($user));

        return redirect('/profile');
    }

    /**
     * @param User $user
     *
     * @return Application|RedirectResponse|Redirector
     */
    private function login(User $user): Redirector|RedirectResponse|Application
    {
        Auth::login($user);

        $userIp = shell_exec('curl ifconfig.me');
        $locationData = Location::get($userIp)->cityName;

        event(new CheckIdentity($user, $userIp, $locationData));

        return redirect('/profile');
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function logout(): Redirector|Application|RedirectResponse
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}

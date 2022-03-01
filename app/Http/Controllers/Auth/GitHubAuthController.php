<?php
/** @noinspection DuplicatedCode */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Routing\Redirector;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

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
     * @return \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function gitCallback()
    {
        try {
            $authUser = Socialite::driver('github')->user();

            $gitUser = User::where('github_id', $authUser->id)->first();

            if (! $gitUser) {
                $gitUser = User::create(
                    [
                        'name' => $authUser->name,
                        'email' => $authUser->email,
                        'github_id' => $authUser->id,
                        'company' => $authUser->user['company'],
                        'password' => $authUser->token
                    ]
                );
            }


            Auth::login($gitUser);

            event(new Registered($gitUser));

            return redirect('/home'); // redirect to notification page "You need to verify email"
        } catch
        (Exception $e) {
            dd($e->getMessage());
        }
    }
}

<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Http\Controllers;

use Gate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return View
     */
    public function edit(): View
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        auth()->user()->update($request->validated());

        return back()->withStatus(__('Profile successfully updated.'));
    }
}

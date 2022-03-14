<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class GitRepositoryController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // TODO: get token from DB
        $gitUser = Socialite::driver('github')
            ->userFromToken('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');

        $getGitUserRepositories = Http::get($gitUser['repos_url'])->body();

        $gitRepositories = json_decode($getGitUserRepositories);

        return view('pages.user-git-repositories', ['gitRepositories' => $gitRepositories]);
    }
}

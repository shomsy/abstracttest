<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class GitRepositoriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return Application|Factory|View
     * @throws RequestException
     */
    public function __invoke(): View|Factory|Application
    {
        $gitUser = Socialite::driver('github')
            ->userFromToken(auth()->user()->github_token);

        $getGitUserRepositories = Http::get($gitUser['repos_url'])->throw()->object();

        $paginatedData = collect($getGitUserRepositories)->simplePaginate(5);

        return view('pages.user-git-repositories', ['gitRepositories' => $paginatedData]);
    }
}

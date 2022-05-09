<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GitRepositoriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return Application|Factory|View
     * @throws RequestException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(): View|Factory|Application
    {
        $gitUser = session()->get('OAuth');

        $getGitUserRepositories = [];
        if (isset($gitUser->user['repos_url'])) {
            $getGitUserRepositories = Http::get($gitUser->user['repos_url'])->throw()->object();
        }

        $paginatedData = collect($getGitUserRepositories)->simplePaginate(5);

        return view('pages.user-git-repositories', ['gitRepositories' => $paginatedData]);
    }
}

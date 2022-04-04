<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitCommitsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param string $owner
     * @param string $repo
     * @return View|Factory|Application
     * @throws RequestException
     */
    public function __invoke(Request $request, string $owner, string $repo): View|Factory|Application
    {
        $getRepositoryCommits = Http::get("https://api.github.com/repos/$owner/$repo/commits")->throw()->object();

        $paginatedData = collect($getRepositoryCommits)->simplePaginate(2);

        return view('pages.git-commits', ['gitCommits' => $paginatedData]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GithubRepoController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getReleases(Request $request)
    {
        $validatedData = $request->validate([
            'repo_url' => ['required', 'url']
        ]);

        $urlParts = parse_url($validatedData['repo_url']);

        $pathParts = explode('/', $urlParts['path']);

        $owner = $pathParts[1];
        $repo = $pathParts[2];

        $response = Http::get("https://api.github.com/repos/$owner/$repo/releases");

		 $releases = collect($response->json())->map(function ($release) {
		        return (object) [
		            'name' => $release['name'],
		            'zipball_url' => $release['zipball_url'],
		        ];
		    });
     

        return view('home', compact('releases'));
    }
}
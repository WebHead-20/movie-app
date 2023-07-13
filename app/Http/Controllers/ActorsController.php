<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        // Fetching Data From Api
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page)
            ->json();

        $popularActors = $request['results'];
        $total_pages = $request['total_pages'];

        abort_if($page > $total_pages, 204);

        $viewModel = new ActorsViewModel($popularActors, $page, $total_pages);

        return view('actors.index', $viewModel);
    }

     public function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id)
            ->json();

        $social = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
            ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
            ->json();

        $viewModel = new ActorViewModel($actor, $social, $credits);

        return view('actors.show', $viewModel);
    }
}
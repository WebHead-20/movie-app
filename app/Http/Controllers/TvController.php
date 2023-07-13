<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * List All Movies.
     */
    public function index()
    {

        // Fetching Data From Api
        $popularTvShows = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];


        $topRatedTvShows = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $viewModel = new TvViewModel(
            $popularTvShows,
            $genres,
            $topRatedTvShows,
            $total_pages = null,
            $page = null
        ); // View Model Helps in Eliminating Logic From View Files

        return view('tv.index', $viewModel);
    }

    /**
     * Display the Movie Details Page.
     */
    public function show($id)
    {
        $tvshow = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
    }

    public function allpopulartv($page = 1)
    {

        // Fetching Data From Api
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular?page=' . $page)
            ->json();
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $popularTvShows = $request['results'];
        $total_pages = $request['total_pages'];

        $viewModel = new TvViewModel(
            $popularTvShows,
            $genres,
            $topRatedTvShows = null,
            $total_pages,
            $page
        ); // View Model Helps in Eliminating Logic From View Files

        return view('tv.populartv', $viewModel);

    }
    public function alltopratedtv($page = 1)
    {

        // Fetching Data From Api
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated?page=' . $page)
            ->json();

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $topRatedTvShows = $request['results'];
        $total_pages = $request['total_pages'];

        $viewModel = new TvViewModel(
            $popularTvShows = null,
            $genres,
            $topRatedTvShows,
            $total_pages,
            $page
        ); // View Model Helps in Eliminating Logic From View Files

        return view('tv.topratedtv', $viewModel);

    }

}
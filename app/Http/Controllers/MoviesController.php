<?php

namespace App\Http\Controllers;

use App\ViewModels\MovieDetailsViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * List All Movies.
     */
    public function index()
    {

        // Fetching Data From Api
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];


        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $genres,
            $nowPlayingMovies,
            $total_pages = null,
            $page = null
        ); // View Model Helps in Eliminating Logic From View Files

        return view('movies.index', $viewModel);
    }

    /**
     * Display the Movie Details Page.
     */
    public function show(string $id)
    {

        $movieDetails = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $viewModel = new MovieDetailsViewModel($movieDetails); // View Model Helps in Eliminating Logic From View Files

        return view('movies.show', $viewModel);

    }
    public function allpopularmovies($page = 1)
    {

        // Fetching Data From Api
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?page=' . $page)
            ->json();
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $popularMovies = $request['results'];
        $total_pages = $request['total_pages'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $genres,
            $nowPlayingMovies = null,
            $total_pages,
            $page
        ); // View Model Helps in Eliminating Logic From View Files

        return view('movies.popularmovies', $viewModel);

    }
    public function allnowplayingmovies($page = 1)
    {

        // Fetching Data From Api
        $request = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?page=' . $page)
            ->json();
            
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $nowPlayingMovies = $request['results'];
        $total_pages = $request['total_pages'];

        $viewModel = new MoviesViewModel(
            $popularMovies = null,
            $genres,
            $nowPlayingMovies,
            $total_pages,
            $page
        ); // View Model Helps in Eliminating Logic From View Files

        return view('movies.nowplayingmovies', $viewModel);

    }

}
<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{

    // Defining Logics for Movies Fetched from api
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;
    public $page;
    public $total_pages;


    public function __construct($popularMovies = null, $genres, $nowPlayingMovies = null, $total_pages = null, $page = null)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
        $this->total_pages = $total_pages;
        $this->page = $page;
    }



    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }
    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }


    private function formatMovies($movies)
    {

        return collect($movies)->map(function ($movie) {

            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($id) {
                return [$id => $this->genres()->get($id)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                        "poster_path",
                        "id",
                        "genre_ids",
                        "title",
                        "vote_average",
                        "overview",
                        "release_date",
                        "genres",
                    ]);
        });
    }


}
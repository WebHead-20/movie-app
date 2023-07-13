<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTvShows;
    public $genres;
    public $topRatedTvShows;
    public $page;
    public $total_pages;

    public function __construct($popularTvShows = null, $genres, $topRatedTvShows = null, $total_pages = null, $page = null)
    {
        $this->popularTvShows =$popularTvShows;
        $this->genres =$genres;
        $this->topRatedTvShows =$topRatedTvShows;
        $this->total_pages = $total_pages;
        $this->page = $page;
    }

    public function popularTvShows()
    {
        return $this->formatMovies($this->popularTvShows);
    }
    public function topRatedTvShows()
    {
        return $this->formatMovies($this->topRatedTvShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($tvShows)
    {

        return collect($tvShows)->map(function ($tvShow) {

            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function ($id) {
                return [$id => $this->genres()->get($id)];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path' => $tvShow['backdrop_path'] ? 'https://image.tmdb.org/t/p/w500/' . $tvShow['backdrop_path'] : 'https://via.placeholder.com/500x280',
                'vote_average' => $tvShow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                        "poster_path",
                        "id",
                        "genre_ids",
                        "name",
                        "vote_average",
                        "overview",
                        "first_air_date",
                        "genres",
                    ]);
        });
    }
}

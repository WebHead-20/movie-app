<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{

    public $popularActors;
    public $page;
    public $total_pages;

    public function __construct($popularActors, $page, $total_pages)
    {
        $this->popularActors = $popularActors;
        $this->total_pages = $total_pages;
        $this->page = $page;
    }

    public function popularActors()
    {

        return collect($this->popularActors)->map(function ($actor) {


            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $actor['profile_path'] : "https://ui-avatars.com/api/?size=235&name=" . $actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', '),
            ])->only([
                        'name',
                        'id',
                        'profile_path',
                        'known_for'
            ]);

        });
    }

    // public function previous()
    // {
    //     return $this->page > 1 ? $this->page - 1 : null;
    // }
    // public function next()
    // {
    //     return $this->page < $this->total_pages ? $this->page + 1 : null;
    // }

}
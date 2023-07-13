@extends('layouts/main')

@section('content')
    <div class="container mx-auto px-1 md:px-2 lg:px-4 pt-8 md:pt-16">

        

        <div class="top-rated-tv">
            <div class="flex justify-between items-center mb-5 sm:mb-0">
                <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Top Rated Shows</h2>
                <a href="{{ route('tv.alltopratedtv') }}" class="hover:text-gray-300">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2 md:gap-4 ">
                 @foreach ($topRatedTvShows as $tvShow)
                 <x-tv-card :tvShow="$tvShow"/>
                 @endforeach
            </div>
        </div>

        <div class="popular-tv py-16 sm:py-24">
            <div class="flex justify-between items-center mb-5 sm:mb-0">
                <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Popular TV Shows</h2>
                <a href="{{ route('tv.allpopulartv') }}" class="hover:text-gray-300">View All</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2 md:gap-4 ">
                 @foreach ($popularTvShows as $tvShow)
                 <x-tv-card :tvShow="$tvShow"/>
                 @endforeach
            </div>
        </div>

    </div>
@endsection

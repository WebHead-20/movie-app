@extends('layouts/main')

@section('content')
      <div class="container mx-auto px-1 md:px-2 lg:px-4 pt-8 md:pt-16">

        <div class="popular-movies">
            <div class="flex justify-between items-center mb-5 sm:mb-0">
                <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Popular Movies</h2>
                <a href="{{ route('movies.allpopularmovies') }}" class="hover:text-gray-300">View All</a>
            </div>

            <div class="grid grid-cols-3 lg:grid-cols-5 gap-2 md:gap-4 ">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
        </div>

        <div class="now-playing-movies py-16 sm:py-24">
              <div class="flex justify-between items-center mb-5 sm:mb-0">
                <h2 class="uppercase tracking-wider text-orange-400 text-lg font-semibold">Now Playing</h2>
                <a href="{{ route('movies.allnowplayingmovies') }}" class="hover:text-gray-300">View All</a>
            </div>
            <div class="grid grid-cols-3 lg:grid-cols-5 gap-2 md:gap-4 ">
                @foreach ($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>

    </div>
@endsection

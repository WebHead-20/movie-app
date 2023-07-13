@extends('layouts/main')

@section('content')
    <div class="container mx-auto px-1 md:px-2 lg:px-4 pt-16">

        <div class="popular-movies">
            <h2 class="uppercase tracking-wider mb-5 sm:mb-0 text-orange-400 text-lg font-semibold">Now Playing Movies</h2>

            <div class="grid grid-cols-3 lg:grid-cols-5 gap-2 md:gap-4 ">
                @foreach ($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>


        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll(elem, {
            // options
            path: '/now-playing-movies/page/@{{#}}',
            append: '.movie',
            status: '.page-load-status'
            // history: false,
        });
    </script>
@endsection

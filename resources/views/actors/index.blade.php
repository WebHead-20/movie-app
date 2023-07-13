@extends('layouts/main')

@section('content')
      <div class="container mx-auto px-1 md:px-2 lg:px-4 pt-8 md:pt-16">

        <div class="popular-actors">
            <h2 class="uppercase tracking-wider mb-5 sm:mb-0 text-orange-400 text-lg font-semibold">Popular Actors</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 md:gap-4 ">

                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{route('actors.show', $actor['id'])}}" class="">
                            <img src="{{ $actor['profile_path'] }}" alt="profile Image"
                                class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show', $actor['id'])}}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-xs sm:text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>{{-- popular Actors End --}}

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>


        {{-- Pagination btns --}}
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{ $previous }}">Previous</a>
            @else
                <div></div>
            @endif


            @if ($next)
                <a href="/actors/page/{{ $next }}">Next</a>
            @endif
        </div> --}}

    </div>
@endsection


@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll(elem, {
            // options
            checkLastPage: '.pagination__next',
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
            // history: false,
        });
    </script>
@endsection

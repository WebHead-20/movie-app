@extends('layouts/main')

{{-- Movie Details Page  --}}

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="flex flex-col md:flex-row container mx-auto px-4 py-16">

            <img src="{{ $movieDetails['poster_path'] }}" alt="{{ $movieDetails['title'] }}" class="w-full md:w-[24rem]">

            <div class="mt-2 md:mt-0 md:ml-5 lg:ml-24">

                <h2 class="text-4xl font-semibold">
                    {{ $movieDetails['title'] }}
                </h2>

                <div class="flex flex-wrap md:items-center text-gray-300 md:text-gray-400 text-sm mt-1 md:mt-2">

                    <div class="flex items-center">
                        <span>
                            <svg class="fill-current text-orange-400 w-4" viewBox="0 0 24 24">
                                <path
                                    d="m12 18.26-7.053 3.948 1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34 8.027.952-5.934 5.488 1.575 7.928-7.053-3.948Z" />
                            </svg>
                        </span>
                        <span class="ml-1">{{ $movieDetails['vote_average'] }}</span>
                    </div>

                    <span class="inline mx-2">|</span>

                    <span>{{ $movieDetails['release_date'] }}</span>

                    <span class="inline mx-2">|</span>

                    <span>{{ $movieDetails['genres'] }}</span>

                </div>

                <p class="text-gray-300 mt-8 text-sm">
                    {{ $movieDetails['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Cast</h4>
                    <div class="flex mt-4">

                        @foreach ($movieDetails['crew'] as $crew)
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div x-data="{ isOpen: false }">


                    @if ($movieDetails['video'])
                        <div class="mt-12">
                            <button @click="isOpen = true"
                                class="inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                </svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>




                        <template x-if="isOpen">
                            <div style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative"
                                                style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    src="{{ $movieDetails['video'] }}" style="border:0;"
                                                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif

                </div>
            </div>
        </div>
    </div>


    {{-- Movie Cast --}}
    <div class="movie-cast border-b border-gray-800">
        <div class="container px-4 py-16 mx-auto">
            <h2 class="text-4xl font-semibold tracking-wider mb-5 sm:mb-0">Cast</h2>
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 md:gap-8 ">

                @foreach ($movieDetails['cast'] as $cast)
                    <div class="mt-2 sm:mt-8">
                        <a href="{{route('actors.show', $cast['id'])}}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w300/' . $cast['profile_path'] }}" alt="cast">
                        </a>
                        <div class="mt-0 sm:mt-2">
                            <a href="{{route('actors.show', $cast['id'])}}" class="text-md sm:text-lg block mt-1">{{ $cast['name'] }}</a>
                            <div class="flex items-center text-gray-400 text-sm">
                                <span>{{ $cast['character'] }}</span>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

    {{-- Images --}}
    <div class="movie-images" x-data="{ isOpen: false, image: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movieDetails['images'] as $image)
                    <div class="mt-8">
                        <a @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'
                            "
                            href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}" alt="image1"
                                class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach
            </div>

            <div style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end movie-images -->
@endsection

<div class="relative mt-0" x-data="{ isOpen: true }" @click.away="isOpen= false">

    <input wire:model.debounce.500ms="search" type="text" @focus="isOpen= true" @keydown.escape.window="isOpen= false"
        @keydown="isOpen= true" @keydown.shift.tab="isOpen= false"
        class="bg-gray-800 text-sm rounded-full w-32 sm:w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline"
        placeholder="Search" x-ref="search"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        ">
    <div class="absolute top-0">
        <svg class="fill-current text-gray-500 w-4 mt-[6px] md:mt-[0.35rem] ml-2" viewBox="0 0 24 24">
            <path
                d="m18.031 16.617 4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617Zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.867-3.133-7-7-7s-7 3.133-7 7 3.133 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15Z" />
        </svg>
    </div>


    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if (strlen($search) > 2)

        <div class="absolute right-0 lg:left-0 text-sm bg-gray-800 rounded w-64 mt-4 z-50"
            x-show.transition.opacity="isOpen">

            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        @php
                            $link = '';
                            
                            if ($result['media_type'] === 'movie') {
                                $link = route('movies.show', $result['id']);
                            } elseif ($result['media_type'] === 'person') {
                                $link = route('actors.show', $result['id']);
                            } elseif ($result['media_type'] === 'tv') {
                                $link = route('tv.show', $result['id']);
                            }
                        @endphp

                        <li class="border-b border-gray-700">
                            <a href="{{ $link }}" class="hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if ($loop->last) @keydown.tab.exact="isOpen= false" @endif>

                                @if (isset($result['poster_path']))
                                    <img class="w-8"
                                        src="{{ 'https://image.tmdb.org/t/p/w92/' . $result['poster_path'] }}"
                                        alt="poster">
                                @elseif(isset($result['profile_path']))
                                    <img class="w-8"
                                        src="{{ 'https://image.tmdb.org/t/p/w92/' . $result['profile_path'] }}"
                                        alt="poster">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                @endif

                                <span class="ml-4">
                                    @if ($result['media_type'] === 'movie')
                                        {{ $result['title'] }}
                                    @else
                                        {{ $result['name'] }}
                                    @endif
                                </span>

                            </a>

                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif

        </div>
    @endif
</div>

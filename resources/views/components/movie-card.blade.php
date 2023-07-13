 <div class="movie mt-2 sm:mt-8">
     <a href="{{ route('movies.show',  $movie['id'])}}">
         <img src="{{$movie['poster_path'] }}" alt="{{ $movie['title'] }}"
             class="hover:opacity-75 transition ease-in-out duration-150">
     </a>
     <div class="mt-0 sm:mt-2">
         <a href="{{ route('movies.show',  $movie['id'])}}"
             class="text-sm sm:text-lg block text-center sm:text-left hover:text-gray-300 mt-1">{{ $movie['title'] }}</a>
         <div class="sm:flex items-center text-gray-400 hidden lg:text-sm">
             <span><svg class="fill-current text-orange-400 w-4" viewBox="0 0 24 24">
                     <path
                         d="m12 18.26-7.053 3.948 1.575-7.928L.588 8.792l8.027-.952L12 .5l3.385 7.34 8.027.952-5.934 5.488 1.575 7.928-7.053-3.948Z" />
                 </svg></span>
             <span class="ml-1">{{ $movie['vote_average'] }}</span>
             <span class="mx-2">|</span>
             <span>{{ $movie['release_date'] }}</span>
         </div>
         <div class="text-gray-400 text-sm hidden sm:block">{{$movie['genres']}}</div>
     </div>
 </div>

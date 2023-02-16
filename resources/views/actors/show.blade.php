@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-4 py-16 border-b border-gray-700">
        <div class="movie-info flex lg:flex-row flex-col lg:gap-24 gap-8"> <!-- actor profile -->
            <div class="flex-none">
                <a href="#">
                    <img src="{{$actor['profile_path']}}" alt="actor-profile" class="rounded-md hover:opacity-75 transition ease-in-out duration-150 shadow shadow-gray-200/10 w-64 lg:w-96">
                    <ul class="flex flex-row justify-start mt-4 gap-3">
                        @if ($social['instagram'])
                            <li>
                                <a href="{{$social['instagram']}}" title="Instagram" target="_blanck" rel="external">
                                    <ion-icon class="w-7 h-7 text-gray-300 hover:text-white" name="logo-instagram"></ion-icon>
                                </a>
                            </li>   
                        @endif
                        @if ($social['facebook'])    
                            <li>
                                <a href="{{$social['facebook']}}" title="Facebook" target="_blanck" rel="external">
                                    <ion-icon class="w-7 h-7 text-gray-300 hover:text-white" name="logo-facebook"></ion-icon>
                                </a>
                            </li>
                        @endif
                        @if ($social['twitter'])
                            <li>
                                <a href="{{$social['twitter']}}" title="Twitter" target="_blanck" rel="external">
                                    <ion-icon class="w-7 h-7 text-gray-300 hover:text-white" name="logo-twitter"></ion-icon>
                                </a>
                            </li>
                        @endif
                        @if ($actor['homepage'])
                            <li>
                                <a href="{{$actor['homepage']}}" title="website" target="_blanck" rel="external">
                                    <ion-icon class="w-7 h-7 text-gray-300 hover:text-white" name="globe"></ion-icon>
                                </a>
                            </li>        
                        @endif
                    </ul>
                </a>
            </div>
            <div>
                <h2 class="font-semibold text-4xl">{{$actor['name']}}</h2>
                <div class="flex flex-row text-sm items-center mt-2 text-gray-300 flex-wrap">
                    <svg class="fill-current text-gray-300 hover:text-white w-4" viewBox="0 0 24 24">
                            <path d="M8 6v3.999h3V6h2v3.999h3V6h2v3.999L19 10a3 3 0 0 1 2.995 2.824L22 13v1c0 1.014-.377 1.94-.999 2.645L21 21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-4.36a4.025 4.025 0 0 1-.972-2.182l-.022-.253L2 14v-1a3 3 0 0 1 2.824-2.995L5 10l1-.001V6h2zm11 6H5a1 1 0 0 0-.993.883L4 13v.971l.003.147A2 2 0 0 0 6 16a1.999 1.999 0 0 0 1.98-1.7l.015-.153.005-.176c.036-1.248 1.827-1.293 1.989-.134l.01.134.004.147a2 2 0 0 0 3.992.031l.012-.282c.124-1.156 1.862-1.156 1.986 0l.012.282a2 2 0 0 0 3.99 0L20 14v-1a1 1 0 0 0-.883-.993L19 12zM7 1c1.32.871 1.663 2.088 1.449 2.888a1.5 1.5 0 0 1-2.898-.776C5.85 2.002 7 2.5 7 1zm5 0c1.32.871 1.663 2.088 1.449 2.888a1.5 1.5 0 1 1-2.898-.776C10.85 2.002 12 2.5 12 1zm5 0c1.32.871 1.663 2.088 1.449 2.888a1.5 1.5 0 1 1-2.898-.776C15.85 2.002 17 2.5 17 1z"/>
                    </svg>
                    <span class="ml-2">{{$actor['birthday']}} ({{$actor['age']}} anos) em {{$actor['place_of_birth']}}</span>
                    
                </div>
                <p class="text-justify text-gray-300 mt-8">
                    {{$actor['biography']}}
                </p>

                <h2 class="font-semibold mt-12">Filmes</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($knownForMovies as $movies)
                        <div class="mt-4">
                            <a href="{{route('movies.show',$movies['id'])}}">
                                <img src="{{$movies['poster_path']}}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150 ">
                            </a>
                            <a href="{{route('movies.show', $movies['id'])}}" class="text-sm leading-normal block text-gray-300 hover:text-white mt-1">{{$movies['title']}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>  
    </div> <!-- actor profile -->
    <div class="container mx-auto px-4 py-16 border-b border-gray-700"> <!--start actor credits -->
        <div>
            <h2 class="font-semibold text-4xl">Filmografia</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach ($credits as $credit )
                    <li>{{$credit['release_year']}}&middot; 
                        <a href="{{route('movies.show', $credit['id'])}}" class="hover:text-gray-400">
                            <strong>{{$credit['title']}}</strong>
                        </a>
                        como {{$credit['character']}}</li>
                @endforeach
            </ul>
        </div>
    </div> <!-- end actor credits -->

@endsection
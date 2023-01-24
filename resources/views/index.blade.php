@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies "> <!-- start popular movies -->
            <h2 class="uppercase font-semibold text-orange-400 tracking-wider text-lg">Filmes Populares</h2>
            <div class="movies grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
            @foreach($popularMovies as $movies)    
                <x-movie-card :movies="$movies" :genres="$genres"/>
            @endforeach
        </div> <!-- end popular movies -->
        <div class="now-playing-movies my-24"> <!-- start now playing movies -->
            <h2 class="uppercase font-semibold text-orange-400 tracking-wider text-lg">Filmes em Exibição</h2>
            <div class="movies grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
                @foreach ($nowPlaying as $movies)
                    <x-movie-card :movies="$movies" :genres="$genres"/>
                @endforeach
            </div>
        </div> <!-- end now playing movies-->
    </div>
@endsection
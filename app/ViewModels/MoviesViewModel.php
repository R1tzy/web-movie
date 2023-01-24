<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MoviesViewModel extends ViewModel
{
    public $nowPlaying;
    public $popularMovies;
    public $genres;


    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->nowPlaying = $nowPlaying;
        $this->popularMovies = $popularMovies;
        $this->genres = $genres;
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlaying(){
        return $this->formatMovies($this->nowPlaying);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies)
    {
        // @foreach ($movies['genre_ids'] as $genre){{ $genres->get($genre) }}@if (!$loop->last),@endif @endforeach

        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->isoformat('D MMMM, YYYY'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'vote_average','release_date','genres','overview','genre_ids','title'
            ]);
        });
    }
}

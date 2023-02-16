<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    // o nome da função tem que ser igual ao da variável que está sendo usado na view
    public function details(){
        return $this->formatMovie($this->movie);
    }


    private function formatMovie($movie){
        return collect($movie)->merge([
            'vote_average' => $movie['vote_average']*10 .'%',
            'poster_path'=> 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
            'release_date' => Carbon::parse($movie['release_date'])->isoFormat("D MMMM, YYYY"),
            'genres' => collect($movie['genres'])->pluck('name')->implode(', '),
            'crew' => collect($movie['credits']['crew'])->take(2),
            'cast' => collect($movie['credits']['cast'])->take(5),
            'images' => collect($movie['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'vote_average', 'release_date', 'genres', 'crew', 'cast', 'images', 'videos', 'image', 'crew', 'credits', 'id', 'title', 'overview'
        ]);
    }
}

<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvViewModel extends ViewModel
{
    public $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function details(){
        return $this->formatTv($this->tv);
    }

    private function formatTv($tv){
        return collect($tv)->merge([
            'vote_average' => $tv['vote_average']*10 .'%',
            'poster_path'=> 'https://image.tmdb.org/t/p/w500'.$tv['poster_path'],
            'first_air_date' => Carbon::parse($tv['first_air_date'])->isoFormat("D MMMM, YYYY"),
            'genres' => collect($tv['genres'])->pluck('name')->implode(', '),
            'crew' => collect($tv['credits']['crew'])->take(2),
            'cast' => collect($tv['credits']['cast'])->take(5),
            'images' => collect($tv['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'vote_average', 'first_air_date', 'genres', 'crew', 'cast', 'images', 'videos', 'image', 'crew', 'credits', 'id', 'name', 'overview'
        ]);
    }
}

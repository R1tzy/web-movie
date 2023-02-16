<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class TvsViewModel extends ViewModel
{
    public $popularTv;
    public $genres;
    public $ratedTv;

    public function __construct($popularTv, $genres, $ratedTv)
    {
        $this->popularTv = $popularTv;
        $this->genres = $genres;
        $this->ratedTv = $ratedTv;
    }

    public function popularTv(){
        return $this->formatTvs($this->popularTv);
    }

    public function ratedTv(){
        return $this->formatTvs($this->ratedTv);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTvs($tv){
        return collect($tv)->map(function($tv){
            $genresFormatted = collect($tv['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($tv)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$tv['poster_path'],
                'vote_average' => $tv['vote_average'] * 10 ."%",
                'first_air_date' => Carbon::parse($tv['first_air_date'])->isoFormat('D MMM, YYYY'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'vote_average','first_air_date','genres','overview','genre_ids','name'
            ]);
        });
    }
}

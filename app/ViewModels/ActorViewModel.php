<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $credits;
    public $social;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->credits = $credits;
        $this->social =  $social;
    }

    public function actor(){
        $actor = $this->actor;
        return collect($actor)->merge([
            'birthday' => Carbon::parse($actor['birthday'])->isoFormat('D MMM, YYYY'),
            'age' => Carbon::parse($actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
            ? 'https://image.tmdb.org/t/p/w300'.$this->actor['profile_path']
            : 'https://via.placeholder.com/300x450',
        ])->only([
            'age', 'name', 'birthday', 'profile_path', 'homepage', 'biography', 'id', 'place_of_birth'
        ]);
    
    }

    public function social(){
        $social = $this->social;
        return collect($social)->merge([
            'instagram' => $social['instagram_id'] ? "https://instagram.com/".$social['instagram_id'] : null,
            'facebook' => $social['facebook_id'] ? "https://facebook.com/".$social['facebook_id'] : null,
            'twitter' => $social['twitter_id'] ? "https://twitter.com/".$social['twitter_id'] : null,
        ])->only([
            'instagram', 'facebook', 'twitter'
        ]);
    }

    public function knownForMovies(){
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->where('media_type','movie')->sortByDesc('popularity')->take(5)
            ->map(function($movie){
                return collect($movie)->merge([
                    'poster_path' => $movie['poster_path'] 
                        ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                        : 'https://via.placeholder.com/185x278',
                    'title' => isset($movie['title']) ? $movie['title'] : 'Sem Título'
                ]);
            });
    }

    public function credits(){
        $cast = collect($this->credits)->get('cast');

        return collect($cast)->map(function($movie){
            if(isset($movie['release_date'])){
                $releaseDate = $movie['release_date'];
            }
            elseif(isset($movie['first_air_date'])){
                $releaseDate = $movie['first_air_date'];
            }
            else{
                $releaseDate = '';
            }

            if(isset($movie['title'])){
                $title = $movie['title'];
            }
            elseif(isset($movie['name'])){
                $title = $movie['name'];
            }
            else{
                $title = "Sem título";
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format("Y") : "Futuro",
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
            ]);
        })
        ->sortByDesc('release_date')
        ->sortByDesc('release_year');
    }

}

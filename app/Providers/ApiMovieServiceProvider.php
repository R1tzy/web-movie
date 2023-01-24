<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ApiMovieServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('api-movie', function(){
            return HTTP::withOptions([
                'base_uri' => 'https://api.themoviedb.org/3/',
                
            ])
            ->withoutVerifying()
            ->withToken(config('services.tmdb.token'));
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    // Há duas maneiras de nomear um teste, Primeira usando test_"nome" ou /** @test */
    
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /** @test */
    public function the_main_page_shows_correct_info(){
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular?language=pt-BR' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing?language=pt-BR' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list?language=pt-BR' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('Filmes Populares');
        $response->assertSee('Fake Movie');
        $response->assertSee('Animação, Ação, Aventura, Comédia, Família, Fantasia');
        $response->assertSee('Filmes em Exibição');
        $response->assertSee('Now Playing Fake Movie');  
    }

    private function fakePopularMovies(){
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/r9PkFnRUIthgBp2JZZzD380MWZy.jpg",
                    "genre_ids" => [
                        16,
                        28,
                        12,
                        35,
                        10751,
                        14,
                    ],
                    "id" => 315162,
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "overview" => "Fake Movie descobre que sua paixão pela aventura cobrou seu preço: ele queimou oito de suas nove vidas, deixando-o com apenas uma vida restante. Gato parte em uma jornada épica para encontrar o mítico Último Desejo e restaurar suas nove vidas.",
                    "popularity" => 10102.273,
                    "poster_path" => "/65NBNqJiaHeCmqDqkCmrRplJXw.jpg",
                    "release_date" => "2023-01-05",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 8.6,
                    "vote_count" => 1215,
                ]
            ]
        ],200);
    }

    private function fakeNowPlayingMovies(){
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/r9PkFnRUIthgBp2JZZzD380MWZy.jpg",
                    "genre_ids" => [
                        16,
                        28,
                        12,
                        35,
                        10751,
                        14,
                    ],
                    "id" => 315162,
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "overview" => "Now Playing Fake Movie descobre que sua paixão pela aventura cobrou seu preço: ele queimou oito de suas nove vidas, deixando-o com apenas uma vida restante. Gato parte em uma jornada épica para encontrar o mítico Último Desejo e restaurar suas nove vidas.",
                    "popularity" => 10102.273,
                    "poster_path" => "/65NBNqJiaHeCmqDqkCmrRplJXw.jpg",
                    "release_date" => "2023-01-05",
                    "title" => "Now Playing Fake Movie",
                    "video" => false,
                    "vote_average" => 8.6,
                    "vote_count" => 1215,
                ]
            ]
        ],200);
    }

    private function fakeGenres(){
        return Http::response([
                'genres' => [
                    [
                    "id" => 28,
                    "name" => "Ação"
                    ],
                    [
                    "id" => 12,
                    "name" => "Aventura"
                    ],
                    [
                    "id" => 16,
                    "name" => "Animação"
                    ],
                    [
                    "id" => 35,
                    "name" => "Comédia"
                    ],
                    [
                    "id" => 80,
                    "name" => "Crime"
                    ],
                    [
                    "id" => 99,
                    "name" => "Documentário"
                    ],
                    [
                    "id" => 18,
                    "name" => "Drama"
                    ],
                    [
                    "id" => 10751,
                    "name" => "Família"
                    ],
                    [
                    "id" => 14,
                    "name" => "Fantasia"
                    ],
                    [
                    "id" => 36,
                    "name" => "História"
                    ],
                    [
                    "id" => 27,
                    "name" => "Terror"
                    ],
                    [
                    "id" => 10402,
                    "name" => "Música"
                    ],
                    [
                    "id" => 9648,
                    "name" => "Mistério"
                    ],
                    [
                    "id" => 10749,
                    "name" => "Romance"
                    ],
                    [
                    "id" => 878,
                    "name" => "Ficcção científica"
                    ],
                    [
                    "id" => 10770,
                    "name" => "Filme de TV"
                    ],
                    [
                    "id" => 53,
                    "name" => "Thriller"
                    ],
                    [
                    "id" => 10752,
                    "name" => "Guerra"
                    ],
                    [
                    "id" => 37,
                    "name" => "Ocidental"
                    ],
                ]
        ]);
    }

}

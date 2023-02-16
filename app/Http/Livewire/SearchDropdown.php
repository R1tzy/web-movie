<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Api;

class SearchDropdown extends Component
{
    public $search = "";

    public function render()
    {
        $movie = [];
        $tv = [];
        $people = [];

        if (strlen($this->search) >= 2){
            $movie = Api::get('/search/movie?query='.$this->search.'&language=pt-BR')
            ->json()['results'];
            $people = Api::get('/search/person?query='.$this->search)
            ->json()['results'];
            $tv = Api::get('/search/tv?query='.$this->search.'&language=pt-BR')
            ->json()['results'];
        }
        return view('livewire.search-dropdown',[
            'movie' => collect($movie)->take(7),
            'people' => collect($people)->take(7),
            'tv' => collect($tv)->take(7),
        ]);
    }
}

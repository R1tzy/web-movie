<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Api;

class SearchDropdown extends Component
{
    public $search = "";

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2){
            $searchResults = Api::get('/search/movie?query='.$this->search.'&language=pt-BR')
            ->json()['results'];
        }
        return view('livewire.search-dropdown',[
            'searchResults' => collect($searchResults)->take(7)
        ]);
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieCard extends Component
{
    public $movies;
    public $genres;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($movies, $genres)
    {
        $this->movies = $movies;
        $this->genres = $genres;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.movie-card');
    }
}

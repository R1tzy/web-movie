@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv-shows "> <!-- start popular tv shows -->
            <h2 class="uppercase font-semibold text-orange-400 tracking-wider text-lg">Programas Populares</h2>
            <div class="tv-shows grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
            @foreach($popularTv as $tv)    
                <x-tv-card :tv="$tv"/>
            @endforeach
        </div> <!-- end popular tv shows -->
        <div class="top-rated-tv-shows my-24"> <!-- start top rated tv shows -->
            <h2 class="uppercase font-semibold text-orange-400 tracking-wider text-lg">Programas Melhores Avaliações</h2>
            <div class="tv-shows grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
                @foreach ($ratedTv as $tv)
                    <x-tv-card :tv="$tv"/>
                @endforeach
            </div>
        </div> <!-- end top rated tv shows -->
    </div>
@endsection
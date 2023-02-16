@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-4 py-16 border-b border-gray-700">
        <div class="movie-info flex lg:flex-row flex-col lg:gap-24 gap-8"> <!-- start movie info -->
            <div class="flex-none">
                <a href="#">
                    <img src="{{$details['poster_path']}}" alt="tv-poster" class="rounded-md hover:opacity-75 transition ease-in-out duration-150 shadow shadow-gray-200/10 w-64 lg:w-96">
                </a>
            </div>
            <div>
                <h2 class="font-semibold text-4xl">{{$details['name']}}</h2>
                <div class="flex flex-row text-sm items-center mt-2 text-gray-300 flex-wrap">
                    <ion-icon name="star" class="text-orange-400 w-5 h-5"></ion-icon>
                    <span class="ml-1">{{$details['vote_average']}}</span>
                    <span class="mx-2">|</span>
                    <span class="ml-1">{{$details['first_air_date']}}</span>
                    <span class="mx-2">|</span>
                    <span class="ml-1">{{$details['genres']}}</span>
                </div>
                <p class="text-justify text-gray-300 mt-8">
                    {{$details['overview']}}
                </p>
                <div class="mt-12">
                    <h4 class="font-semibold">Equipe Técnica</h4>
                    <div class="flex mt-6 gap-8">
                        @foreach ($details['crew'] as $crew)            
                            <div>
                                <div>{{$crew['name']}}</div>
                                <div class="text-sm text-gray-400 " >{{$crew['job']}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div x-data="{ isOpen: false }">
                    @if (count($details['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                            >
                                <ion-icon name="play-circle" class="w-6 h-6 text-gray-900"></ion-icon>
                                <span class="capitalize ml-2 tracking-wide">play trailer</span>
                            </button>
                        </div>

                        <template x-if="isOpen">
                            <div
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click="isOpen = false"
                                                @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $details['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif
                </div>
              
            </div>
        </div>  
    </div> <!-- end movie info-->
    <div class="container mx-auto px-4 py-16 border-b border-gray-700"> <!--start movie cast -->
        <div>
            <h2 class="font-semibold text-4xl">Elenco</h2>
            <div class="movie-cast flex flex-row gap-8 flex-wrap mt-8">
                @foreach ($details['cast'] as $cast)
                    <div>
                        <a href="{{route('actors.show',$cast['id'])}}">
                            @if ($cast['profile_path'] === null)
                                <img src="https://via.placeholder.com/224x336" alt="actor" class="rounded-md hover:opacity-75 transition ease-in-out duration-150 shadow w-56">
                            @else
                                <img src="{{'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']}}" alt="actor" class="rounded-md hover:opacity-75 transition ease-in-out duration-150 shadow w-56">
                            @endif
                        </a>
                        <div class="mt-3">
                            <a href="{{route('actors.show',$cast['id'])}}" class="text-lg hover:text-gray-300">{{$cast['name']}}</a>
                            <div class="text-sm text-gray-400 w-[14rem]">{{$cast['character']}}</div>
                        </div>
                    </div>
                @endforeach
            </div>  
        </div>
    </div> <!-- end movie cast-->

    <div x-data="{isOpen:false, image:''}">
        <div class="container mx-auto px-4 py-16"> <!-- start image-->
            <h2 class="font-semibold text-4xl">Imagens</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                @foreach ($details['images'] as $img)    
                    <div>
                        <a href="#"
                        @click.prevent="
                            isOpen = true
                            image='{{ 'https://image.tmdb.org/t/p/original/'.$img['file_path'] }}'"
                        >
                            <img src="{{'https://image.tmdb.org/t/p/w500/'.$img['file_path']}}" alt="image" class="rounded hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>     
                @endforeach
            </div>
        </div>
        <div style="background-color: rgba(0, 0, 0, .5);"
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
            x-show="isOpen">
        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
            <div class="bg-gray-900 rounded">
                <div class="flex justify-end pr-4 pt-2">
                    <button
                        @click="isOpen = false"
                        @keydown.escape.window="isOpen = false"
                        class="text-3xl leading-none hover:text-gray-300">&times;
                    </button>
                </div>
                <div class="modal-body px-8 py-8">
                   <img :src="image" alt="poster">
                </div>
            </div>
        </div>
    </div>
    <!-- end image -->
@endsection
<div class="relative" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input 
    wire:model.debounce.50ms="search" 
    type="text" 
    placeholder="Pesquisar" class="text-sm w-64 rounded-full px-4 py-1 pl-8 focus:outline-none focus:shadow-outline bg-[#2c323b]"
    x-ref="search"
    @keydown.window="
        if (event.keyCode === 191) {
            event.preventDefault();
            $refs.search.focus();
        }
        {{-- 191 representa / , quando pressionar a barra ele vai para o search--}}
    "
    @focus="isOpen = true"
    @keydown="isOpen = true"
    @keydown.escape.window="isOpen = false"
    @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <ion-icon name="search" class="w-4 text-gray-400 mt-[6px] ml-2"></ion-icon>
    </div>
    <div wire:loading class="spinner top-0 right-0 mt-3 mr-4"></div>
    @if (strlen($search) >= 2)
        <div class="z-50 absolute text-sm bg-[#2c323b] rounded w-64 mt-4" x-show.transition.opacity="isOpen">
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)  
                        <li class="border-b border-gray-700">
                            <a 
                            href="{{route('movies.show',$result['id'])}}" class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                            @if ($loop->last) @keydown.tab="isOpen = false"@endif
                            >
                                @if ($result['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster" class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">   
                                @endif
                                <span class="ml-4">{{$result['title']}}</span>
                            </a>
                            
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">Sem resultados para "{{$search}}"</div>
            @endif
        </div>
    @endif
</div>


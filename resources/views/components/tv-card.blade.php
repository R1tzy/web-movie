<div class="mt-8">
    <a href="{{route('tv.show', $tv['id'])}}">
        <img src="{{$tv['poster_path']}}" alt="tv-poster" class="rounded-md hover:opacity-75 transition ease-in-out duration-150 shadow shadow-gray-200/10">
    </a>
    <div class="mt-2">
        <a href="{{route('tv.show', $tv['id'])}}" class="text-lg hover:text-gray-300 mt-2">{{$tv['name']}}</a>
        <div class="flex flex-row items-center text-gray-300 text-sm mt-1">
            <ion-icon name="star" class="text-orange-400 w-4 h-4"></ion-icon>
            <span class="ml-1">{{$tv['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span class="ml-1">{{$tv['first_air_date']}}</span>
        </div>
        <div class="text-gray-300 text-sm mt-1">{{$tv['genres']}}</div>
    </div>
</div>

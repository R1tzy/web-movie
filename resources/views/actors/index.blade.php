@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors "> <!-- start popular actors -->
            <h2 class="uppercase font-semibold text-orange-400 tracking-wider text-lg">Atores Populares</h2>
            <div class="actores grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
                @foreach ($popularActors as $actors)
                    <div class="actor mt-8">
                        <a href="{{route('actors.show',$actors['id'])}}">
                            <img src="{{$actors['profile_path']}}" alt="profile image" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show',$actors['id'])}}" class="text-lg hover:text-gray-300">{{$actors['name']}}</a>
                            <div class="text-sm truncate text-gray-400">{{$actors['known_for']}}</div>
                        </div>
                    </div>
                @endforeach
        </div> <!-- end popular actors -->
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{$previous}}" class="hover:text-gray-400">Anterior</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a href="/actors/page/{{$next}}" class="hover:text-gray-400">Próximo</a>
            @else
                <div></div>
            @endif
        </div>
    </div> --}}
    <div class="page-load-status my-8">
        <div class="flex justify-center">
            <p class="infinite-scroll-request my-7 text-4xl spinner">&nbsp;</p>
        </div>
        <p class="infinite-scroll-last">Fim do Conteúdo</p>
        <p class="infinite-scroll-error">Erro</p>
      </div>
@endsection

@section('script')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
        status: '.page-load-status'
        // history: false,
        });
    </script>
@endsection
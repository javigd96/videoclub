<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Listado de peliculas
        </h2>
    </x-slot>

    @if (session('success'))
    <div class="max-w-4xl mx-auto mt-8 bg-green-700 text-white p-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="mx-40 grid grid-cols-4 gap-4">
      
                <div class="col-md-2"> 
                    
                <img src="{{ asset('images/'.$film->poster) }}" alt="{{$film->poster}}" title="job image">
                    
                </div>

                <div class="col-md-2"> 
                    <div class="row">
                    <p class="pt-6"><span class="font-bold">Titulo;
                    {{ $film->title }}
                    <p class="pt-6"><span class="font-bold">Año;
                    {{ $film->year }}
                    <p class="pt-6"><span class="font-bold">Director;
                    {{ $film->director }}
                    <p class="pt-6"><span class="font-bold">Synopsis;
                    {{ $film->synopsis }}
                    <p class="pt-6"><span class="font-bold">Estado;
                    @if($film->rented)
                        <p class="pt-6"><span class="font-bold">No Alquilada;
                    @else
                        <p class="pt-6"><span class="font-bold">Pelicula alquilada
                    @endif      
                
                 
                 </div>

                <div class="inline-flex mt-2">
                @if($film->rented)

                <form action="{{ route('catalogo.rent2',$film) }}"style="display:inline">
                    @csrf
                    @method('PUT')
                    <button type='submit' class='rounded-5m bg-yellow-500 ml-4'>Alquilar pelicula</button>
                </form>
                @else
                <form action="{{ route('catalogo.rent',$film) }}"style="display:inline">
                    @csrf
                    @method('PUT')
                    <button type='submit' class='rounded-5m bg-blue-500 ml-4'>devolver pelicula</button>
                </form>
                @endif

                    <form action="{{ route('film.edit',$film) }}" method="GET">
                    @if(Auth()->user()->hasRole('admin'))
                    <button type='submit' class='rounded-5m bg-green-500 ml-4'>Editar Pelicula</button>

                    @else
                    <button type='submit' class='rounded-5m bg-green-500 ml-4' onclick="return false;">Editar Pelicula</button>
                    @endif
                </form>
                


                <form action="{{ route('film.destroy',$film) }}"style="display:inline">
                    @csrf
                    @method('delete')
                    @if(Auth()->user()->hasRole('admin'))
                    <button type='submit' class='rounded-5m bg-red-500 ml-4'>Borrar Pelicula</button>

                    @else
                    <button type='submit' class='rounded-5m bg-red-500 ml-4'onclick="return false;">Borrar Pelicula</button>

                    @endif
                </form>
                

                <form action="{{ route('catalogo.index') }}"style="display:inline">
                    
                    <button type='submit' class='rounded-5m bg-blue-500 ml-4'>Volver Listar</button>
                </form>


    </div>


</x-app-layout>
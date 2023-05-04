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

    <div class="overflow-x-auto mx-auto my-12 relative shadow-md sm:rounded-lg bg-white">

        <div class="p-5 bg-white flex items-center justify-center">
            <a href="{{ route('films.create') }}" 
            class="px-4 py-2 rounded-lg bg-blue-800 hover:opacity-80 text-white">Crear Pelicula</a>
        </div>
      
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Número.
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Titulo
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Sinopsis
                    <th scope="col" class="py-3 px-6">
                        Year
                    <th scope="col" class="py-3 px-6">
                        Director    
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Category
                    <th scope="col" class="py-3 px-6">
                        Imagen
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Alquilado
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($films as $film)
                <tr class="bg-white border-b  hover:bg-gray-50 ">
                    <td class="py-4 px-6 ">
                        {{ $film->id }}
                    </td>
                    <td class="py-4 px-6 ">
                        {{ $film->title }}
                    </td>
                    <td class="py-4 px-6">

                        {{ $film->synopsis }}
                    </td>
                    <td class="py-4 px-6">

                        {{ $film->year }}
                    </td>
                    <td class="py-4 px-6">

                        {{ $film->director }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $film->category->title }}
                    </td>
                   
                    <td class="py-4 px-6">
                        <img src="{{ asset('images/'.$film->poster) }}" alt="{{$film->poster}}" title="job image">
                    </td>
                    <td class="py-4 px-6">
                        {{ $film->rented }}
                    </td>
                    
                    <td class="py-4 px-5 flex items-center gap-x-2.5">
                        <button class="rounded-5m bg-blue-500 font-bold py-2 px-4 text-600">
                        <a href="{{ route('films.edit', $film->id) }}" class="font-medium text-white-600  hover:underline">
                            Edit
                        </a></button>
           
                        {{-- Delete Article --}}
                        
                        <form action="{{ route('films.destroy', $film->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="rounded-5m bg-red-500 font-bold py-2 px-4 text-600" 
                            type="submit" class="px-2 font-medium text-white-600  hover:underline">
                                Delete
                            </button>
                        </form>

                        <button class="rounded-5m bg-green-500 font-bold py-2 px-4 text-600">
                            <a href="{{ route('films.show', $film) }}">
                                Mostrar
                        
                        
                    </td>
                </tr>
                @empty
                <h3 class="text-2xl text-center font-bold p-5">No hay peliculas</h3>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $films->links() }}
        </div>
    </div>


</x-app-layout>
<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Requests\FilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films=Film::paginate(5);

        return view ('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $film= new Film;
        $title='Crear pelicula';
        $textButton = __('Crear Pelicula');
        $route =route('films.store');

        return view('films.form', compact('title','route', 'film','textButton'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmRequest $request)
    {
        
        $validated =$request->safe()->only(['title','category_id','synopsis','year','director','poster','rented']);
        //dd($validated);
        $imageName = time().'.'.$request->poster->extension();
        $request->poster->move(public_path('images'), $imageName);
        $validated['poster'] =$imageName;
        
        Film::create($validated);
        return redirect(route("films.index"))->with("sucess", __("¡Pelicula creada!"));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $film=Film::find($id);
        
        return view('catalogo.show', compact ('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $title = __('Editar pelicula');
        $textButton = __('Actualizar');
        $route = route('films.update', ["film" => $film]);

        return view('films.form', compact('title', 'textButton', 'route', 'film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmRequest $request, Film $film)
    {
        
        $validated=$request->safe()->only(['title','category_id','synopsis','year','director','poster','rented']);
        
        if ($request->hasfile('poster')){
            $imageName = time().'.'.$request->poster->extension();
            $request->poster->move(public_path('images'), $imageName);
            $validated['poster'] =$imageName;
        }
        
        $film->update($validated);
        return redirect(route("films.index"))
            ->with("success", __("¡Pelicula actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return back()->with("success", __("¡Pelicula eliminada!"));
    }
}

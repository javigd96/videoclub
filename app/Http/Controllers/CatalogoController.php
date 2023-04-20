<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
class CatalogoController extends Controller
{
    public function index(){
        $films=Film::all();

        return view ('catalogo.index',compact('films'));
    }
}

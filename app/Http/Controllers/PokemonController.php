<?php

namespace App\Http\Controllers;

use App\PokemonProfile;

class PokemonController extends Controller
{
    public function __invoke()
    {
        $pokemon = PokemonProfile::orderBy('data->weight', 'desc')->paginate(5);

        return view('welcome', ['pokemon' => $pokemon]);
    }
}

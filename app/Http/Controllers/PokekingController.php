<?php

namespace App\Http\Controllers;

use Response;
use App\PokemonProfile;

class PokekingController extends Controller
{
    /**
     * Returns a Json response with the PokeKing.
     *
     * @return Response
     */
    public function __invoke()
    {
        // We have to provide sum_of_stats with a number in order to compare our Pokemons later.
        $winner = array('sum_of_stats' => 0);

        foreach (PokemonProfile::all() as $pokemon) {
            $sum = 0;

            // Go through all the base_stat values to calculate the sum
            foreach (json_decode($pokemon->data)->stats as $stats) {
                $sum += $stats->base_stat;
            }

            // Check every Pokemon to get the very best, like no one ever was ♫
            if ($winner['sum_of_stats'] < $sum) {
                $winner['name'] = $pokemon->name;
                $winner['sum_of_stats'] = $sum;
                // Extra info to spice things up, for the PokeKing.
                $winner['image'] = json_decode($pokemon->data)->sprites->front_default;
                $winner['height'] = json_decode($pokemon->data)->height;
                $winner['weight'] = json_decode($pokemon->data)->weight;
            }
        }

        return Response::json($winner);
    }
}

<?php

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Pokemon;
use App\PokemonProfile;

class PokemonTableSeeder extends Seeder
{
    /**
     * Run the database seeds to fetch Pokemons through the API and store them
     * in the Database.
     */
    public function run()
    {
        $client = new Client();

        $url = 'https://pokeapi.co/api/v2/pokemon/';

        do {
            $res = $client->get($url);

            $data = json_decode($res->getBody()->getContents());

            foreach ($data->results as $pokemon) {
                // Check if the Pokemon exists, else insert it
                Pokemon::firstOrCreate(['name' => $pokemon->name, 'url' => $pokemon->url]);
                $this->savePokemonProfile($pokemon->url, $client);
            }
            $url = $data->next;
        } while ($data->next);
    }

    /**
     * A function that gets the Pokemon's details and decides if it shoulde be inserted
     * in our pokemons_profile database.
     *
     * @param string            $url
     * @param GuzzleHttp\Client $client
     **/
    protected function savePokemonProfile($url, $client)
    {
        $res = $client->request('GET', $url);

        $data = json_decode($res->getBody()->getContents());

        // Check if the Pokemon fits (no pun intended) the criteria to ba saved to the database
        if ($data->height >= '50' && !is_null($data->sprites->front_default)) {
            PokemonProfile::updateOrCreate(
                ['name' => $data->name], // find the Pokemon based on their name
                ['data' => json_encode($data)] // update the data
            );
        }
    }
}

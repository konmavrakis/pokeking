<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokemonProfile extends Model
{
    protected $table = 'pokemon_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'data'];
}

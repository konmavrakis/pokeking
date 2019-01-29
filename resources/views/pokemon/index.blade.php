@extends('layout')
@section('content')
    <div class="container">

        <h1><i class="nes-ash"></i>PokéKing!</h1>
        
        <div class="nes-table-responsive">
            <table class="nes-table is-bordered is-centered">
                <thead>
                    <tr>
                        <th>Sprite</th>
                        <th>Name</th>
                        <th>Base Experience</th>
                        <th>Height</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pokemon as $profile)
                        <tr>
                            <td><img src="{{ json_decode($profile->data)->sprites->front_default }}"></td>
                            <td>{{ ucfirst($profile->name) }}</td>
                            <td>{{ json_decode($profile->data)->base_experience }}</td>
                            <td>{{ json_decode($profile->data)->height }}</td>
                            <td>{{ json_decode($profile->data)->weight }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $pokemon->links( "pagination::bootstrap-4") }}
        </div>


        <div class="d-flex justify-content-center {{ $pokemon->isEmpty() ? 'hidden' : '' }}">
            <button class="nes-btn" id="pokeking">
                PokéKing!<br>
                <i class="nes-kirby"></i>
            </button>
        </div>

        <div id="pokeking-div">

        </div>
    </div>
@endsection
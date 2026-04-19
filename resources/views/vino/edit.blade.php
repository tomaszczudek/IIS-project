@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/vino/seznam" class="btn btn-secondary">← Zpět na seznam vín</a>
    </div>

    <h1 class="mb-4">Úprava vína</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="/vino/update-{{ $vino->id }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="procento_alkoholu" class="form-label">Procento alkoholu (%)</label>
                            <input type="number" step="0.1" class="form-control @error('procento_alkoholu') is-invalid @enderror" 
                                   id="procento_alkoholu" name="procento_alkoholu" max="99" min="0"
                                   value="{{ $vino->procento_alkoholu }}" required>
                            @error('procento_alkoholu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pocet_vyrobenych_lahvi" class="form-label">Počet vyrobených lahví</label>
                            <input type="number" step="1" class="form-control @error('pocet_vyrobenych_lahvi') is-invalid @enderror" 
                                   id="pocet_vyrobenych_lahvi" name="pocet_vyrobenych_lahvi" 
                                   value="{{ $vino->pocet_vyrobenych_lahvi }}" required>
                            @error('pocet_vyrobenych_lahvi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="pocet_zbylych_lahvi" class="form-label">Počet zbývajících lahví</label>
                            <input type="number" step="1" class="form-control @error('pocet_zbylych_lahvi') is-invalid @enderror" 
                                   id="pocet_zbylych_lahvi" name="pocet_zbylych_lahvi" 
                                   value="{{ $vino->pocet_zbylych_lahvi }}" required>
                            @error('pocet_zbylych_lahvi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cena" class="form-label">Cena za lahev (Kč)</label>
                            <input type="number" step="0.1" class="form-control @error('cena') is-invalid @enderror" 
                                   id="cena" name="cena" 
                                   value="{{ $vino->cena }}" required>
                            @error('cena')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">Aktualizovat víno</button>
                            <a href="/vino/seznam" class="btn btn-secondary">Zrušit</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
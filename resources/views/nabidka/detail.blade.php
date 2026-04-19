@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/nabidka/seznam" class="btn btn-secondary">← Zpět na nabídku vín</a>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-4">{{ App\Http\Controllers\Controller::ODRUDA_TYP[$vino->odruda] ?? 'Neznámá odruda' }}</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informace o víně</h5>
                </div>
                <div class="card-body">
                    <p><strong>Odrůda:</strong> {{ App\Http\Controllers\Controller::ODRUDA_TYP[$vino->odruda] ?? 'Neznámá odruda' }}</p>
                    <p><strong>Ročník:</strong> {{ $vino->rocnik }}</p>
                    <p><strong>Obsah alkoholu:</strong> {{ $vino->procento_alkoholu }}%</p>
                    <p><strong>Datum lahvování:</strong> {{ $vino->datum_lahvovani->format('d. m. Y') }}</p>
                </div>
            </div>

            @if ($vino->sklizen)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informace o sklizni</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Hmotnost hroznů:</strong> {{ $vino->sklizen->hmotnost_hroznu_kg }} kg</p>
                        <p><strong>Cukrnatost:</strong> {{ $vino->sklizen->cukernatost_hroznu }}°</p>
                        <p><strong>Datum sklizně:</strong> {{ $vino->sklizen->datum_sklizne->format('d. m. Y') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0">Nákup</h5>
                </div>
                <div class="card-body">
                    <p class="fs-5 mb-3">
                        <strong>Cena za lahev:</strong> <br>
                        <span class="fs-4 text-success">{{ number_format($vino->cena ?? 0, 2) }} Kč</span>
                    </p>

                    <p class="mb-4">
                        <strong>Dostupnost:</strong> <br>
                        @if ($vino->pocet_zbylych_lahvi > 0)
                            <span class="badge bg-success fs-6">{{ $vino->pocet_zbylych_lahvi }} lahví skladem</span>
                        @else
                            <span class="badge bg-danger fs-6">Vyprodáno</span>
                        @endif
                    </p>

                    @if ($vino->pocet_zbylych_lahvi > 0)
                        <form action="/kosik/pridej" method="POST">
                            @csrf
                            <input type="hidden" name="vino_id" value="{{ $vino->id }}">
                            <div class="mb-3">
                                <label for="pocet" class="form-label">Počet lahví:</label>
                                <input type="number" name="pocet" id="pocet" value="1" min="1" max="{{ $vino->pocet_zbylych_lahvi }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg w-100">
                                Přidat do košíku
                            </button>
                        </form>

                        <a href="/kosik" class="btn btn-outline-primary w-100 mt-2">
                            Zobrazit košík
                        </a>
                    @else
                        <button class="btn btn-secondary btn-lg w-100" disabled>
                            Vyprodáno
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
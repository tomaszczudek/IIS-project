@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/vino/seznam" class="btn btn-secondary">← Zpět na seznam vín</a>
    </div>

    <h1 class="mb-4">Detail vína</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informace o vínu</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Odrůda:</strong><br>
                                {{ App\Http\Controllers\Controller::ODRUDA_TYP[$vino->odruda] ?? 'Neznámá odruda' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>Ročník:</strong><br>
                                {{ $vino->rocnik }}
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Procento alkoholu:</strong><br>
                                {{ $vino->procento_alkoholu }}%
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>Cena za lahev:</strong><br>
                                {{ $vino->cena }} Kč
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Vyrobeno lahví:</strong><br>
                                {{ $vino->pocet_vyrobenych_lahvi }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>Dostupných lahví:</strong><br>
                                {{ $vino->pocet_zbylych_lahvi }}
                            </p>
                        </div>
                    </div>

                    <strong>Sklizeň:</strong><br>
                    @if ($vino->sklizen_id == null)
                        <p>Sklizeň není uvedena</p>
                    @else
                        <a href="/sklizen/detail-{{ $vino->sklizen_id }}">Detail sklizně {{ $vino->sklizen->datum_sklizne->format('d. m. Y') }}</a>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Akce</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="/vino/edit-{{ $vino->id }}" class="btn btn-warning btn-lg">Upravit</a>
                    <a href="/vino/stahnout-{{ $vino->id }}" class="btn btn-danger btn-lg">Stáhnout z nabídky</a>
                </div>
            </div>
        </div>
    </div>
@endsection
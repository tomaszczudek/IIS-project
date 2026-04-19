@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/nakupy/seznam" class="btn btn-secondary">← Zpět na historii objednávek</a>
    </div>

    <h1 class="mb-4">Detail objednávky #{{ $nakup->id }}</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Informace o objednávce</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID objednávky:</strong> {{ $nakup->id }}</p>
                    <p><strong>Datum objednávky:</strong> {{ $nakup->datum_nakupu->format('d. m. Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Uživatel:</strong> {{ $nakup->user->name ?? 'Neuvedeno' }}</p>
                    <p><strong>Email:</strong> {{ $nakup->user->email ?? 'Neuvedeno' }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-3">Položky objednávky</h2>

    @if ($nakup->polozky->count() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Odrůda vína</th>
                    <th>Ročník</th>
                    <th>Alkohol</th>
                    <th>Počet lahví</th>
                    <th>Cena za lahev</th>
                    <th>Celkem</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $celkova_cena = 0;
                @endphp
                @foreach ($nakup->polozky as $polozka)
                    @php
                        $cena_za_lahev = $polozka->vino->cena ?? 0;
                        $cena_celkem = $cena_za_lahev * $polozka->pocet_lahvi;
                        $celkova_cena = \App\Http\Controllers\NakupyController::celkova_cena($nakup->id);
                    @endphp
                    <tr onclick="window.location.href='/nabidka/detail-{{ $polozka->vino->id }}'" style="cursor: pointer;">
                        <td>{{ App\Http\Controllers\Controller::ODRUDA_TYP[$polozka->vino->odruda] ?? 'Neuvedeno' }}</td>
                        <td>{{ $polozka->vino->rocnik ?? '-' }}</td>
                        <td>{{ $polozka->vino->procento_alkoholu ?? '-' }}%</td>
                        <td>{{ $polozka->pocet_lahvi }}</td>
                        <td>{{ number_format($cena_za_lahev, 2) }} Kč</td>
                        <td><strong>{{ number_format($cena_celkem, 2) }} Kč</strong></td>
                    </tr>
                @endforeach
                <tr style="background-color: #f8f9fa; font-weight: bold;">
                    <td colspan="5" class="text-end">Celková cena:</td>
                    <td>{{ number_format($celkova_cena, 2) }} Kč</td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            Tato objednávka neobsahuje žádné položky.
        </div>
    @endif
@endsection
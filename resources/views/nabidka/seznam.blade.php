@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <h1 class="mb-4">Naše vína</h1>
    
    @if ($vina->count() > 0)
        <div class="row">
            @foreach ($vina as $v)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 clickable-card" onclick="window.location.href='/nabidka/detail-{{ $v->id }}'" style="cursor: pointer;">
                        <div class="card-body">
                            <h5 class="card-title">{{ App\Http\Controllers\Controller::ODRUDA_TYP[$v->odruda] ?? 'Neznámá odruda' }}</h5>
                            <p class="card-text">
                                <strong>Ročník:</strong> {{ $v->rocnik }}<br>
                                <strong>Alkohol:</strong> {{ $v->procento_alkoholu }}%<br>
                                @if ($v->pocet_zbylych_lahvi > 0)
                                    <strong>Zbývajících lahví:</strong> {{ $v->pocet_zbylych_lahvi }}<br>
                                @else
                                    <strong>Dostupnost:</strong> Vyprodáno/nedostupné<br>
                                @endif
                            </p>
                            <p class="text-muted small">
                                {{ $v->datum_lahvovani->format('d. m. Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Momentálně nemáme žádná vína v nabídce.
        </div>
    @endif

    <style>
        .clickable-card {
            transition: all 0.3s ease;
        }
        .clickable-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
    </style>
@endsection
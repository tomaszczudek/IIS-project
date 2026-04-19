@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <h1 class="mb-4">Historie objednávek</h1>
    <style>
        .nakupy-table tbody tr {
            border-bottom: none;
        }
        .nakupy-table tbody tr:not(:last-child) {
            border-bottom: 1px solid #dee2e6;
        }
    </style>
    @if (count($nakupy) === 0)
        <div class="alert alert-info">
            <h5>Zatím nemáte žádné objednávky</h5>
        </div>
    @else
        <table class="table table-bordered table-striped nakupy-table">
            <thead>
                <tr>
                    <th style="width: 25%;">ID objednávky</th>
                    <th style="width: 25%;">Datum objednávky</th>
                    <th style="width: 25%;">Celková cena</th>
                    <th style="width: 25%;">Stav objednávky</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($nakupy as $n)
                    <tr onclick="window.location.href='/nakupy/detail-{{ $n->id }}'" style="cursor: pointer; border: none;">
                        <td style="width: 25%; border: none;">{{ $n->id }}</td>
                        <td style="width: 25%; border: none;">{{ $n->datum_nakupu->toDateString() }}</td>
                        <td style="width: 25%; border: none;">{{ number_format(\App\Http\Controllers\NakupyController::celkova_cena($n->id), 2) }} Kč</td>
                        <td style="width: 25%; border: none;">{{ \App\Http\Controllers\Controller::STAV_TYP[$n->stav] ?? 'Neznámý stav' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

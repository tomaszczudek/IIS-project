@extends('layouts.app')

@section('title', 'Vinarstvi Andrzej')

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID řádku</th>
                <th>Druh řádku</th>
                <th>Plánované datum</th>
                <th>Datum provedení</th>
                <th>Operace</th>
                <th>Stav</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ $osetreni->radky_id }}</td>
                <td>{{ $osetreni->druh_text }}</td>
                <td>{{ $osetreni->datum }}</td>
                <td>{{ $osetreni->datum_provedeni ?? "-" }}</td>
                <td>{{ $osetreni->typ_text }}</td>
                <td>{{ $osetreni->stav_text }}</td>
            </tr>
        </tbody>
    </table>

    <div class="mb-3">
        <label for="postrik" class="form-label">Název postřiku</label>
        <input type="text" readonly value="{{ $osetreni->postrik_typ ?? '' }}" name="postrik" class="form-control" ></input>
    </div>

    <div class="mb-3">
        <label for="koncentrace" class="form-label">Koncentrace</label>
        <input type="number" readonly value="{{ $osetreni->koncentrace ?? '' }}" step="1" min="1" max="100" name="koncentrace" class="form-control">
    </div>

    <div class="mb-3">
        <label for="poznamka" class="form-label">Poznámka</label>
        <textarea readonly name="poznamka" class="form-control" rows="3">{{ $osetreni->poznamka ?? "" }}</textarea>
    </div>
@endsection
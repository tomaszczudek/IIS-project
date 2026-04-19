@extends('layouts.app')

@section('title', 'Vinarstvi Andrzej')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('failure'))
        <div class="alert alert-danger">
            {{ session('failure') }}
        </div>
    @endif
    <h1 class="mb-4">Plánování činností</h1>
    <a href="/planovat/list" class="btn mt-3 mb-3 btn-primary">
        Zobrazit naplánované činnosti
    </a>
    <form action="/planovat/evidovat" method="POST">
        @csrf
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID řádku</th>
                    <th>Druh řádku</th>
                    <th>Zvolit</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($radky as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->druh_text }}</td>
                        <td><input type="checkbox" {{ in_array($r->id, old('zvolene', []) ) ? 'checked' : '' }} name="zvolene[]" value="{{ $r->id }}" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3">
            <label for="datum"class="form-label">Datum</label>
            <input type="date" value={{ old('datum', today()->format('Y-m-d'))}} name="datum" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="typ" class="form-label">Typ činnosti</label>
            <select name="typ" class="form-select" required>
                @foreach ($akce_typy as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="postrik" class="form-label">Název postřiku</label>
            <input type="text" name="postrik" class="form-control"></input>
        </div>

        <div class="mb-3">
            <label for="koncentrace" class="form-label">Koncentrace</label>
            <input type="number" step="1" min="1" max="100" name="koncentrace" class="form-control">
        </div>

        <div class="mb-3">
            <label for="poznamka" class="form-label">Poznámka</label>
            <textarea name="poznamka" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Naplánovat</button>
    </form>
@endsection
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
    <form action="/radky/update" method="POST">
        @csrf
        <input type="hidden" name="id" value={{ $radek->id }}>
        <div class="mb-3">
            <label for="typ" class="form-label">Odrůda</label>
            <select name="odruda_enum" class="form-select" required>
                @foreach ($druhy as $k => $v)
                    <option value="{{ $k }}" {{ $radek->odruda_enum == $k ? "selected" : "" }}>{{ $v }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rok_vysadby" class="form-label">Rok výsadby</label>
            <input type="number" step="1" min="1850" max="2100" name="rok_vysadby" class="form-control" value={{ $radek->rok_vysadby }}>
        </div>

        <div class="mb-3">
            <label for="pocet_hlav" class="form-label">Počet hlav</label>
            <input type="number" step="1" min="0" name="pocet_hlav" class="form-control" value={{ $radek->pocet_hlav }}>
        </div>

        <button type="submit" class="btn btn-primary">{{ $radek->id ? "Aktualizovat" : "Vytvořit"}}</button>
    </form>
@endsection
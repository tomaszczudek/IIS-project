@extends('layouts.app')

@section('title', 'Vinarstvi Andrzej')

@section('content')
    <h1 class="mb-4">Seznam naplánovaných činností</h1>
    <form action="/osetreni/mark-done" method="POST">
        @csrf
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID řádku</th>
                    <th>Druh řádku</th>
                    <th>Datum</th>
                    <th>Operace</th>
                    <th>Stav</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($radky as $r)
                    <tr>
                        <td>{{ $r->radky_id }}</td>
                        <td>{{ $r->druh_text }}</td>
                        <td>{{ $r->datum }}</td>
                        <td>{{ $r->typ_text }}</td>
                        <td>{{ $r->stav_text }}</td>
                        <td>
                            <button type="submit" name="idDelete" value="{{ $r->id }}" class="btn btn-primary">
                                {{ $r->stav ? "Odstranit" : "Zrušit"}}
                            </button>
                        </td>
                        <td>
                            <button type="submit" name="idDetail" value="{{ $r->id }}" class="btn btn-primary">
                                Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
@endsection
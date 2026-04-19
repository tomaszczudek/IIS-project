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
    <form action="/radky/detail" method="POST">
        @csrf
        <button type="submit" name="id" value="{{ null }}" class="btn mt-3 mb-3 btn-primary">
            Evidovat nový řádek
        </button>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID řádku</th>
                    <th>Odrůda</th>
                    <th>Počet hlav</th>
                    <th>rok výsadby</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($radky as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->druh_text }}</td>
                        <td>{{ $r->pocet_hlav }}</td>
                        <td>{{ $r->rok_vysadby }}</td>
                        <td>
                            <button type="submit" name="id" value="{{ $r->id }}" class="btn btn-primary">
                                Upravit
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </form>
@endsection
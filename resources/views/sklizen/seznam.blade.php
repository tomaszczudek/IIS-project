@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <h1 class="mb-4">Seznam sklizní</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <h3 class="mb-3">Plánované sklizně</h3>
    @if ($osetreni->count() > 0)
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Číslo řádku</th>
                        <th>Odrůda</th>
                        <th>Plánovaný termín sklizně</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($osetreni as $o)
                        <tr>
                            <td style="width:10%; border:none;">{{ $o->radky_id }}</td>
                            <td style="width:25%; border:none;">
                                {{ \App\Http\Controllers\Controller::ODRUDA_TYP[$o->radky->odruda_enum] ?? 'Neznáma odrůda' }}
                            </td>
                            <td style="width:25%; border:none;">{{ $o->datum}}</td>
                           <td style="width:40%; border:none;">
                                <form action="/sklizen/create" method="POST" style="display: inline;">
                                    <input type="hidden" name="radky_id" value="{{ $o->radky_id }}">
                                    <input type="hidden" name="osetreni_id" value="{{ $o->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        Evidovat sklizeň
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info mb-4">
            Nejsou naplánované žádné sklizně.
        </div>
    @endif

    <h3 class="mb-3">Provedené sklizně</h3>
    @if ($sklizne->count() > 0)
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Datum sklizně</th>
                        <th>Hmotnost hroznů</th>
                        <th>Cukrnatost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sklizne as $s)
                        <tr onclick="window.location.href='/sklizen/detail-{{ $s->id }}'" style="cursor: pointer; border: none;">
                            <td style="width: 25%; border: none;">{{ $s->datum_sklizne->format('d. m. Y') }}</td>
                            <td style="width: 25%; border: none;">{{ $s->hmotnost_hroznu_kg }} kg</td>
                            <td style="width: 25%; border: none;">{{ $s->cukernatost_hroznu }}°</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Žádné sklizně zatím nejsou zaznamenány.
        </div>
    @endif
@endsection
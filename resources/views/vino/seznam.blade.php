@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')

    <h1 class="mb-4">Seznam vín</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($vina->count() > 0)
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Odrůda</th>
                        <th>Ročník</th>
                        <th>Cena/láhev</th>
                        <th>Dostupných</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vina as $v)
                        <tr onclick="window.location.href='/vino/detail-{{ $v->id }}'" style="cursor: pointer;">
                            <td style="border:none;">{{ App\Http\Controllers\Controller::ODRUDA_TYP[$v->odruda] ?? 'Neznámá odruda' }}</td>
                            <td style="border:none;">{{ $v->rocnik }}</td>
                            <td style="border:none;">{{ $v->cena }} Kč</td>
                            <td style="border:none;">{{ $v->pocet_zbylych_lahvi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Dosud nebyla vyrobena žádná vína. <a href="/sklizen/seznam">Začneme sklizní?</a>
        </div>
    @endif
@endsection
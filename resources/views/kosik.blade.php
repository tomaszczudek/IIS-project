@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <h1 class="mb-4">Nákupní košík</h1>

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

    @if (count($kosik) > 0)
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Víno</th>
                        <th>Cena za láhev</th>
                        <th>Počet lahví</th>
                        <th>Cena celkem</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $celkova_cena = 0;
                    @endphp
                    @foreach ($kosik as $polozka)
                        @php
                            $vino = \App\Models\VinoModel::find($polozka['vino_id']);
                            if ($vino) {
                                $cena_za_lahev = $vino->cena ?? 0;
                                $cena_celkem = $cena_za_lahev * $polozka['pocet'];
                                $celkova_cena += $cena_celkem;
                            }
                        @endphp
                        @if ($vino)
                            <tr>
                                <td onclick="window.location.href='/nabidka/detail-{{ $vino->id }}'" style="cursor: pointer;">{{ App\Http\Controllers\Controller::ODRUDA_TYP[$vino->odruda] ?? 'Neznámá odruda' }} ({{ $vino->rocnik }})</td>
                                <td>{{ number_format($cena_za_lahev, 2) }} Kč</td>
                                <td>
                                    <form action="/kosik/zmena" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="vino_id" value="{{ $vino->id }}">
                                        <div class="input-group input-group-sm" style="width: 160px;">
                                            <input type="number" name="pocet" value="{{ $polozka['pocet'] }}" min="1" class="form-control form-control-sm">
                                            <button class="btn btn-outline-primary btn-sm" type="submit" style="padding: 0.25rem 0.5rem;">Aktualizovat</button>
                                        </div>
                                    </form>
                                </td>
                                <td><strong>{{ number_format($cena_celkem, 2) }} Kč</strong></td>
                                <td>
                                    <form action="/kosik/odeber-{{ $vino->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit">Odebrat</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr style="background-color: #f8f9fa; font-weight: bold;">
                        <td colspan="3" class="text-end">Celková cena:</td>
                        <td colspan="2">{{ number_format($celkova_cena, 2) }} Kč</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="/nabidka/seznam" class="btn btn-secondary btn-lg">← Pokračovat v nákupu</a>
            </div>
            <div class="col-md-6 text-end">
                <form action="/kosik/vytvorit-nakup" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">Zakoupit →</button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <h5>Váš košík je prázdný</h5>
            <p>Začněte nákupem na <a href="/nabidka/seznam">Nabídka vín</a>.</p>
        </div>
    @endif
@endsection
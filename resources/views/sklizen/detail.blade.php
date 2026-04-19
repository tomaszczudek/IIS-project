@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/sklizen/seznam" class="btn btn-secondary">← Zpět na seznam sklizní</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <h1 class="mb-4">Detail sklizně</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informace o sklizni</h5>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Datum sklizně:</strong><br>
                        {{ $sklizen->datum_sklizne->format('d. m. Y') }}
                    </p>
                    <p>
                        <strong>Hmotnost hroznů:</strong><br>
                        {{ $sklizen->hmotnost_hroznu_kg }} kg
                    </p>
                    <p>
                        <strong>Dostupný počet litrů vína:</strong><br>
                        {{ number_format($sklizen->litry_vina, 2) }} l
                    </p>
                    <p>
                        <strong>Cukrnatost hroznů:</strong><br>
                        {{ $sklizen->cukernatost_hroznu }}°
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Vyrobená vína z této sklizně</h5>
                </div>
                <div class="card-body">
                    @if ($sklizen->vina->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Odrůda</th>
                                    <th>Ročník</th>
                                    <th>Alkohol</th>
                                    <th>Lahví</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sklizen->vina as $v)
                                    @if (in_array(Auth::User()->group, [\App\Enums\UserGroupEnum::WINEMAKER, \App\Enums\UserGroupEnum::ADMIN]))
                                        <tr onclick="window.location.href='/vino/detail-{{ $v->id }}'" style="cursor: pointer;">
                                    @else
                                        <tr>
                                            <td>{{ App\Http\Controllers\Controller::ODRUDA_TYP[$v->odruda] ?? 'Neznámá odruda' }}</td>
                                            <td>{{ $v->rocnik }}</td>
                                            <td>{{ $v->procento_alkoholu }}%</td>
                                            <td>{{ $v->pocet_vyrobenych_lahvi }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Z této sklizně dosud nejsou vyrobena žádná vína.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Akce</h5>
                </div>
                <div class="card-body">
                    <a href="/sklizen/edit-{{ $sklizen->id }}" class="btn btn-warning btn-lg w-100 mb-2">Upravit</a>
                    @if (in_array(Auth::User()->group, [\App\Enums\UserGroupEnum::WINEMAKER, \App\Enums\UserGroupEnum::ADMIN]))
                        <button class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#lahvovaniModal">Lahvovat</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lahvovaniModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lahvování vína</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="/vyroba/store" method="POST">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="sklizen_id" value="{{ $sklizen->id }}">
                        <input type="hidden" name="odruda_hroznu" value="{{ $sklizen->odruda_hroznu }}">
                        <intput type="hidden" name="rocnik" value="{{ $sklizen->datum_sklizne}}">

                        <div class="mb-3">
                            <label for="pocet_lahvi" class="form-label">Počet lahví</label>
                            <input type="number" class="form-control" id="pocet_lahvi" name="pocet_lahvi"
                                   placeholder="Kolik lahví chcete nalahvovat?" min="1" step="1" max="{{ (int)($sklizen->litry_vina/0.75) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="procento_alkoholu" class="form-label">Procento alkoholu (%)</label>
                            <input type="number" class="form-control" id="procento_alkoholu" name="procento_alkoholu"
                                    step="0.1" min="0" max="99" required>
                        </div>

                        <div class="mb-3">
                            <label for="cena" class="form-label">Cena za láhev (Kč)</label>
                            <input type="number" class="form-control" id="cena" name="cena"
                                    step="0.1" min="0" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                        <button type="submit" class="btn btn-success">Vytvořit vína</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

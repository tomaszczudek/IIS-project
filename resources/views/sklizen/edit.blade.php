@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/sklizen/seznam" class="btn btn-secondary">← Zpět na seznam sklizní</a>
    </div>

    <h1 class="mb-4">Úprava sklizně</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="/sklizen/update-{{ $sklizen->id }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="datum_sklizne" class="form-label">Datum sklizně</label>
                            <input type="date" class="form-control @error('datum_sklizne') is-invalid @enderror" 
                                   id="datum_sklizne" name="datum_sklizne" 
                                   value="{{ $sklizen->datum_sklizne->format('Y-m-d') }}" required>
                            @error('datum_sklizne')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hmotnost_hroznu_kg" class="form-label">Hmotnost hroznů (kg)</label>
                            <input type="number" step="0.01" class="form-control @error('hmotnost_hroznu_kg') is-invalid @enderror" 
                                   id="hmotnost_hroznu_kg" name="hmotnost_hroznu_kg" 
                                   value="{{ $sklizen->hmotnost_hroznu_kg }}" required>
                            @error('hmotnost_hroznu_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="litry_vina" class="form-label">Vyrobeno vína (l)</label>
                            <input type="number" step="0.01" class="form-control @error('litry_vina') is-invalid @enderror" 
                                   id="litry_vina" name="litry_vina" 
                                   value="{{ $sklizen->litry_vina }}" required>
                            @error('litry_vina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cukernatost_hroznu" class="form-label">Cukrnatost hroznů (°)</label>
                            <input type="number" step="0.1" class="form-control @error('cukernatost_hroznu') is-invalid @enderror" 
                                   id="cukernatost_hroznu" name="cukernatost_hroznu" 
                                   value="{{ $sklizen->cukernatost_hroznu }}" required>
                            @error('cukernatost_hroznu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">Aktualizovat sklizeň</button>
                            <a href="/sklizen/seznam" class="btn btn-secondary">Zrušit</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
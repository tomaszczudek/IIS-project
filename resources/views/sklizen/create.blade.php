@extends('layouts.app')

@section('title', 'Vinařství Andrzej')

@section('content')
    <div class="mb-4">
        <a href="/sklizen/seznam" class="btn btn-secondary">← Zpět na seznam</a>
    </div>

    <h1 class="mb-4">Nová sklizeň</h1>

    @if (session('failure'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failure') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Údaje sklizně</h5>
                </div>
                <div class="card-body">
                    <form id="sklizen-form" action="/sklizen/store" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="hmotnost_hroznu_kg" class="form-label">Hmotnost hroznů (kg)</label>
                            <input type="number" step="0.01" class="form-control @error('hmotnost_hroznu_kg') is-invalid @enderror" 
                                   id="hmotnost_hroznu_kg" name="hmotnost_hroznu_kg" required>
                            @error('hmotnost_hroznu_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="litry_vina" class="form-label">Litry vína</label>
                            <input type="number" step="0.01" class="form-control @error('litry_vina') is-invalid @enderror" 
                                   id="litry_vina" name="litry_vina" required>
                            @error('litry_vina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cukernatost_hroznu" class="form-label">Cukrnatost hroznů (°)</label>
                            <input type="number" step="0.1" class="form-control @error('cukernatost_hroznu') is-invalid @enderror" 
                                   id="cukernatost_hroznu" name="cukernatost_hroznu" required>
                            @error('cukernatost_hroznu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="radky_id" value="{{ $radky_id }}">
                        <input type="hidden" name="osetreni_id" value="{{ $osetreni_id }}">
                    </form>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" form="sklizen-form" class="btn btn-primary btn-lg">Vytvořit sklizeň</button>
                <a href="/sklizen/seznam" class="btn btn-secondary">Zrušit</a>
            </div>
        </div>
    </div>
@endsection
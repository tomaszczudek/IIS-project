@extends('layouts.app')

@section('title', 'Vinarstvi Andrzej')

@section('content')

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<h1 class="mb-4">Přihlášení</h1>

<div>
<form action="/processLogin" method="POST">
    @csrf
    <table>
    <tr>
    <td><label>Email</label></td>
    <td><input name="email" type="email" required autocomplete="email" placeholder="email@example.com"/></td>
    </tr>
    <tr>
    <td><label>Heslo</label></td>
    <td><input name="password" type="password" required autocomplete="current-password" placeholder="Heslo"/></td>
    </tr>
    <tr><td colspan="2"><input type="submit" value="Přihlásit se"/></td></tr>
    </table>
</form>
</div>
<a href="register"><div>Nemáte účet? Zaregistrovat se</div></a>
@endsection

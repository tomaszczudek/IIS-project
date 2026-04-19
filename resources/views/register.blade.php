@extends('layouts.app')

@section('title', 'Vinarstvi Andrzej')

@section('content')

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<h1 class="mb-4">Registrace</h1>
<form action="/processRegister" method="POST">
    @csrf
    <table>
    <tr>
    <td><label>Jméno</label></td>
    <td><input name="name" type="text" required placeholder="Jan Novák"/></td>
    </tr>
    <tr>
    <td><label>Email</label></td>
    <td><input name="email" type="email" required autocomplete="email" placeholder="E-mail"/></td>
    </tr>
    <tr>
    <td><label>Heslo</label></td>
    <td><input type="password" name="password" autocomplete="current-password" placeholder="Heslo" required/></td>
    </tr>
    <td><label>Heslo znovu</label></td>
    <td><input name="password_repeat" type="password" required autocomplete="current-password" placeholder="Heslo"/></td>
    </tr>
    <tr><td colspan="2"><input type="submit" value="Registrovat"></td></tr>
    </table>
</form>
<a href="login"><div>Máte účet? Přihlásit se</div></a>
@endsection

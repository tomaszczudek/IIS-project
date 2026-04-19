<div class="sidebar">
    <a href="/nakupy/seznam">Historie objednávek</a>
    <a href="/nabidka/seznam">Nabídka vín</a>
    @if (Auth::user() && (Auth::user()->isAdmin() || Auth::user()->group === \App\Enums\UserGroupEnum::WINEMAKER))
        <hr>
        <a href="/planovat">Plánování činností</a>
        <a href="/radky">Správa vinných řádků</a>
        <a href="/vino/seznam">Vína</a>
    @endif
    @if (Auth::user() && (Auth::user()->isAdmin() || Auth::user()->group === \App\Enums\UserGroupEnum::WORKER))
        <hr>
        <a href="/osetreni">Ošetření</a>
    @endif
    @if (Auth::user() && (Auth::user()->isAdmin() || in_array(Auth::user()->group,[\App\Enums\UserGroupEnum::WINEMAKER, \App\Enums\UserGroupEnum::WORKER])))
        <a href="/sklizen/seznam">Sklizně</a>
    @endif
    @if (Auth::user() && (Auth::user()->isAdmin()))
        <hr>
        <a href="/management">Správa uživatelů</a>
    @endif
</div>

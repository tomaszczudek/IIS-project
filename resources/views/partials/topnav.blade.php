<nav class="navbar navbar-light bg-light fixed-top shadow-sm px-3">
    <div class="w-100 d-flex justify-content-between align-items-center">
        <span class="navbar-brand mb-0 h1">
            <button onclick="window.location.href='/'" style="border:none; background:none; cursor:pointer;"><img src="/grapes.ico" width="25px">Vinařství Andrzej</button>
        </span>

        <div class="d-flex align-items-center gap-3">
            <a href="/kosik" class="btn btn-sm btn-outline-secondary">🛒 Košík</a>

            <div class="dropdown">
                @if (!Auth::user())
                    <a href="/login" class="btn btn-sm btn-outline-secondary">Přihlášení</a>
                @else
                    <a class="dropdown-toggle btn btn-sm btn-outline-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Odhlásit se</button>
                            </form>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
</nav>

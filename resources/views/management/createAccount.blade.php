<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Vytvořte uživatele</h5>
    </div>
    <div class="card-body">
        <form id="createAccountForm" action="processRegister" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Jméno</label>
                <input type="string" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" autocomplete="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Heslo</label>
                <input type="password" class="form-control" name="password" autocomplete="current-password" required>
            </div>

            <div class="mb-3">
                @foreach ($groups as $group)
                    <div class="form-check form-check-inline">
                    <label class="form-check-label">{{ $group->name() }}</label> <input class="form-check-input" name="group" type="radio" value="{{ $group }}" required>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Vytvořit uživatele
            </button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#createAccountForm").submit(function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: "POST",
            url: "adminRegister",
            data: form.serialize(),
            success: function (response) {
                location.reload(true);
            }
        });
    });
});
</script>

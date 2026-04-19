@extends('layouts.app')

@section('title', 'Vinarstvi Andrzej')

@section('content')
    <h1 class="mb-4">Správa uživatelů</h1>

    <div id="alert">
    </div>

    <a href="#" id="newUser"><div class="btn btn-primary">Nový uživatel</div></a>
    <button id="deactivateUser" class="btn btn-danger disabled">Deaktivovat vybrané uživatele</button>
    <button id="activateUser" class="btn btn-success disabled d-none">Aktivovat vybrané uživatele</button>

    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="modalContent">
            </div>
        </div>
    </div>

<nav class="mt-2">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-active-tab" data-bs-toggle="tab" data-bs-target="#nav-active" type="button" role="tab" aria-controls="nav-active" aria-selected="true">Aktivní</button>
        <button class="nav-link" id="nav-deactive-tab" data-bs-toggle="tab" data-bs-target="#nav-deactive" type="button" role="tab" aria-controls="nav-deactive" aria-selected="false">Deaktivovaní</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab">@include('management/userTable', ['active' => true, 'users' => $activeUsers])</div>
    <div class="tab-pane fade" id="nav-deactive" role="tabpanel" aria-labelledby="nav-deactive-tab">@include('management/userTable', ['active' => false, 'users' => $inactiveUsers])</div>
</div>

<script>
$(document).ready(function() {
    $("#newUser").on("click", function (e) {
        e.preventDefault();
        $.ajax({
            url: "createAccount",
            type: "GET",
            success: function (response) {
                $("#modalContent").html(response);
                $("#modal").modal("show");
            },
        });
    });

    $("#modal").on("hide.bs.modal hidden.bs.modal", function () {
        document.activeElement.blur();
    });

    $('.deleteCheckbox').on('click', function (e) {
        var checkbox = $(this).find('input');

        if (!$(e.target).is('input')) {
            checkbox.prop('checked', !checkbox.prop('checked')).change();
        }

        $(this).closest('tr').toggleClass('table-active', checkbox.prop('checked'));
    });

    $("#nav-home-tab").on('show.bs.tab', function() {
        $("#deactivateUser").toggleClass("d-none");
        $("#activateUser").toggleClass("d-none");
    });

    $("#nav-profile-tab").on('show.bs.tab', function() {
        $("#deactivateUser").toggleClass("d-none");
        $("#activateUser").toggleClass("d-none");
    });


});

$('.user-checkbox').on('change', function() {
    var checked = $('.user-checkbox:checked').length > 0;

    $("#deactivateUser").toggleClass("disabled", !checked);
    $("#activateUser").toggleClass("disabled", !checked);
});

$("#deactivateUser").on("click", function () {
    var ids = $(".user-checkbox:checked").map(function () {
        return $(this).val();
    }).get();

    $.ajax({
        url: "/user/deactivate",
        type: "POST",
        data: {
            user_ids: ids,
            _token: "{{ csrf_token() }}"
        },
        success: function (res) {
            location.reload();
        }
    });
});

$("#activateUser").on("click", function () {
    var ids = $(".user-checkbox:checked").map(function () {
        return $(this).val();
    }).get();

    $.ajax({
        url: "/user/activate",
        type: "POST",
        data: {
            user_ids: ids,
            _token: "{{ csrf_token() }}"
        },
        success: function (res) {
            location.reload();
        }
    });
});


$('.editable').on('click', function (e) {
    e.stopPropagation();
    if ($(this).hasClass('editing'))
        return;

    var oldValue = $(this).text().trim();
    $(this).addClass('editing').empty();

    var input = $('<input type="text" class="w-75">').val(oldValue).css({height: $(this).height()});
    $(this).append(input);
    input.focus().select();

    var cell = $(this);
    function sendText(save) {
        var newValue = save ? input.val().trim() : oldValue;
        cell.removeClass('editing').text(newValue);

        if (!save || newValue === oldValue)
            return;

        $.ajax({
            url: '/user/update',
            method: 'POST',
            data: {
                id: cell.closest('td').closest('tr').data('id'),
                field: cell.data('field'),
                value: newValue,
                _token: "{{ csrf_token() }}"
            },
            error: function () {
                alert("Chyba při ukládání!");
                cell.text(oldValue);
            }
        });
    }

    input.on('keydown', function (e) {
        if (e.key === 'Enter') {
            sendText(true);
        }

        if (e.key === 'Escape') {
            sendText(false);
        }
    });

    input.on('blur', function () {
        sendText(true);
    });
});

$('td .dropdown-item').on('click', function (e) {
    e.preventDefault();

    var originalText = $(this).closest('td').find('.group-value').text().trim();

    $(this).closest('td').find('.group-value').text($(this).text().trim());
    $.ajax({
        url: '/user/update',
        method: 'POST',
        data: {
            id: $(this).closest('td').closest('tr').data('id'),
            field: 'group',
            value: $(this).data('value'),
            _token: "{{ csrf_token() }}"
        },
        success: function () {
            alert(true);
        },
        error: function () {
            alert(false)
            display.text(originalText);
        }
    });
});

function alert(success) {
    if (success)
        $('#alert').append('<div class="alert alert-success alert-dismissible fade show" role="alert">Aktualizace proběhla úspěšně<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    else
        $('#alert').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">Aktualizace proběhla neúspěšně<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
}
</script>

@endsection

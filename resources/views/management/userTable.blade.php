<table id="userTable" class="table align-middle mt-2 table-hover">
    <thead>
    <tr>
        <th></th>
        <th class="col-md-1">ID</th>
        <th class="col-md-2">Jméno</th>
        <th class="col-md-3">E-mail</th>
        <th class="col-md-3" >Skupina</th>
        <th colspan="2" class="col-md-3" >Poslední změna</th>
    </tr>
    </thead>
    <tbody>
@foreach ( $users as $user )
    <tr data-id="{{ $user->id }}">
        <td {{ $user->email !== Config::get('app.admin_email') ? 'class=deleteCheckbox' : ""}}><input type="checkbox" name="user_ids[]" class="user-checkbox" value="{{ $user->id }}" {{ $user->email === Config::get('app.admin_email') ? 'disabled' : ""}}></td>
        <td>{{ $user->id }}</td>
        <td {{ $user->email !== Config::get('app.admin_email') ? 'class=editable' : ""}} data-field="name">{{ $user->name }}</td>
        <td {{ $user->email !== Config::get('app.admin_email') ? 'class=editable' : ""}} data-field="email">{{ $user->email }}</td>
        <td class="" data-field="group">
            <div class="group-value"  {{ $user->email !== Config::get('app.admin_email') ? 'type=button data-bs-toggle=dropdown' : ""}}>
                {{ $user->group->name() }}
            </div>
            <ul class="dropdown-menu">
                @foreach ($groups as $group)
                     <li><a class="dropdown-item" href="#" data-value="{{ $group }}">{{ $group->name() }}</a></li>
                @endforeach
            </ul>
        </td>
        <td>{{ $user->updated_at ?? $user->created_at }}</td>
        <td>@if ($active) <a href="logAs/{{ $user->id }}"><i class="bi bi-box-arrow-in-right"></i></a>@endif</td>
    </tr>
@endforeach
    </tbody>
</table>

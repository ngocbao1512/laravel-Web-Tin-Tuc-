<tr class="odd" data-id = "{{$user->id}}" role="row">
    <td class="dtr-control sorting_1" tabindex="0"></td>
    <td>{{$user->first_name." ".$user->middle_name." ".$user->last_name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->user_name}}</td>
    <td>
        @foreach ($user->roles as $role)
            {{ $role->name }} 
        @endforeach
    </td>
    <td>
    <button type="button" class="btn btn-primary"
    data-toggle="modal" 
    data-target="#modal-edit-user"
    data-userid = "{{$user->id}}"
    onclick="loadUserEdit(this)"
    >
        <span> <i class="fas fa-user-edit"></i></span>
    </button>
    <button class="btn btn-primary confirm-delete"  
        style="background-color: #50697f;"
        data-toggle="modal" 
        data-userid="{{$user->id}}"
        onclick="deleteUser(this);"
        >
        <i class="far fa-trash-alt tm-product-delete-icon"></i>
    </button>
    </td>
</tr>
<table class="table table-responsive" id="permissions-table">
    <thead>
        <tr>
            <th>Role Id</th>
        <th>Menu Id</th>
        <th>Can Access</th>
        <th>Can Visible</th>
        <th>Can Create</th>
        <th>Can Update</th>
        <th>Can Delete</th>
        <th>Can Show</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{!! $permission->role_id !!}</td>
            <td>{!! $permission->menu_id !!}</td>
            <td>{!! $permission->can_access !!}</td>
            <td>{!! $permission->can_visible !!}</td>
            <td>{!! $permission->can_create !!}</td>
            <td>{!! $permission->can_update !!}</td>
            <td>{!! $permission->can_delete !!}</td>
            <td>{!! $permission->can_show !!}</td>
            <td>
                {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('permissions.show', [$permission->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('permissions.edit', [$permission->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<table class="table table-responsive" id="menus-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Path</th>
        <th>Route Name</th>
        <th>Icon</th>
        <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($menus as $menu)
        <tr>
            <td>{!! $menu->name !!}</td>
            <td>{!! $menu->path !!}</td>
            <td>{!! $menu->route_name !!}</td>
            <td>{!! $menu->icon !!}</td>
            <td>{!! $menu->description !!}</td>
            <td>
                {!! Form::open(['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('menus.show', [$menu->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('menus.edit', [$menu->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
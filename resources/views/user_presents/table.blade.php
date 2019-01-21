<table class="table table-responsive" id="userPresents-table">
    <thead>
        <tr>
            <th>Present Id</th>
            <th>Present name</th>
            <th>Present date</th>
            <th>Room Id</th>
            <th>Room name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userPresents as $userPresent)
        <tr>
            <td>{!! $userPresent->present_id !!}</td>
            <td>{{  $userPresent->present->sequence->description}}</td>
            <td>{!! $userPresent->present->date !!}</td>
            <td>{!! $userPresent->room_id !!}</td>
            <td>{!! $userPresent->room->name !!}</td>
            <td>
                {!! Form::open(['route' => ['userPresents.destroy', $userPresent->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userPresents.show', [$userPresent->present_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {{-- <a href="{!! route('userPresents.edit', [$userPresent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
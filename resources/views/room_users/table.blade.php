<table class="table table-responsive" id="roomUsers-table">
    <thead>
        <tr>
            <th>User Id</th>
            <th>User Name</th>
            <th>Room Id</th>
            <th>Room Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roomUsers as $roomUser)
        <tr>
            <td>{!! $roomUser->user_id !!}</td>
            <td>{!! $roomUser->user->name_TH !!}</td>
            <td>{!! $roomUser->room_id !!}</td>
            <td>{!! $roomUser->room->name_TH !!}</td>
            <td>
                {!! Form::open(['route' => ['roomUsers.destroy', $roomUser->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('roomUsers.show', [$roomUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('roomUsers.edit', [$roomUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



@section('scripts')
<script>
$(document).ready( function () {
    $('#roomUsers-table').DataTable();
} );

</script>
@endsection
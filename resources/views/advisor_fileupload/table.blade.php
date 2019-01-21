<table class="table table-responsive" id="advisorUserPresents-table">
    <thead>
        <tr>
            <th>Room Id</th>
        <th>Room name</th>
        <th>Education year</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userAdvisors as $userAdvisors)
        <tr>
            <td>{!! $userAdvisors->room_id !!}</td>
            <td>{!! $userAdvisors->room->name !!}</td>
            <td>{!! $userAdvisors->room->year !!}</td>
            <td>
               
                <div class='btn-group'>
                    <a href="{!! route('advisorFileUploads.show', [$userAdvisors->room_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {{-- <a href="{!! route('advisorUserPresents.edit', [$advisorUserPresent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
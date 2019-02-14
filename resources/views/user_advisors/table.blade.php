
<table class="table table-responsive" id="userAdvisors-table">
    <thead>
        <tr>
            <th style="width:5%">Advisor Id</th>
            <th style="width:10%">ชื่อ</th>
            <th style="width:15%">นามสกุล</th>
            <th>อีเมล์</th>
            {{-- <th>Room Id</th> --}}
            <th>กลุ่มห้องจุลนิพนธ์</th>
            <th>ปีการศึกษา</th>
            {{-- <th class="text-center">Room Leader</th> --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userAdvisors as $userAdvisor)
        <tr>
            <td>{!! $userAdvisor->user_id !!}</td>
            <td>{!! $userAdvisor->user->name_TH !!}</td>
            <td>{!! $userAdvisor->user->surname_TH !!}</td>
            <td>{!! $userAdvisor->user->email !!}</td>
            {{-- <td>{!! $userAdvisor->room_id !!}</td> --}}
            <td>{!! $userAdvisor->room->name !!}</td>
            <td>{!! $userAdvisor->room->year !!}</td>
            {{-- <td class="text-center">{!! $userAdvisor->leader == 1 ? "<span class='label label-success'>Yes</span>" : "<span class='label label-info'>No</span>" !!}</td> --}}
            <td>
                {!! Form::open(['route' => ['userAdvisors.destroy', $userAdvisor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userAdvisors.show', [$userAdvisor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userAdvisors.edit', [$userAdvisor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
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
    $('#userAdvisors-table').DataTable();
} );

</script>
@endsection
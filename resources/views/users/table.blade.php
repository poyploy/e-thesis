<div style="overflow-x:auto;">
    <table class="table table-responsive" id="users-table">
    <thead>
        <tr><th>Id</th>
            <th>รหัสประจำตัวนักศึกษา</th>
            <th width="20%">ชื่อ</th>
            <th width="20%">นามสกุล</th>
            <th width="20%">อีเมล์</th>
            <th>ปีการศึกษา</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr><td>{!! $user->id !!}</td>
            <td>{!! $user->student_id !!}</td>
            <td>{!! $user->name_TH !!}</td>
            <td>{!! $user->surname_TH !!}</td>
            <td>{!! $user->email !!}</td>
          
            <td>{!! $user->year !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>



@section('scripts')
<script>
$(document).ready( function () {
    $('#users-table').DataTable();
} );

</script>
@endsection
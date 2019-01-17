<table class="table table-responsive" id="advisorsApproves-table">
    <thead>
        <tr>
            <th>Student Id</th>
            <th>Student Name</th>
            <th>Student Surname</th>
            <th>Student Education Year</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{!! $student->user->student_id !!}</td>
            <td>{!! $student->user->name_TH !!}</td>
            <td>{!! $student->user->surname_TH !!}</td>
            <td>{!! $student->user->year !!}</td>
            <td>
                {{-- {!! Form::open(['route' => ['advisorsApproves.destroy', $student->id], 'method' => 'delete']) !!} --}}
                <div class='btn-group'>
                    <a href="{!! route('advisorsApproves.show', [$student->user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('advisorsApproves.edit', [$student->user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                </div>
                {{-- {!! Form::close() !!} --}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
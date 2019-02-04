<table class="table table-responsive" id="assessments-table">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Assessment Score1</th>
            <th>Assessment Score2</th>
            <th>Assessment Score3</th>
            <th>Present Id</th>
            <th>Room Id</th>
            <th>Teacher Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($assessments as $assessment)
        <tr>
            <td>{!! $assessment->user_id !!}</td>
            <td>{!! $assessment->assessment_score1 !!}</td>
            <td>{!! $assessment->assessment_score2 !!}</td>
            <td>{!! $assessment->assessment_score3 !!}</td>
            <td>{!! $assessment->present_id !!}</td>
            <td>{!! $assessment->room_id !!}</td>
            <td>{!! $assessment->teacher_id !!}</td>
            <td>
                {!! Form::open(['route' => ['assessments.destroy', $assessment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('assessments.show', [$assessment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('assessments.edit', [$assessment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
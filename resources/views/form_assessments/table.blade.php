<table class="table table-responsive" id="formAssessments-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Max</th>
        <th>Sequence Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($formAssessments as $formAssessment)
        <tr>
            <td>{!! $formAssessment->title !!}</td>
            <td>{!! $formAssessment->max !!}</td>
            <td>{!! $formAssessment->sequence_id !!}</td>
            <td>
                {!! Form::open(['route' => ['formAssessments.destroy', $formAssessment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                        <a href="{!! route('formAssessments.detail', [$formAssessment->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-th-list"></i></a>
                    <a href="{!! route('formAssessments.show', [$formAssessment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('formAssessments.edit', [$formAssessment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
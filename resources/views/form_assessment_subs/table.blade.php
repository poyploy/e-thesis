<table class="table table-responsive" id="formAssessmentSubs-table">
    <thead>
        <tr>
            <th>Form Id</th>
        <th>Title</th>
        <th>Max</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($formAssessmentSubs as $formAssessmentSub)
        <tr>
            <td>{!! $formAssessmentSub->form_id !!}</td>
            <td>{!! $formAssessmentSub->title !!}</td>
            <td>{!! $formAssessmentSub->max !!}</td>
            <td>
                {!! Form::open(['route' => ['formAssessmentSubs.destroy', $formAssessmentSub->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('formAssessmentSubs.show', [$formAssessmentSub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('formAssessmentSubs.edit', [$formAssessmentSub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
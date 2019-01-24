<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Assessment Score1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assessment_score1', 'Assessment Score1:') !!}
    {!! Form::number('assessment_score1', null, ['class' => 'form-control']) !!}
</div>

<!-- Assessment Score2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assessment_score2', 'Assessment Score2:') !!}
    {!! Form::number('assessment_score2', null, ['class' => 'form-control']) !!}
</div>

<!-- Assessment Score3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assessment_score3', 'Assessment Score3:') !!}
    {!! Form::number('assessment_score3', null, ['class' => 'form-control']) !!}
</div>

<!-- Present Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('present_id', 'Present Id:') !!}
    {!! Form::number('present_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::number('room_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Teacher Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teacher_id', 'Teacher Id:') !!}
    {!! Form::number('teacher_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('assessments.index') !!}" class="btn btn-default">Cancel</a>
</div>

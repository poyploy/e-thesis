<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max', 'Max:') !!}
    {!! Form::number('max', null, ['class' => 'form-control']) !!}
</div>

<!-- Sequence Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sequence_id', 'Sequence Id:') !!}
    {!! Form::number('sequence_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('formAssessments.index') !!}" class="btn btn-default">Cancel</a>
</div>

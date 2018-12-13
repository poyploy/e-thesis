<!-- Year Field -->
@if(empty($sequence))
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Year:') !!}
    {!! Form::select('year', $years, null , ['class' => 'form-control select2']) !!}
</div>
@else
<div class="form-group col-sm-6">
        {!! Form::label('year', 'Year:') !!}
        {!! Form::select('year', $years, $sequence->year , ['class' => 'form-control select2']) !!}
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('presents.index') !!}" class="btn btn-default">Cancel</a>
</div>

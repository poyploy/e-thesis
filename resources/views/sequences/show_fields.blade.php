<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $sequence->id !!}</p>
</div>

<!-- Year Field -->
<div class="form-group">
    {!! Form::label('year', 'Year:') !!}
    <p>{!! $sequence->year !!}</p>
</div>

<!-- Date Time Field -->
<div class="form-group">
    {!! Form::label('date_time', 'Date Time:') !!}
    <p>{!! $sequence->date_time !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $sequence->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $sequence->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $sequence->deleted_at !!}</p>
</div>


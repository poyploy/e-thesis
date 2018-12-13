<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Year Field -->
@if(empty($sequence))
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Year:') !!}
    {!! Form::select('year', $years, null , ['class' => 'form-control select2']) !!}
</div>
@else
<div class="form-group col-sm-6">
        {!! Form::label('year', 'Year:') !!}
        {!! Form::select('year', $years, $room->year , ['class' => 'form-control select2']) !!}
    </div>
@endif

<!-- Num Field -->
<div class="form-group col-sm-6">
    {!! Form::label('num', 'Num:') !!}
    {!! Form::number('num', null, ['class' => 'form-control']) !!}
</div>

@if(empty($room))
<!-- Num Field -->
<div class="form-group col-sm-6">
        {!! Form::label('status', 'Num:') !!}
        {!! Form::select('status',[0=>'INACTIVE', 1 =>'ACTIVE'], null, ['class' => 'form-control']) !!}
    </div>
@else
<div class="form-group col-sm-6">
        {!! Form::label('status', 'Num:') !!}
        {!! Form::select('status',[0=>'INACTIVE', 1 =>'ACTIVE'], $room->status, ['class' => 'form-control']) !!}
    </div>
@endif

<!-- Max Student Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_student', 'Max Student:') !!}
    {!! Form::number('max_student', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('rooms.index') !!}" class="btn btn-default">Cancel</a>
</div>

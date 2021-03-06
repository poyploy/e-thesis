<!-- Present Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('present_id', 'Present Id:') !!}
    {!! Form::number('present_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::number('room_id', null, ['class' => 'form-control']) !!}
</div>

<!-- No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no', 'No:') !!}
    {!! Form::number('no', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userPresents.index') !!}" class="btn btn-default">Cancel</a>
</div>

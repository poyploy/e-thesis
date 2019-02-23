<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $room->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'กลุ่มห้องจุลนิพนธ์:') !!}
    <p>{!! $room->name !!}</p>
</div>

<!-- Num Field -->
{{-- <div class="form-group">
    {!! Form::label('num', 'Num:') !!}
    <p>{!! $room->num !!}</p>
</div> --}}

<!-- Max Student Field -->
<div class="form-group">
    {!! Form::label('max_student', 'จำนวนนักศึกษา:') !!}
    <p>{!! $room->max_student !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $room->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $room->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $room->deleted_at !!}</p>
</div>
@if(count($room->roomUsers)>0)
<div class="form-group">
        {!! Form::label('', 'รายชื่อนักศึกษา:') !!}
        @foreach($room->roomUsers as $user_room)
        <p>{!! $user_room->user->id !!} {!! $user_room->user->name_TH !!} {!! $user_room->user->surname_TH !!}</p>
        @endforeach
    </div>

@endif

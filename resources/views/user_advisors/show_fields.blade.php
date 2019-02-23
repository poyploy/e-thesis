<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $userAdvisor->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Advisor Id:') !!}
    <p>{!! $userAdvisor->user_id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name_TH', 'ชื่อ:') !!}
    <p>{!! $userAdvisor->user->name_TH !!}</p>
</div>

<!-- Surname Field -->
<div class="form-group">
    {!! Form::label('surname_TH', 'นามสกุล:') !!}
    <p>{!! $userAdvisor->user->surname_TH !!}</p>
</div>

<!-- Room Id Field -->
<div class="form-group">
    {!! Form::label('room_id', 'กลุ่มห้องจุลนิพนธ์:') !!}
    <p>{!! $userAdvisor->room->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $userAdvisor->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $userAdvisor->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $userAdvisor->deleted_at !!}</p>
</div>


<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name_TH', 'ชื่อ:') !!}
    <p>{!! $user->name_TH !!}</p>
</div>

<!-- Surname Field -->
<div class="form-group">
    {!! Form::label('surname_TH', 'นามสกุล:') !!}
    <p>{!! $user->surname_TH !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'อีเมล์:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', 'วัน-เวลา:') !!}
    <p>{!! $user->email_verified_at !!}</p>
</div>

<!-- Password Field -->
{{-- <div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{!! $user->password !!}</p>
</div> --}}

<!-- Remember Token Field -->
{{-- <div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{!! $user->remember_token !!}</p>
</div> --}}

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $user->created_at !!}</p>
</div>

@if($userRole->role_id == 2)
<div class="form-group">
    {!! Form::label('advisor_type', 'Advisor type:') !!}
    <p>{!! $user->advisor_type == 0 ? 'Permanent' : 'Temp' !!}</p>
</div>
@endif

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $user->updated_at !!}</p>
</div>


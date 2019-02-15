<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_TH', 'ชื่อ:') !!}
    {!! Form::text('name_TH', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'อีเมล์:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Verified At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::date('email_verified_at', null, ['class' => 'form-control']) !!}
</div>

@if($userRole->role_id == 2)
<div class="form-group col-sm-6">
    {!! Form::label('advisor', 'ประเภทบุคลากร') !!}
    {!! Form::select('advisor_type', [
        '0' => 'อาจารย์นอกคณะ',
        '1' => 'อาจารย์ในคณะ'
], $user->advisor_type , ['class' => 'form-control']) !!}
</div>
@endif

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>

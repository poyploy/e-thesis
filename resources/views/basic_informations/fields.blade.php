<!-- Thesis Title (Th) Field -->
{{-- {{ dd($basicInformation) }} --}}
@if($role->name == "STUDENT")
<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_id', 'Student Id:') !!}
    {{-- {{dd($enable)}} --}}
    {!! Form::text('student_id', $user->student_id, ['class' => 'form-control' , 'readonly'=>true]) !!}
</div>

<!-- Thesis Title (Th) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('thesistitle_TH', 'Thesis Title (TH):') !!}
    {!! Form::text('thesistitle_TH', $basicInformation->thesistitle_TH, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Thesis Title (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('thesistitle_EN', 'Thesis Title (EN):') !!}
    {!! Form::text('thesistitle_EN', $basicInformation->thesistitle_EN, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>
@endif


<!-- Name (Th) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_TH', 'Name (TH):') !!}
    {!! Form::text('name_TH', $user->name_TH, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Surname (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname_TH', 'Surname (TH):') !!}
    {!! Form::text('surname_TH', $user->surname_TH, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Name (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_EN', 'Name (EN):') !!}
    {!! Form::text('name_EN', $user->name_EN, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Surname (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname_EN', 'Surname (EN):') !!}
    {!! Form::text('surname_EN', $user->surname_EN, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tel', 'Tel:') !!}
    {!! Form::text('tel', $basicInformation->tel, ['class' => 'form-control', 'maxlength' => 10, 'readonly'=> $readonly]) !!}
</div>


{!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'disabled'=> $readonly]) !!}

</div>
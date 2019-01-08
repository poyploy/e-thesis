<!-- Thesis Title (Th) Field -->
{{-- {{ dd($basicInformation) }} --}}
<div class="form-group col-sm-6">
    {!! Form::label('thesistitle_TH', 'Thesis Title (Th):') !!}
    {!! Form::text('thesistitle_TH',  $basicInformation->thesistitle_TH, ['class' => 'form-control']) !!}
</div>

<!-- Thesis Title (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('thesistitle_EN', 'Thesis Title (En):') !!}
    {!! Form::text('thesistitle_EN', $basicInformation->thesistitle_EN, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
</div>

<!-- Surname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname', 'Surname:') !!}
    {!! Form::text('surname', $user->surname, ['class' => 'form-control']) !!}
</div>

<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_id', 'Student Id:') !!}
    {!! Form::text('student_id', $user->student_id, ['class' => 'form-control' , 'readonly'=>true]) !!}
</div>

<!-- Student Id Field -->
<div class="form-group col-sm-6">
        {!! Form::label('tel', 'Tel:') !!}
        {!! Form::text('tel', $basicInformation->tel, ['class' => 'form-control', 'maxlength' => 10]) !!}
    </div>
    

    {!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
   
</div>

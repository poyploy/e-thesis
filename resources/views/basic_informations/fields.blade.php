<!-- Thesis Title (Th) Field -->
{{-- {{ dd($basicInformation) }} --}}
@if($role->name == "STUDENT")
<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_id', 'รหัสประจำตัวนักศึกษา:') !!}
    {{-- {{dd($enable)}} --}}
    {!! Form::text('student_id', $user->student_id, ['class' => 'form-control' , 'readonly'=>true]) !!}
</div>

<!-- Thesis Title (Th) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('thesistitle_TH', 'หัวข้อจุลนิพนธ์ (ภาษาไทย):') !!}
    {!! Form::text('thesistitle_TH', $basicInformation->thesistitle_TH, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Thesis Title (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('thesistitle_EN', 'หัวข้อจุลนิพนธ์ (ภาษาอังกฤษ):') !!}
    {!! Form::text('thesistitle_EN', $basicInformation->thesistitle_EN, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>
@endif


<!-- Name (Th) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_TH', 'ชื่อ (ภาษาไทย):') !!}
    {!! Form::text('name_TH', $user->name_TH, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Surname (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname_TH', 'นามสกุล (ภาษาไทย):') !!}
    {!! Form::text('surname_TH', $user->surname_TH, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Name (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_EN', 'ชื่อ (ภาษาอังกฤษ):') !!}
    {!! Form::text('name_EN', $user->name_EN, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Surname (En) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname_EN', 'นามสกุล (ภาษาอังกฤษ):') !!}
    {!! Form::text('surname_EN', $user->surname_EN, ['class' => 'form-control', 'readonly'=> $readonly]) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tel', 'เบอร์โทรศัพท์:') !!}
    {!! Form::text('tel', $basicInformation->tel, ['class' => 'form-control', 'maxlength' => 10, 'readonly'=> $readonly]) !!}
</div>


{!! Form::hidden('user_id', $user->id, ['class' => 'form-control']) !!}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'disabled'=> $readonly]) !!}

</div>
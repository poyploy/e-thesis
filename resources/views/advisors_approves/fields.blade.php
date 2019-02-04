<!-- Advisor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('present_id', 'ครั้งที่นำเสนอ :') !!}
    {!! Form::select('present_id', $presents,null  ,['class' => 'form-control']) !!}
</div>

<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_number', 'รหัสประจำตัวนักศึกษา :') !!}
    {!! Form::number('student_number', $student->user->student_id, ['class' => 'form-control']) !!}
</div>

{{-- {{dd($student->user->name_TH)}} --}}

<!-- Student Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_name', 'ชื่อ-สกุล :') !!}
    {!! Form::text('student_name', $student->user->name_TH.' '.$student->user->surname_TH, ['class' => 'form-control']) !!}
</div>

<!-- Student Id Field -->
<div class="form-group col-sm-12">
        {!! Form::label('count', 'ครั้งที่เข้าพบ :') !!}
        {!! Form::radio('count',1, true) !!} ครั้งที่ 1
        {!! Form::radio('count',2, false) !!} ครั้งที่ 2
    </div>


{{-- <div class="clear-fix"></div> --}}
<!-- Remark Field -->
<div class="form-group col-sm-12">
    {!! Form::label('remark', 'คำอธิบาย :') !!}
    {!! Form::text('remark', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('advisorsApproves.index') !!}" class="btn btn-default">Cancel</a>
</div>

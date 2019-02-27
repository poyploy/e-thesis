<!-- Year Field -->
@if(empty($sequence))
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Year:') !!}
    {!! Form::select('year', $years, null , ['class' => 'form-control select2']) !!}
</div>
@else
<div class="form-group col-sm-6">
    {!! Form::label('year', 'ปีการศึกษา :') !!}
    {!! Form::select('year', $years, $sequence->year , ['class' => 'form-control select2']) !!}
</div>
@endif

@if(empty($sequence))
<div class="form-group col-sm-6">
    {!! Form::label('uploadfile_status', 'Year:') !!}
    {!! Form::select('uploadfile_status', [
    '0' => 'close',
    '1'=>'open'
    ], null, ['class' => 'form-control select2']) !!}
</div>
@else
<div class="form-group col-sm-6">
    {!! Form::label('uploadfile_status', 'ตั้งค่าสถานะ :') !!}
    {!! Form::select('uploadfile_status', [
    '0' => 'close',
    '1'=>'open'
    ], $sequence->uploadfile_status , ['class' => 'form-control select2']) !!}
</div>
@endif
<!-- Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'ครั้งที่นำเสนอ เทอม/ครั้ง :') !!}
    {!! Form::text('description', null , ['class' => 'form-control']) !!}
</div>

<!-- Date Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_time', 'วัน-เวลา :') !!}
    {!! Form::text('date_time', null, ['class' => 'form-control date-picker']) !!}
</div>


<!-- Date Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'วันที่เริ่มอัปโหลดไฟล์ :') !!}
    {!! Form::text('start_at', null, ['class' => 'form-control date-picker']) !!}
</div>



<!-- Date Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_at', 'วันสุดท้ายที่อัปโหลดไฟล์ :') !!}
    {!! Form::text('end_at', null, ['class' => 'form-control date-picker']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sequences.index') !!}" class="btn btn-default">Cancel</a>
</div>



@section('scripts')
<script>
    // In your Javascript (external .js resource or <script> tag)
    // $(document).ready(function() {
    //     $('#robots').select2();
    // });

    $(function () {
        $('.date-picker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
            // format: 'YYYY-MM-DD'
        });

        $('.select2').select2({
            placeholder: 'Select an option'
        });

    });
</script>
@endsection
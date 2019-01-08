
<!-- Sequence Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sequence_id', 'Present:') !!}
    {!! Form::select('sequence_id', $sequences,null, ['class' => 'form-control select2']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('file', 'File:') !!}
    {!! Form::file('file', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('uploadFiles.index') !!}" class="btn btn-default">Cancel</a>
</div>


@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2({
  placeholder: 'Select an option'
});
});
</script>
@endsection
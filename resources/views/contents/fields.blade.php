<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'หัวข้อ :') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'เรื่อง :') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'รายละเอียด :') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control wysiwyg']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', false) !!}
        {!! Form::checkbox('status', '1', null) !!} Active
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('contents.index') !!}" class="btn btn-default">Cancel</a>
</div>
@section('scripts')

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=yavuj23phcjly6eutc328bby19bw10lh9no8q07rig6v85ls"></script>
<script>
    tinymce.init({
        selector: 'textarea.wysiwyg',
        plugins: ["autolink searchreplace textcolor textpattern colorpicker table paste image imagetools legacyoutput contextmenu lists charmap code codesample link media anchor hr preview tabfocus template visualblocks"],
        toolbar: "undo redo | styleselect | bold italic forecolor backcolor | table | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code",
        table_grid: true,
        table_appearance_options: true,
        table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
    });
</script>

@endsection
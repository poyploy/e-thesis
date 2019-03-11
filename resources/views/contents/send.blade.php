@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        ส่งข้อความ
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::model($content, ['route' => [ 'contents.send.submit', $content->id ]]) !!}

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
               

                <!-- Body Field -->
                <div class="form-group col-sm-6 col-lg-6">
                    {!! Form::label('room_id', 'กลุ่มห้องจุลนิพนธ์ :') !!}
                    {!! Form::select('room_id', $rooms,null ,['class' => 'form-control select2']) !!}
                </div>

                
                <div class="form-group col-sm-2" style="padding-top:25px;">
                    {!! Form::label('send_to_student', 'ส่งถึงนักศึกษา :') !!}
                    {!! Form::checkbox('send_to_student', 'true', true) !!}
                </div>

                <div class="form-group col-sm-2" style="padding-top:25px;">
                    {!! Form::label('send_to_advisor', 'ส่งถึงอาจารย์ :') !!}
                    {!! Form::checkbox('send_to_advisor', 'true', true) !!}
                </div>

                {{-- <div class="form-group col-sm-12">
                    <div class="col-sm-6">
                        <h4 style="font-family: 'Kanit', sans-serif"> รายชื่อนักศึกษา </h4>   
                        <div class="row col-10">
                            @foreach( $students as $item)
                            <div class="col-md-3">
                                {{$item->user->name_TH}}
                            </div>
                            <div class="col-md-3">
                                {{$item->user->surname_TH}}
                            </div>
                            <div class="col-md-4">
                                {{$item->user->email}}
                            </div>
                            @endforeach
                        </div>
                        
                    </div> --}}



                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Sand', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('contents.index') !!}" class="btn btn-default">Cancel</a>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script
    src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=yavuj23phcjly6eutc328bby19bw10lh9no8q07rig6v85ls"></script>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    });
</script>

@endsection
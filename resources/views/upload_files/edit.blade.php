@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Upload File
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($uploadFile, ['route' => ['uploadFiles.update', $uploadFile->id], 'method' => 'patch']) !!}

                        @include('upload_files.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Form Assessment Sub
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($formAssessmentSub, ['route' => ['formAssessments.detail.updateStore', $formAssessment->id,$formAssessmentSub->id], 'method' => 'post']) !!}

        {!! Form::hidden('form_id', null, ['class' => 'form-control']) !!}
   
    
    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    
    <!-- Max Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('max', 'Max:') !!}
        {!! Form::number('max', null, ['class' => 'form-control']) !!}
    </div>
    
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       
    </div>
    
                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
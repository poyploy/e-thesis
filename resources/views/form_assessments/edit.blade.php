@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Form Assessment
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($formAssessment, ['route' => ['formAssessments.update', $formAssessment->id], 'method' => 'patch']) !!}

                        @include('form_assessments.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
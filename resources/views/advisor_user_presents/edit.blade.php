@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Advisor User Present
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($advisorUserPresent, ['route' => ['advisorUserPresents.update', $advisorUserPresent->id], 'method' => 'patch']) !!}

                        @include('advisor_user_presents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
@include('flash::message')
    <section class="content-header">
        <h1>
            Basic Information
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                    {!! Form::open(['route' => 'basicInformations.update', 'method' => 'put']) !!}

                        @include('basic_informations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
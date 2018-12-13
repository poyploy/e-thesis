@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Present
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($present, ['route' => ['presents.update', $present->id], 'method' => 'patch']) !!}

                        @include('presents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
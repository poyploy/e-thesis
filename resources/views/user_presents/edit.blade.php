@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Present
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userPresent, ['route' => ['userPresents.update', $userPresent->id], 'method' => 'patch']) !!}

                        @include('user_presents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
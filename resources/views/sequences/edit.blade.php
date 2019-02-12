@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 style="font-family: 'Kanit', sans-serif;">
            แก้ไขข้อมูล
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sequence, ['route' => ['sequences.update', $sequence->id], 'method' => 'patch']) !!}

                        @include('sequences.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
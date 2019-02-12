@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            ส่งการแจ้งเตือน
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($room, ['route' => ['rooms.update', $room->id], 'method' => 'patch']) !!}

                        @include('rooms.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
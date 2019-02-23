@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 style="font-family: 'Kanit', sans-serif;">
            แก้ไขกลุ่มห้องจุลนิพนธ์
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
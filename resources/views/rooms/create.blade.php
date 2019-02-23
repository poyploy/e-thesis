@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 style="font-family: 'Kanit', sans-serif;">
            เพิ่มกลุ่มห้องจุลนิพนธ์
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'rooms.store']) !!}

                        @include('rooms.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

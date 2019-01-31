@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Room
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => ['rooms.email.send', $room->id]]) !!}

                    <div class="form-group col-sm-6">
                        {!! Form::label('content_id', 'Content:') !!}
                        {!! Form::select('content_id', $contents, null , ['class' => 'select2 form-control select2']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                    <input type="hidden" name="room_id" value="{{$room->id}}">
                        {!! Form::label('name', 'Room Name:') !!}
                        {!! Form::text('name', $room->name, ['class' => 'form-control' ,'readonly' => true]) !!}
                    </div>

                    <div class="form-group col-sm-12">
                        <div class="col-sm-6">
                            <h4> Student list </h4>
                            @foreach( $students as $item)
                        <p>{{ $item->user->name_TH.' '.$item->user->surname_TH }} {{ $item->user->email }}</p>
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            <h4> Advisor list </h4>
                            @foreach( $advisors as $item)
                            <p>{{ $item->user->name_TH.' '.$item->user->surname_TH }} {{ $item->user->email }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <button type="submit" class="btn ">Send</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    });
    </script>
@endsection
@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        ส่งข้อความ
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => ['rooms.email.send', $room->id]]) !!}

                <div class="form-group col-sm-6">
                    {!! Form::label('content_id', 'หัวข้อในการส่ง :') !!}
                    {!! Form::select('content_id', $contents, null , ['class' => 'select2 form-control select2']) !!}
                </div>

                <div class="form-group col-sm-6">
                    <input type="hidden" name="room_id" value="{{$room->id}}">
                    {!! Form::label('name', 'กลุ่มห้องจุลนิพนธ์:') !!}
                    {!! Form::text('name', $room->name, ['class' => 'form-control' ,'readonly' => true]) !!}
                </div>

                <div class="form-group col-sm-12">
                    <div class="col-sm-6">
                        <h4 style="font-family: 'Kanit', sans-serif"> รายชื่อนักศึกษา </h4>   
                        <div class="row col-10">
                            @foreach( $students as $item)
                            <div class="col-md-3">
                                {{$item->user->name_TH}}
                            </div>
                            <div class="col-md-3">
                                {{$item->user->surname_TH}}
                            </div>
                            <div class="col-md-4">
                                {{$item->user->email}}
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    {{-- <p>{{ $item->user->name_TH.' '.$item->user->surname_TH }} {{ $item->user->email }}</p> --}}

                    <div class="col-sm-6">
                        <h4 style="font-family: 'Kanit', sans-serif;"> รายชื่ออาจารย์ </h4>
                        <div class="row col-12">
                            @foreach( $advisors as $item)
                            <div class="col-md-3">
                                {{$item->user->name_TH}}
                            </div>
                            <div class="col-md-3">
                                {{$item->user->surname_TH}}
                            </div>
                            <div class="col-md-6">
                                {{$item->user->email}}
                            </div>
                            @endforeach
                        </div>
                        {{-- <p>{{ $item->user->name_TH.' '.$item->user->surname_TH }} &nbsp; {{ $item->user->email }}
                        </p> --}}
                    </div>
                </div>

                <div class="form-group col-sm-6">
                        {!! Form::label('send_to_student', 'ส่งถึงนักศึกษา :') !!}
                        {!! Form::checkbox('send_to_student', 'true', true) !!}
                </div>

                <div class="form-group col-sm-6">
                        {!! Form::label('send_to_advisor', 'ส่งถึงอาจารย์ :') !!}
                        {!! Form::checkbox('send_to_advisor', 'true', true) !!}
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
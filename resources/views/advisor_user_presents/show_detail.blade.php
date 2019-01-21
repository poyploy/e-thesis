@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        User Present
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                {{-- @include('user_presents.show_fields')
                <a href="{!! route('userPresents.index') !!}" class="btn btn-default">Back</a> --}}
                <table class="table table-responsive" id="userPresents-table">
                    <thead>
                        <tr>
                            <th>Present number</th>
                            <th>Present Id</th>
                            <th>Present name</th>
                            <th>Room Id</th>
                            <th>Room name</th>
                            <th>Student id</th>
                            <th>Student name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userPresents as $userPresent)
                        <tr>
                            <td>{!! $userPresent->no !!}</td>
                            <td>{!! $userPresent->present_id !!}</td>
                            <td>{{ $userPresent->present->sequence->description}}</td>
                            <td>{!! $userPresent->room_id !!}</td>
                            <td>{!! $userPresent->room->name !!}</td>
                            <td>{!! $userPresent->user->student_id !!}</td>
                            <td>{!! $userPresent->user->name_TH.' '.$userPresent->user->surname_TH !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{!! route('advisorUserPresents.show',[$roomId]) !!}" class="btn btn-default">Back</a>

            </div>
        </div>
    </div>
</div>
@endsection
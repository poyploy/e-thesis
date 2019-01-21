@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Users
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    {{-- presents --}}
                    <table class="table table-responsive" id="advisorUserPresents-table">
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Name</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roomUsers as $roomUser)
                                <tr>
                                    <td>{!! $roomUser->id !!}</td>
                                    <td>{!! $roomUser->room->name !!}</td>
                                    <td>{!! $roomUser->user->student_id !!}</td>
                                    <td>{!! $roomUser->user->name_TH.' '.  $roomUser->user->surname_TH!!}</td>  
                                    <td>
                                        <div class='btn-group'>
                                            <a href="{!! route('advisorFileUploads.showDetail', [$roomUser->user_id, $roomUser->room_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                            {{-- <a href="{!! route('advisorUserPresents.edit', [$advisorUserPresent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{-- @include('advisor_user_presents.show_fields') --}}
                    <a href="{!! route('advisorFileUploads.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

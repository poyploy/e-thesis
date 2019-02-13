@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        ลำดับการนำเสนอ
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
                            <th>ลำดับการนำเสนอ</th>
                            {{-- <th>รหัส</th> --}}
                            <th>การนำเสนอ เทอม-ครั้งที่</th>
                            {{-- <th>รหัสห้อง</th> --}}
                            <th>ห้องจุลนิพนธ์</th>
                            <th>รหัสประจำตัวนักศึกษา</th>
                            <th>รายชื่อนักศึกษา</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userPresents as $userPresent)
                        <tr>
                            <td>{!! $userPresent->no !!}</td>
                            {{-- <td>{!! $userPresent->present_id !!}</td> --}}
                            <td>{{ $userPresent->present->sequence->description}}</td>
                            {{-- <td>{!! $userPresent->room_id !!}</td> --}}
                            <td>{!! $userPresent->room->name !!}</td>
                            <td>{!! $userPresent->user->student_id !!}</td>
                            <td>{!! $userPresent->user->name_TH.' '.$userPresent->user->surname_TH !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{!! route('userPresents.index') !!}" class="btn btn-default">Back</a>

            </div>
        </div>
    </div>
</div>
@endsection
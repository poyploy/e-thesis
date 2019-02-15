@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        การเปลี่ยนกลุ่มห้องจุลนิพนธ์ (นักศึกษา)
    </h1>
</section>

<div class="content">
    @include('adminlte-templates::common.errors')

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::model($room, ['id' => 'room-manual-form' , 'route' => ['rooms.saveManual', $room->id],
                'method' => 'put']) !!}

                @include('rooms.fields_manual')

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body">
            <h3 style="font-family: 'Kanit', sans-serif;">รายชื่อนักศึกษา</h3>
                {!! Form::label('room', 'กลุ่มห้องจุลนิพนธ์ :') !!} {{$room->name}}<br>
            <div class="row">
                <table class="table table-responsive" id="users-room-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>อีเมล์</th>
                            <th>ปีการศึกษา</th>
                            <th>ลบ<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userRooms as $item)
                        <tr>
                            <td>{!! $item->user->id !!}</td>
                            <td>{!! $item->user->name_TH !!}</td>
                            <td>{!! $item->user->surname_TH !!}</td>
                            <td>{!! $item->user->email !!}</td>
                            <td>{!! $item->user->year !!}</td>
                            <td>
                                {!! Form::open(['route' => ['rooms.destroy.user', $room->id, $item->user->id], 'method' => 'delete']) !!} 
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!} 
                            </td>        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
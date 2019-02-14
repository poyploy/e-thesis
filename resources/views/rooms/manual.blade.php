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
                {!! Form::model($room, ['id' => 'room-manual-form' , 'route' => ['rooms.saveManual', $room->id],
                'method' => 'put']) !!}

                @include('rooms.fields_manual')

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body">
            <h3>Student in room</h3>
            <div class="row">
                <table class="table table-responsive" id="users-room-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Year</th>
                            <th>#<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userRooms as $item)
                        <tr>
                            <td>{!! $item->user->id !!}</td>
                            <td>{!! $item->user->name_TH !!}</td>
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
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Advisor User Present
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
                                    <th>Present Id</th>
                                    <th>Present name</th>
                                    <th>Room ID</th>
                                    <th>Room Name</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($presents as $present)
                                <tr>
                                    <td>{!! $present->id !!}</td>
                                    <td>{!! $present->date !!}</td>
                                    <td>{!! $present->id !!}</td>
                                    <td>{!! $present->room->name !!}</td>
                                    <td>
                                        <div class='btn-group'>
                                            <a href="{!! route('advisorUserPresents.showDetail', [$present->id, $present->room_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                            {{-- <a href="{!! route('advisorUserPresents.edit', [$advisorUserPresent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{-- @include('advisor_user_presents.show_fields') --}}
                    <a href="{!! route('advisorUserPresents.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

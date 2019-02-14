@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left" style="font-family: 'Kanit', sans-serif;">รายชื่ออาจารย์</h1>
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('userAdvisors.create') !!}">Add
            New</a>
    </h1>
</section>

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>


    <div class="box box-primary">
        @if(!empty($room))
        <section class="content-header">
            <h4 class="pull-left" style="font-family: 'Kanit', sans-serif;">ห้องจุลนิพนธ์ : <b>{{ $room->name }}</b></h5>
        </section>
        @endif
        <br>
        <br>
        <div class="box-body">
                <table class="table table-responsive" id="userAdvisors-table">
                        <thead>
                            <tr>
                                <th>Advisor Id</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                                <th>อีเมล์</th>
                                {{-- <th>Room Id</th> --}}
                                <th>ห้องจุลนิพนธ์</th>
                                <th>ปีการศึกษา</th>
                            <th class="text-center">สถานะเช็คชื่อ</th>
                            <th class="text-center">สถานะการจ่ายเงิน</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($userAdvisors as $userAdvisor)
                            <tr>
                                <td>{!! $userAdvisor->user_id !!}</td>
                                <td>{!! $userAdvisor->user->name_TH !!}</td>
                                <td>{!! $userAdvisor->user->surname_TH !!}</td>
                                <td>{!! $userAdvisor->user->email !!}</td>
                                {{-- <td>{!! $userAdvisor->room_id !!}</td> --}}
                                <td>{!! $userAdvisor->room->name !!}</td>
                                <td>{!! $userAdvisor->room->year !!}</td>
                                <td class="text-center">{!! $userAdvisor->check->check_status == 1 ? "<span class='label label-success'>Yes</span>" : "<span class='label label-info'>No</span>" !!}</td>
                                <td class="text-center">{!! $userAdvisor->check->pay_status == 1 ? "<span class='label label-success'>Yes</span>" : "<span class='label label-info'>No</span>" !!}</td>
                                <td>
                                    <div class='btn-group'>
                                        @if($userAdvisor->check->check_status == 1 &&  $userAdvisor->check->pay_status !=1 )
                                            <a href="{!! route('presents.advisor.paid', [$room->id,$present,$userAdvisor->check->id]) !!}" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-usd"></i></a>
                                            @endif
                                            @if($userAdvisor->check->check_status == 1 &&  $userAdvisor->check->pay_status ==1 )
                                            <a href="#" class='btn btn-default btn-xs disabled' disabled><i class="glyphicon glyphicon-usd "></i></a>
                                            @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
    <div class="text-center">

    </div>
</div>
@endsection


@section('scripts')
<script>
$(document).ready( function () {
    $('#userAdvisors-table').DataTable();
} );

</script>
@endsection
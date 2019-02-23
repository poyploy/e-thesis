@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left" style="font-family: 'Kanit', sans-serif;">รายชื่ออาจารย์</h1><br>
    <h1 class="pull-right">
        {{-- <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('userAdvisors.create') !!}">Add
            New</a> --}}
    </h1>
</section>

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        @if(!empty($room))
        <section class="content-header">
            <h4 class="pull-left" style="font-family: 'Kanit', sans-serif;">กลุ่มห้องจุลนิพนธ์ : <b>{{ $room->name }}</b></h4><br><br>
        </section>
        @endif
        <div class="box-body">
            @include('user_advisors.table')
        </div>
    </div>
    <div class="text-center">

    </div>
</div>
@endsection
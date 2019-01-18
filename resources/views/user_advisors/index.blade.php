@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">รายชื่ออาจารย์ทั้งหมด</h1>
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
            <h5 class="pull-left">room name : <b>{{ $room->name }}</b></h5>
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
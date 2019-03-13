@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        สรุปคะแนนเฉลี่ย
    </h1>
</section>
<div class="content">

    @include('flash::message')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                    {{-- {{dd($average)}} --}}
                    <table class="table table-responsive" id="userPresents-table">
                        <thead>
                                <tr>
                                    <th>รหัสประจำตัวนักศึกษา</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>สรุปคะแนน</th>
                                </tr>
                            </thead>
                           
                    </table>

            </div>
        </div>
    </div>
</div>
@endsection
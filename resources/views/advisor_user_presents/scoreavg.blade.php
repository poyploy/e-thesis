@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        สรุปคะแนนเฉลี่ย
    </h1>
</section>
<div class="content">

    @include('flash::message')
    <div class="box box-primary" style="padding: 10px 10px 0 10px; ">
            <h4 style="font-family: 'Kanit', sans-serif;">{!! Form::label('user', 'ชื่อ-สกุล :') !!} {{$user->name_TH}} {{$user->surname_TH}} </h4>
            <h4 style="font-family: 'Kanit', sans-serif;">{!! Form::label('studentId', 'รหัสประจำตัวนักศึกษา :') !!} {{$user->student_id}}</h4>
            <h4 style="font-family: 'Kanit', sans-serif;">{!! Form::label('teacherlist', 'รายชื่ออาจารย์ที่ทำการประเมิน') !!}</h4>
        <div class="box-body" >
            <div class="row">
                    {{-- {{dd($average)}} --}}
                    {{-- {{ dd($groupteacher , $summary)}} --}}
                    
                    <table class="table table-responsive" id="formAssessments-table">
                        <thead>
                            <td style="color:DodgerBlue;">1. {{$teacher->name_TH}} {{ $teacher->surname_TH }}</td>
                            <tr>
                                
                                {{-- <th>ครั้งที่นำเสนอ</th> --}}
                                {{-- <th>รายชื่ออาจารย์ที่ทำการประเมิน</th> --}}
                                <th>หัวข้อในการตรวจ</th>
                                <th>คะแนน</th>
                                {{-- <th colspan="3">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupteacher as $teacher)

                            @php
                            $totalpoint = 0;
                            $sumpoint = 0;
                            // $sum=0;
                            @endphp

                            @foreach ($teacher as $key => $item)
                            <tr>
                                {{-- {{dd($item->teacher->name_TH)}} --}}
                                {{-- <td>{!! $item->sequence_id !!}</td> teacher--}}
                            <td>
                                    @if($item->form_id == 1)
                                    เอกสารจุลนิพนธ์ บทที่ 1  
                                    @elseif ($item->form_id == 2)
                                    เอกสารจุลนิพนธ์ บทที่ 2 (ถ้ามีการนำเสนอ)  
                                    @elseif ($item->form_id == 3)
                                    เอกสารจุลนิพนธ์ บทที่ 3 (ถ้ามีการนำเสนอ) 
                                    @else 
                                    การนำเสนอและการตอบข้อซักถาม  
                                    @endif

                            </td>
                            <td>{!! $item->assessment_score1 !!} </td>
                            <td></td>
                            </tr>


                            
                             @php
                            // $totalpoint += $item->max;
                            $totalpoint += $item->assessment_score1;
                            @endphp
                            {{-- Total:  {{$totalpoint}} <br> --}}

                            @php
                                $sumpoint = $totalpoint;
                            @endphp

                            @endforeach

                            @php 
                                $sumpoint = $totalpoint;
                                
                            @endphp

                            {{-- sumpoint: {{$sumpoint}}<br> --}}
                            <tr>
                            <td colspan="2" class="text-right"><b>คะแนนรวม</b> : {{$totalpoint}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                   
                    {{-- <table class="table table-responsive" id="userPresents-table">
                        <thead>
                                <tr>
                                    <th>รหัสประจำตัวนักศึกษา</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>สรุปคะแนน</th>
                                </tr>
                            </thead>
                           
                    </table> --}}
                  
                    {{-- <a href="{!! route('advisorUserPresents.showDetail',[$roomId]) !!}" class="btn btn-default">Back</a> --}}

            </div>
        </div>
    </div>

    <div class="box box-primary" style="padding: 10px 10px 0 10px; ">
        <div class="box-body" >
                <table class="table table-responsive" id="formAssessments-table">
                        <thead>
                            <td style="color:DodgerBlue;"></td>
                            <tr>
                                
                                {{-- <th>ครั้งที่นำเสนอ</th> --}}
                                {{-- <th>รายชื่ออาจารย์ที่ทำการประเมิน</th> --}}
                                <th>หัวข้อในการตรวจ</th>
                                <th>คะแนน</th>
                                {{-- <th colspan="3">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sum = 0.00;
                            @endphp
                            @foreach($summary as $sum)
                           
                            <tr>
                            <td>
                                @if($sum->form_id == 1)
                                เอกสารจุลนิพนธ์ บทที่ 1    คะแนนเฉลี่ย 
                                @elseif ($sum->form_id == 2)
                                เอกสารจุลนิพนธ์ บทที่ 2 (ถ้ามีการนำเสนอ)   คะแนนเฉลี่ย 
                                @elseif ($sum->form_id == 3)
                                เอกสารจุลนิพนธ์ บทที่ 3 (ถ้ามีการนำเสนอ)   คะแนนเฉลี่ย 
                                @else 
                                การนำเสนอและการตอบข้อซักถาม   คะแนนเฉลี่ย 
                                @endif

                            </td>
                            <td>{{$sum->avg_score}}</td>
                            <td></td>
                            </tr>
                            {{-- Total:  {{$totalpoint}} <br> --}}

                            @php
                                $sum += $sum->avg_score;
                            @endphp

                            @endforeach
                            <tr>
                            <td colspan="2" class="text-right"><b>คะแนนรวม</b> : {{$sum}}</td>
                            </tr>
                         
                        </tbody>
                    </table>
        </div>
    </div>
</div>
@endsection
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
        <h4 style="font-family: 'Kanit', sans-serif;">{!! Form::label('user', 'ชื่อ-สกุล :') !!} {{$user->name_TH}}
            {{$user->surname_TH}} </h4>
        <h4 style="font-family: 'Kanit', sans-serif;">{!! Form::label('studentId', 'รหัสประจำตัวนักศึกษา :') !!}
            {{$user->student_id}}</h4>
        <div class="box-body">
            <div class="row">
                <table class="table table-responsive" id="formAssessments-table">
                    <thead>
                        <td style="color:DodgerBlue;">รายชื่ออาจารย์ที่ทำการประเมิน</td>
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
                        $userTeacher = "";
                        $userTeacherSur = "";
                        // $sum=0;
                        @endphp

                        @foreach ($teacher as $key => $item)
                {{-- {{dd($auth->id)}} --}}
                        @if ($item->teacher_id == $auth->id)
                            
                        
                        <tr>
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
                        @endif
                        @php
                        // $totalpoint += $item->max;
                        $totalpoint += $item->assessment_score1;
                        @endphp

                        @php
                        $sumpoint = $totalpoint;
                        $nameT = $item->teacher->name_TH;
                        $surT = $item->teacher->surname_TH;
                        @endphp
                       
                        @endforeach

                        @php
                        $sumpoint = $totalpoint;
                        @endphp

                        <tr>
                            <td colspan="2" class="text-right"><b>คะแนนรวม</b> : {{$totalpoint}} <br><br>
                                 <b>ชื่อ-สกุล
                                :</b> {{$auth->name_TH}} {{$auth->surname_TH}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="box box-primary" style="padding: 10px 10px 0 10px; ">
        <div class="box-body">
            <table class="table table-responsive" id="formAssessments-table">
                <thead>
                    <td style="color:DodgerBlue;">สรุปคะแนนเฉลี่ยโดยรวม</td>
                    <tr>
                        <th>หัวข้อในการตรวจ</th>
                        <th>คะแนนเฉลี่ย</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalsum = 0.00;
                    @endphp
                    {{-- {{dd($sum)}} --}}
                    @foreach($summary as $sum)
                    <tr>
                        <td>
                            @if($sum->form_id == 1)
                            เอกสารจุลนิพนธ์ บทที่ 1
                            @elseif ($sum->form_id == 2)
                            เอกสารจุลนิพนธ์ บทที่ 2 (ถ้ามีการนำเสนอ)
                            @elseif ($sum->form_id == 3)
                            เอกสารจุลนิพนธ์ บทที่ 3 (ถ้ามีการนำเสนอ)
                            @else
                            การนำเสนอและการตอบข้อซักถาม
                            @endif

                        </td>
                        <td>{{$sum->avg_score}}</td>
                        <td></td>
                    </tr>

                    @php
                    $totalsum += $sum->avg_score;
                    @endphp

                    @endforeach
                    <tr>
                        <td colspan="2" class="text-right"><b>คะแนนเฉลี่ยรวมทั้งหมด</b> : {{$totalsum}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{!! route('advisorUserPresents.index') !!}" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
@endsection
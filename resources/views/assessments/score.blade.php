@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        ประเมินการนำเสนอ
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => 'assessments.update.score', 'id' => 'myform']) !!}

                @if(!empty($form))
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>หัวข้อในการตรวจ</td>
                                <td>คะแนนเต็ม</td>
                                <td>ให้คะแนน</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalpoint = 0;
                            @endphp
                            @foreach ($form as $key => $item)
                            @php
                                 $totalpoint += $item->max;
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    {{$item->title}}
                                    @if($item->formAssessmentSubs->count()> 0)
                                        @foreach($item->formAssessmentSubs as $sub)
                                            <p style="margin-left:20px;"> - {{ $sub->title }} ({{ $sub->max}})</p>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$item->max}}</td>
                                <td>
                                    
                                @if (!empty($assessments))
                                    <input type="hidden" name="form_keys[{{  $assessments[$item->id]->first()->id }}]" value="{{$item->id}}">
                                    {!! Form::number('form_value['.$item->id.']', $assessments[$item->id]->first()->assessment_score1, ['class' => 'form-control','max' => $item->max, 'required' => true]) !!}
                                @else
                                    <input type="hidden" name="form_keys[]" value="{{$item->id}}">
                                    {!! Form::number('form_value['.$item->id.']', null, ['class' => 'form-control','max' => $item->max]) !!}
                                @endif
                                
                            
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td><b>{{ $totalpoint }}</b></td>
                                <td><b><span id="total_point"></span></b></td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                <script>
                    total = 0 
                    $("input[name*='form_value']").change(function(){
                        getPoint();
                    })

                    @if (!empty($assessments)) 
                        getPoint();
                    @endif

                    function getPoint() {
                        total = 0 
                        $("input[name*='form_keys']").each(function(item){
                            var ele = $("input[name*='form_keys']")[item]
                            var formId = $(ele).val()
                            //   console.log(b)
                            var point = $("input[name='form_value["+(formId)+"]']").val()
                            if(point === "") point = 0
                            total  += Number.parseInt(point)
                        })
                        // console.log('total_point' , total)
                        $('#total_point').text(total)
                    }
                </script>
                <!-- User Id Field -->
                {{-- <div class="form-group col-sm-6">
                    {!! Form::label('user_id', 'User Id:') !!}
                    {!! Form::hidden('user_id', $user->user_id, ['class' => 'form-control']) !!}
                </div> --}}


                <!-- User Id Field -->
                <div class="form-group col-sm-6">
                    <br><p><b>ชื่อ-นามสกุล: {{ $user->user->name_TH}} {{$user->user->surname_TH}}</p>
                </div>

               
                <!-- Present Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::hidden('user_id', $user->user_id, ['class' => 'form-control']) !!}
                    {!! Form::hidden('present_id', $present->id, ['class' => 'form-control']) !!}
                    {!! Form::hidden('sequence_id', $present->sequence_id, ['class' => 'form-control']) !!}
                </div>

             
                <!-- Present Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('#') !!}
                    <p>เทอมที่นำเสนอ : {{ $present->sequence->term }} </p>
                    <p>วัน-เวลา : {{ $present->sequence->date_time }} </p>
                    <p>ครั้งที่นำเสนอ : {{ $present->sequence->description }} </p>
                </div>

                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('assessments.index') !!}" class="btn btn-default">Cancel</a>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
{{-- <script>
 $("#myform").validate({
   rules: {
     // no quoting necessary
     name: "required",
     // quoting necessary!
     "user[email]": "email",
     // dots need quoting, too!
     "user.address.street": "required"
   }
 });
</script> --}}
@endsection
@extends('layouts.app')

@section('content')
@include('flash::message')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        ข้อมูลส่วนตัว
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => 'basicInformations.update', 'method' => 'put']) !!}

                @include('basic_informations.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <br>

    @if($role->name == "STUDENT" && $add_adviser->value == "true" )
    <section class="content-header">
        <h1 style="font-family: 'Kanit', sans-serif;">
            อาจารย์ที่ปรึกษา
        </h1>
    </section>
    <br>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => 'basicInformations.updateAdviser', 'method' => 'post']) !!}
                @php
                $advisor = array_get($basicInformation,'adviser_id') != "" ? $basicInformation->adviser_id : 0;
                @endphp
                <!-- Student Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('adviser_id', 'อาจารย์ที่ปรึกษา:') !!}
                    {!! Form::select('adviser_id', $advisers , $advisor , ['class' => 'form-control select2' , 'disabled'=> $readonly]) !!}
                </div>


                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'disabled'=> $readonly ]) !!}

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endif

    <br>

    @if(!empty($roomInfo))
    <section class="content-header">
        <h1 style="font-family: 'Kanit', sans-serif;">
            กลุ่มห้องจุลนิพนธ์
        </h1>
    </section>
    <br>
    <div class="box box-primary">
        <div class="box-body" style="padding-left: 2%">

            <!-- room id -->
            <div class="form-group">
                {!! Form::label('id', 'กลุ่มห้องจุลนิพนธ์:') !!}
                <p>{!! $roomInfo->name !!}</p>
            </div>

            <!-- Room Description -->
            {{-- <div class="form-group">
                    {!! Form::label('description', 'Room Description:') !!}
                    <p>{!! $roomInfo->description !!}</p>
            </div> --}}
            
            <!-- Room Education year -->
            <div class="form-group">
                    {!! Form::label('year', 'ปีการศึกษา:') !!}
                    <p>{!! $roomInfo->year !!}</p>
            </div>

            <!-- Teacher -->
            <div class="form-group">
                    {!! Form::label('อาจารย์ประจำห้อง:') !!}
                    @foreach($userAdvisors as $ad)
                    <p>{!! $ad->user->name_TH.' '.$ad->user->surname_TH !!}</p>
                    @endforeach
            </div>

            {{-- <div class="row">
                Advisor
                @foreach($userAdvisors as $ad)
                    <p>{{  $ad->user->name_TH.' '.$ad->user->surname_TH }}</p>
                @endforeach
            </div> --}}

        </div>
    </div>
    @endif

</div>
@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    });
</script>
@endsection
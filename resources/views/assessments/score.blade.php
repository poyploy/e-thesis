@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Assessment
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => 'assessments.storeScore']) !!}

                <!-- User Id Field -->
                <div class="form-group col-sm-6">
                    {{-- {!! Form::label('user_id', 'User Id:') !!} --}}
                    {!! Form::hidden('user_id', $user->user_id, ['class' => 'form-control']) !!}
                </div>


                 <!-- User Id Field -->
                 <div class="form-group col-sm-6">
                 <p>student name: {{ $user->user->name_TH}} {{$user->user->surname_TH}}</p>
                </div>

                <!-- Assessment Score1 Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('assessment_score1', 'Assessment Score1:') !!}
                    {!! Form::number('assessment_score1', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Assessment Score2 Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('assessment_score2', 'Assessment Score2:') !!}
                    {!! Form::number('assessment_score2', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Assessment Score3 Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('assessment_score3', 'Assessment Score3:') !!}
                    {!! Form::number('assessment_score3', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Present Id Field -->
                <div class="form-group col-sm-6">
                    {{-- {!! Form::label('present_id', 'Present Id:') !!} --}}
                    {!! Form::hidden('present_id', $present->id, ['class' => 'form-control']) !!}
                </div>

                  <!-- Present Id Field -->
                  <div class="form-group col-sm-6">
                    {!! Form::label('present_id', 'Present :') !!}
                    <p>Present term {{ $present->sequence->term }} </p>
                    <p>Present date {{ $present->sequence->date_time }} </p>
                    <p>Present name {{ $present->sequence->description }} </p>
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
@endsection
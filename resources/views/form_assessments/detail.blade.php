@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left" style="font-family: 'Kanit', sans-serif;">รายละเอียดย่อย</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('formAssessments.detail.create',[$formAssessment->id]) !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="formAssessmentSubs-table">
                    <thead>
                        <tr>
                            <th>ครั้งที่</th>
                            <th>รายละเอียดในการตรวจ</th>
                            <th>คะแนนเต็ม</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($formAssessmentSubs as $formAssessmentSub)
                        <tr>
                            <td>{!! $formAssessmentSub->form_id !!}</td>
                            <td>{!! $formAssessmentSub->title !!}</td>
                            <td>{!! $formAssessmentSub->max !!}</td>
                            <td>
                                {!! Form::open(['route' => ['formAssessmentSubs.destroy', $formAssessmentSub->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('formAssessments.detail.update', [$formAssessment->id, $formAssessmentSub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
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


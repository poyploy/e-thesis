@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        ไฟล์งานนักศึกษา
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                {{-- @include('user_presents.show_fields')
                <a href="{!! route('userPresents.index') !!}" class="btn btn-default">Back</a> --}}
                <table class="table table-responsive" id="userPresents-table">
                    <thead>
                        <tr>
                            {{-- <th>รหัส</th> --}}
                            <th>ครั้งที่นำเสนอ</th>
                            <th>ไฟล์</th>
                            <th>วัน/เวลา</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            {{-- <td>{!! $file->sequence_id !!}</td> --}}
                            <td>{!! $file->sequence->description !!}</td>
                            <td>{{ $file->file }}</td>
                            <td>{!! $file->created_at !!}</td>
                            <td>
                                @php 
                                    $path = asset('storage'.$file->file); //asset('storage'.$uploadFile->file)
                                @endphp
                                <a href="{{ $path }}" target="_blank" class='btn btn-info btn-xs'><i class="glyphicon glyphicon-download-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{!! route('advisorFileUploads.show',[$roomId]) !!}" class="btn btn-default">Back</a>

            </div>
        </div>
    </div>
</div>
@endsection
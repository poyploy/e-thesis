@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 style="font-family: 'Kanit', sans-serif;">
        อัปโหลดรูปสลิป
    </h1>
</section>
<div class="content">
    @include('adminlte-templates::common.errors')
    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' =>[ 'presents.advisor.storePaid' , $check ], 'enctype' => 'multipart/form-data']) !!}

                <!-- File Field -->
                <div class="form-group col-sm-12 col-lg-12">
                    {!! Form::label('slip', 'File:') !!}
                    {!! Form::file('slip', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            {{-- <a target="_blank" href="{{ }}"><i class=""></i></a> --}}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
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
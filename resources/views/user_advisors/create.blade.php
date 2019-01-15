@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Advisor
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'userAdvisors.store']) !!}

                        @include('user_advisors.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

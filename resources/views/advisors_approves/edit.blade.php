@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Advisors Approve
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                    {!! Form::open(['route' => ['advisorsApproves.update', $student->user->id], 'method' => 'patch' ]) !!}

                        @include('advisors_approves.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
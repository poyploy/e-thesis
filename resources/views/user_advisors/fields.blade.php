<!-- User Id Field -->

@if(!empty($userAdvisor))
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Advisor Id:') !!}
    {!! Form::select('user_id', $advisors , $userAdvisor->user_id, ['class' => 'form-control select2']) !!}
</div>
@else
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Advisor Id:') !!}
    {!! Form::select('user_id', $advisors , null, ['class' => 'form-control select2']) !!}
</div>
@endif 
<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_id', 'Room Id:') !!}
    {!! Form::text('room_id', $room->id , ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_name', 'Room Name:') !!}
    {!! Form::text('room_name', $room->name, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_description', 'Room Description:') !!}
    {!! Form::text('room_description', $room->description, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

@php

    if(!empty($userAdvisor) && array_get($userAdvisor,'leader')) {
        $isLeader = false ;
    }else{
        $isLeader = false;
    }
@endphp
<!-- Room Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('leader', 'Leader:') !!}
    {!! Form::radio('leader', 1, $isLeader) !!} Yes
    {!! Form::radio('leader', 0, !$isLeader) !!} No
</div>
    

{{-- Form::radio('name', 'value', true); --}}

<input type="hidden" name="room_id" value="{{ $room->id }}" >

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userAdvisors.index') !!}" class="btn btn-default">Cancel</a>
</div>



@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    });
</script>
@endsection
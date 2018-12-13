<!-- Role Id Field -->

@if(empty($permission->role_id))
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role Id:') !!}
    {!! Form::select('role_id',$roles, null, ['class' => 'form-control select2']); !!}
</div>
@else
{{-- {{ dd($permission->role_id) }} --}}
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role Id:') !!}
    {!! Form::select('role_id',$roles,(string) $permission->role_id, ['class' => 'form-control select2']); !!}
</div>
@endif

<!-- Menu Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('menu_id', 'Menu Id:') !!}
    {!! Form::select('menu_id', $menus , null , ['class' => 'form-control select2']) !!}
</div>

<!-- Can Access Field -->
<div class="form-group col-sm-6">
    {!! Form::label('can_access', 'Can Access:') !!}
    <div class="radio">
        <label>  {!! Form::radio('can_access', 1, true) !!} true </label>
    </div>
    <div class="radio">
        <label> {!! Form::radio('can_access', 0, false) !!} false </label>
    </div>
</div>

<!-- Can Visible Field -->
<div class="form-group col-sm-6">
    {!! Form::label('can_visible', 'Can Visible:') !!}
    <div class="radio">
        <label>  {!! Form::radio('can_visible', 1, true) !!} true </label>
    </div>
    <div class="radio">
        <label> {!! Form::radio('can_visible', 0, false) !!} false </label>
    </div>
</div>

<!-- Can Create Field -->
<div class="form-group col-sm-6">
    {!! Form::label('can_create', 'Can Create:') !!}
    <div class="radio">
            <label>  {!! Form::radio('can_create', 1, true) !!} true </label>
        </div>
        <div class="radio">
            <label> {!! Form::radio('can_create', 0, false) !!} false </label>
        </div>
</div>

<!-- Can Update Field -->
<div class="form-group col-sm-6">
    {!! Form::label('can_update', 'Can Update:') !!}
    <div class="radio">
            <label>  {!! Form::radio('can_update', 1, true) !!} true </label>
        </div>
        <div class="radio">
            <label> {!! Form::radio('can_update', 0, false) !!} false </label>
        </div>
</div>

<!-- Can Delete Field -->
<div class="form-group col-sm-6">
    {!! Form::label('can_delete', 'Can Delete:') !!}
    <div class="radio">
            <label>  {!! Form::radio('can_delete', 1, true) !!} true </label>
        </div>
        <div class="radio">
            <label> {!! Form::radio('can_delete', 0, false) !!} false </label>
        </div>
</div>

<!-- Can Show Field -->
<div class="form-group col-sm-6">
    {!! Form::label('can_show', 'Can Show:') !!}
    <div class="radio">
            <label>  {!! Form::radio('can_show', 1, true) !!} true </label>
        </div>
        <div class="radio">
            <label> {!! Form::radio('can_show', 0, false) !!} false </label>
        </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('permissions.index') !!}" class="btn btn-default">Cancel</a>
</div>


@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2({
  placeholder: 'Select an option'
});
});
</script>
@endsection
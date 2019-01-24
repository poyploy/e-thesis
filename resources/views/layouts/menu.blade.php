

@foreach (session('permission') as $permission)

    <?php $menu = $permission->menu; ?>
@if($permission->can_visible>0)
<li class="{{ Request::is($menu->route_name.'*') ? 'active' : '' }}">
<a href="{!! route($menu->route_name.'.index') !!}"><i class="{{ $menu->icon }}"></i><span>{{ $menu->name }} </span></a>
</li>
@endif
@endforeach

<li class="{{ Request::is('assessments*') ? 'active' : '' }}">
    <a href="{!! route('assessments.index') !!}"><i class="fa fa-edit"></i><span>Assessments</span></a>
</li>


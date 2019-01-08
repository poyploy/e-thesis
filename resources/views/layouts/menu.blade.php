

@foreach (session('permission') as $permission)

    <?php $menu = $permission->menu; ?>
@if($permission->can_visible>0)
<li class="{{ Request::is($menu->route_name.'*') ? 'active' : '' }}">
<a href="{!! route($menu->route_name.'.index') !!}"><i class="{{ $menu->icon }}"></i><span>{{ $menu->name }}</span></a>
</li>
@endif
@endforeach

{{-- <li class="{{ Request::is('rooms*') ? 'active' : '' }}">
    <a href="{!! route('rooms.index') !!}"><i class="fa fa-edit"></i><span>Rooms</span></a>
</li>
 --}}
<li class="{{ Request::is('basicInformations*') ? 'active' : '' }}">
    <a href="{!! route('basicInformations.index') !!}"><i class="fa fa-edit"></i><span>BasicInformations</span></a>
</li>


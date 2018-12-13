

@foreach (session('permission') as $permission)

    <?php $menu = $permission->menu; ?>

<li class="{{ Request::is($menu->route_name.'*') ? 'active' : '' }}">
<a href="{!! route($menu->route_name.'.index') !!}"><i class="{{ $menu->icon }}"></i><span>{{ $menu->name }}</span></a>
</li>
@endforeach

{{-- <li class="{{ Request::is('rooms*') ? 'active' : '' }}">
    <a href="{!! route('rooms.index') !!}"><i class="fa fa-edit"></i><span>Rooms</span></a>
</li>
 --}}

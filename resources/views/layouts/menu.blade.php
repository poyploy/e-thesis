<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

<style>
    body{
        font-family: 'Kanit', sans-serif;
        font-size: 16px;
    }    
</style>

@foreach (session('permission') as $permission)

    <?php $menu = $permission->menu; ?>
@if($permission->can_visible>0)
<li class="{{ Request::is($menu->route_name.'*') ? 'active' : '' }}">
<a href="{!! route($menu->route_name.'.index') !!}"><i class="{{ $menu->icon }}"></i><span>{{ $menu->name }} </span></a>
</li>
@endif
@endforeach

<li class="{{ Request::is('contents*') ? 'active' : '' }}">
    {{-- <a href="{!! route('contents.index') !!}"><i class="fa fa-edit"></i><span>Contents</span></a> --}}
</li>


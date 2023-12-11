@props([
    'path' => '',
])
<li class="nav-item">
    <a @class(['nav-link', 'active' => request()->routeIs($path)]) href="{{route($path)}}">{{$slot}}</a>
</li>

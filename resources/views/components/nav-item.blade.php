@props([
    'path' => '',
])
<li class="nav-item">
    <a class="nav-link @if(request()->routeIs($path)) active @endif"
       href="{{route($path)}}">{{$slot}}</a>
</li>

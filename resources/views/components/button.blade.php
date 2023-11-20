@props([
    'theme' => 'primary',
    'type' => 'button'
])

<button {{$attributes->merge(['class' => "btn btn-$theme"])}} type="{{$type}}">{{$slot}}</button>

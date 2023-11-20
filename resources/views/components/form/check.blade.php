@props([
    'id' => \Illuminate\Support\Str::random(),
    'label' => 'Check'
])

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" value="" id="{{$id}}" {{$attributes}}>
    <label class="form-check-label" for="{{$id}}">
        {{$label}}
    </label>
</div>

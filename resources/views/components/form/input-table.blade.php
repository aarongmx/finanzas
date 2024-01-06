@props([
    'id' => Str::random(),
    'type' => 'text',
    'label' => 'Label',
    'before' => false,
    'after' => false,
])

<div class="input-group">
    @if($before)
        <span class="input-group-text">{{$before}}</span>
    @endif
    <input
        id="{{$id}}"
        type="{{$type}}"
        @class([
            'form-control',
            'is-invalid' => $errors->has($attributes->wire('model')->value()),
        ])
        placeholder=""
        {{$attributes}}
    >
    @if($after)
        <span class="input-group-text">{{$after}}</span>
    @endif
    @error($attributes->wire('model')->value())
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

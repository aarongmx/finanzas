'@props([
    'id' => Str::random(),
    'type' => 'text',
    'label' => 'Label'
])

<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$label}}</label>
    <input
        id="{{$id}}"
        type="{{$type}}"
        @class([
            'form-control',
            'is-invalid' => $errors->has($attributes->wire('model')->value()),
        ])
        {{$attributes}}
    >
    @error($attributes->wire('model')->value())
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

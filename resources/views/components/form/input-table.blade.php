@props([
    'id' => Str::random(),
    'type' => 'text',
    'label' => 'Label'
])

<div>
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
    @error($attributes->wire('model')->value())
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

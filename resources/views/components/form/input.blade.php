@props([
    'id' => Str::random(),
    'type' => 'text',
    'label' => 'Label'
])

<div class="form-floating mb-3">
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
    <label for="{{$id}}">{{$label}}</label>
    @error($attributes->wire('model')->value())
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

@props([
    'id' => \Illuminate\Support\Str::random(),
    'label' => 'Select',
    'default' => '- Seleccione una opción -'
])

<div class="form-floating mb-3">
    <select
        @class([
            'form-select',
            'is-invalid' => $errors->has($attributes->wire('model')->value()),
        ])
        id="{{$id}}"
        aria-label="{{$label}}"
        {{$attributes}}
    >
        <option value="" selected>{{$default}}</option>
        {{$slot}}
    </select>
    <label for="{{$id}}">{{$label}}</label>
    @error($attributes->wire('model')->value())
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

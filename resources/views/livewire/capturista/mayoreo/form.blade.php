<form wire:submit.prevent="store">
    <x-form.input
        label="Fecha de venta"
        type="date"
        wire:model="form.fechaVenta"
    />
    <x-form.select wire:model="form.productoId">
        @forelse($this->productos() as $producto)
            <option value="{{$producto->id}}">{{$producto->nombre}}</option>
        @empty
        @endforelse
    </x-form.select>
    <x-form.input
        label="Cantidad"
        wire:model="form.cantidad"
    />
    <x-form.input
        label="Precio"
        wire:model="form.precio"
    />
    <x-button type="submit">Guardar</x-button>
</form>

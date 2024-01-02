<form wire:submit.prevent="store">
    <x-form.input
        label="Fecha de venta"
        type="date"
        wire:model="form.fechaVenta"
    />

    <x-form.input
        wire:model="form.cantidad"
        type="number"
        step="0.01"
        label="Cantidad"
    />

    <x-form.input
        wire:model="form.precio"
        type="number"
        step="0.01"
        label="Precio"
    />

    <x-form.select label="Producto" wire:model="form.productoId">
        @forelse($this->productos as $producto)
            <option value="{{$producto->id}}">{{$producto->nombre}}</option>
        @empty
        @endforelse
    </x-form.select>

    <x-form.select label="Sucursal destino" id="sucursal-select" wire:model="form.sucursalDestinoId">
        @forelse($this->sucursales as $sucursal)
            <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
        @empty
        @endforelse
    </x-form.select>

    <button class="btn btn-primary">Registrar</button>
</form>

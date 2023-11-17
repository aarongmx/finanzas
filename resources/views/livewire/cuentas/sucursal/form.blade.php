<form wire:submit.prevent="store" class="p-4">
    @forelse($this->items as $i => $item)
        <div class="row">
            <div class="col-1">
                <p class="m-0">{{$item['producto']}}</p>
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.precio"
                    type="number"
                    label="Precio"
                    step="0.01"
                />
            </div>
            <div class="col-2">
                <x-form.input
                    wire:model="items.{{$i}}.cantidad_existencia"
                    type="number"
                    label="Cantidad existencia"
                    step="0.01"
                    disabled
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.importe_existencia"
                    type="number"
                    label="Importe existencia"
                    step="0.01"
                    disabled
                    x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_existencia')"
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.cantidad_entrada"
                    type="number"
                    label="Cantidad entrada"
                    step="0.01"
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.importe_entrada"
                    type="number"
                    label="Importe entrada"
                    step="0.01"
                    disabled
                    x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_entrada')"
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.cantidad_salida"
                    type="number"
                    label="Cantidad salida"
                    step="0.01"
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.importe_salida"
                    type="number"
                    label="Importe salida"
                    step="0.01"
                    disabled
                    x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_salida')"
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.cantidad_sobrante"
                    type="number"
                    label="Cantidad sobrante"
                    step="0.01"
                />
            </div>
            <div class="col-1">
                <x-form.input
                    wire:model="items.{{$i}}.importe_sobrante"
                    type="number"
                    label="Importe sobrante"
                    step="0.01"
                    disabled
                    x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_sobrante')"
                />
            </div>
        </div>
    @empty
    @endforelse
</form>

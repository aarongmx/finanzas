<form wire:submit.prevent="store" class="p-4">
    <div class="row">
        <div class="col-3">
            <x-form.input
                type="date"
                wire:model.live="fecha"
                label="Fecha de venta"
            />
        </div>
        <div class="col-3">
            <x-form.input
                type="date"
                wire:model.live="fechaRegistro"
                label="Fecha de registro"
            />
        </div>
    </div>

    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Importe Existencia</th>
            <th>Entrada</th>
            <th>Importe Entrada</th>
            <th>Salida</th>
            <th>Importe Salida</th>
            <th>Sobrante</th>
            <th>Importe Sobrante</th>
        </tr>
        </thead>
        <tbody>
        @forelse($this->items as $i => $item)
            <tr>
                <td>{{$item['producto']}}</td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.precio"
                        type="number"
                        label=""
                        step="0.01"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.cantidad_existencia"
                        type="number"
                        label=""
                        step="0.01"
                        disabled
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.importe_existencia"
                        type="number"
                        label=""
                        step="0.01"
                        disabled
                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_existencia')"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.cantidad_entrada"
                        type="number"
                        label=""
                        step="0.01"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.importe_entrada"
                        type="number"
                        label=""
                        step="0.01"
                        disabled
                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_entrada')"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.cantidad_salida"
                        type="number"
                        label=""
                        step="0.01"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.importe_salida"
                        type="number"
                        label=""
                        step="0.01"
                        disabled
                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_salida')"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.cantidad_sobrante"
                        type="number"
                        label=""
                        step="0.01"
                    />
                </td>
                <td>
                    <x-form.input
                        wire:model="items.{{$i}}.importe_sobrante"
                        type="number"
                        label=""
                        step="0.01"
                        disabled
                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_sobrante')"
                    />
                </td>
            </tr>
        @empty
        @endforelse
        </tbody>
    </table>

</form>

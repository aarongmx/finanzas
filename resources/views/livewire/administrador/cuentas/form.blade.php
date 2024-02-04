<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Cuenta</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <select class="form-select">
                @forelse($this->sucursales as $sucursal)
                    <option value="{{$sucursal->id}}" wire:key="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-12 col-md-4">
            <x-form.input
                label="Fecha de venta"
                type="date"
            />
        </div>
        <div class="col-12 col-md-4">
            <x-form.input
                label="Fecha de captura"
                type="date"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @forelse($this->categorias as $categoria)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="{{$categoria->nombre}}"
                           id="categoria-{{$categoria->id}}" value="{{$categoria->id}}"
                           wire:model.live="categoriaSeleccionada">
                    <label class="form-check-label" for="categoria-{{$categoria->id}}">{{$categoria->nombre}}</label>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <x-table.table>
        <x-slot:header>
            <x-table.th>Producto</x-table.th>
            <x-table.th>Precio</x-table.th>
            <x-table.th>Sobrante anterior(KG)</x-table.th>
            <x-table.th>Importe anterior($)</x-table.th>
            <x-table.th>Entrada(KG)</x-table.th>
            <x-table.th>Importe Entrada($)</x-table.th>
            <x-table.th>Salida(KG)</x-table.th>
            <x-table.th>Importe Salida($)</x-table.th>
            <x-table.th>Sobrante(KG)</x-table.th>
            <x-table.th>Importe Sobrante($)</x-table.th>
        </x-slot:header>
        @forelse($this->items as $i => $item)
            <tr wire:key="{{$i}}">
                <td>
                    <p>{{$item['producto_name']}}</p>
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.precio"
                        @input="(e) => {
                            let quantity = $wire.items[{{$i}}].cantidad_existencia;
                            let value = e.target.value;
                            $wire.items[{{$i}}].importe_existencia = quantity * value;
                       }"
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.cantidad_existencia"
                        disabled
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.importe_existencia"
                        disabled
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.cantidad_entrada"
                        @input="(e) => {
                            let price = $wire.items[{{$i}}].precio;
                            let value = e.target.value;
                            $wire.items[{{$i}}].importe_entrada = price * value;
                       }"
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.importe_entrada"
                        disabled
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.cantidad_salida"
                        @input="(e) => {
                            let price = $wire.items[{{$i}}].precio;
                            let value = e.target.value;
                            $wire.items[{{$i}}].importe_salida = price * value;

                            if($wire.items[{{$i}}].categoria_id === 2){
                                let amount = {{$item['cantidad_sobrante']}} - value;
                                $wire.items[{{$i}}].cantidad_sobrante = amount;
                                $wire.items[{{$i}}].importe_sobrante = price * amount;
                            }
                       }"
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.importe_salida"
                        disabled
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.cantidad_sobrante"
                        @input="(e) => {
                            let price = $wire.items[{{$i}}].precio;
                            let value = e.target.value;
                            $wire.items[{{$i}}].importe_sobrante = price * value;
                       }"
                    />
                </td>
                <td>
                    <x-form.input-table
                        wire:model="items.{{$i}}.importe_sobrante"
                        disabled
                    />
                </td>
            </tr>
        @empty
        @endforelse
    </x-table.table>
</div>

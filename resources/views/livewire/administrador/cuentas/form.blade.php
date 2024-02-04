<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Cuenta</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-floating">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>-- Seleccione una sucursal --</option>
                    @forelse($this->sucursales as $sucursal)
                        <option value="{{$sucursal->id}}" wire:key="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                    @empty
                    @endforelse
                </select>
                <label for="floatingSelect">Sucursales</label>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <x-form.input
                label="Fecha de venta"
                type="date"
                wire:model.live.debounce.350ms="fechaVenta"
            />
        </div>
        <div class="col-12 col-md-4">
            <x-form.input
                label="Fecha de captura"
                type="date"
                wire:model="fechaCaptura"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
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
                            let quantity = parseFloat($wire.items[{{$i}}].cantidad_existencia).toFixed(2);
                            let value = parseFloat(e.target.value).toFixed(2);
                            $wire.items[{{$i}}].importe_existencia = parseFloat(quantity * value).toFixed(2);
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
                            let price = parseFloat($wire.items[{{$i}}].precio).toFixed(2);
                            let value = parseFloat(e.target.value).toFixed(2);
                            $wire.items[{{$i}}].importe_entrada = parseFloat(price * value).toFixed(2);
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
                            let price = parseFloat($wire.items[{{$i}}].precio).toFixed(2);
                            let value = parseFloat(e.target.value).toFixed(2);
                            $wire.items[{{$i}}].importe_salida = parseFloat(price * value).toFixed(2);

                            if($wire.items[{{$i}}].categoria_id === 2){
                                let amount = parseFloat({{$item['cantidad_sobrante']}} - value).toFixed(2);
                                $wire.items[{{$i}}].cantidad_sobrante = parseFloat(amount).toFixed(2);
                                $wire.items[{{$i}}].importe_sobrante = parseFloat(price * amount).toFixed(2);
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
    </div>
</div>

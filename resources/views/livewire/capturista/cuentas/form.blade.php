<form wire:submit.prevent="store" class="p-4"
      x-data="{totalExistencia:0, totalEntrada: 0, totalSalida:0, totalSobrante:0}">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">Cuentas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Existencia</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalExistencia).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Entrada</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalEntrada).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Salida</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalSalida).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Sobrante</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalSobrante).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid mb-3 d-flex align-items-center justify-content-center">
        @forelse($this->steps as $i => $step)
            <p class="badge text-center mb-0 d-flex align-items-center justify-content-center rounded-pill"
               :class="$wire.step === {{$i}} ? 'text-bg-primary' : 'text-bg-light'">{{$step}}</p>
            @if(!$loop->last)
                <hr>
            @endif
        @empty
        @endforelse
    </div>
    <div>
        <div class="row" x-show="$wire.step === 1">
            <div class="col-12 col-md-3">
                <x-form.input
                        type="date"
                        wire:model.live="fechaVenta"
                        label="Fecha de venta"
                />
            </div>
            <div class="col-12 col-md-3">
                <x-form.input
                        type="date"
                        wire:model.live="fechaCaptura"
                        label="Fecha de captura"
                />
            </div>
            <div class="col-12">
                <x-table.table>
                    <x-slot:header>
                        <tr>
                            <x-table.th>Producto</x-table.th>
                            <x-table.th>Precio</x-table.th>
                            <x-table.th>Existencia</x-table.th>
                            <x-table.th>Importe Existencia</x-table.th>
                        </tr>
                    </x-slot:header>
                    <tbody>
                    @forelse($this->items as $i => $item)
                        <tr>
                            <td>{{$item['producto']}}</td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.precio"
                                        type="number"
                                        label=""
                                        step="0.01"
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.cantidad_existencia"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        disabled
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.importe_existencia"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        disabled
                                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_existencia')"
                                />
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </x-table.table>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 2">
            <div class="col-12">
                <x-table.table>
                    <x-slot:header>
                        <tr>
                            <x-table.th>Producto</x-table.th>
                            <x-table.th>Precio</x-table.th>
                            <x-table.th>Entrada</x-table.th>
                            <x-table.th>Importe Entrada</x-table.th>
                        </tr>
                    </x-slot:header>
                    @forelse($this->items as $i => $item)
                        <tr>
                            <td>{{$item['producto']}}</td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.precio"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        disabled
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.cantidad_entrada"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=importe-entrada-]'));
                                        totalEntrada = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                        id="importe-entrada-{{$i}}"
                                        wire:model="items.{{$i}}.importe_entrada"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        disabled
                                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_entrada')"
                                />
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </x-table.table>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 3">
            <div class="col-12">
                <x-table.table>
                    <x-slot:header>
                        <tr>
                            <x-table.th>Producto</x-table.th>
                            <x-table.th>Precio</x-table.th>
                            <x-table.th>Salida</x-table.th>
                            <x-table.th>Importe Salida</x-table.th>
                        </tr>
                    </x-slot:header>
                    @forelse($this->items as $i => $item)
                        <tr>
                            <td>{{$item['producto']}}</td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.precio"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        disabled
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                        wire:model="items.{{$i}}.cantidad_salida"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=importe-salida-]'));
                                        totalSalida = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                        id="importe-salida-{{$i}}"
                                        wire:model="items.{{$i}}.importe_salida"
                                        type="number"
                                        label=""
                                        step="0.01"
                                        disabled
                                        x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_salida')"
                                />
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </x-table.table>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 4">
            <div class="col-12">
                <x-table.table>
                    <x-slot:header>
                        <tr>
                            <x-table.th>Producto</x-table.th>
                            <x-table.th>Precio</x-table.th>
                            <x-table.th>Sobrante</x-table.th>
                            <x-table.th>Importe Sobrante</x-table.th>
                        </tr>
                    </x-slot:header>
                    @forelse($this->items as $i => $item)
                        <tr>
                            <td>{{$item['producto']}}</td>
                            <td>
                                <x-form.input-table wire:model="items.{{$i}}.precio" type="number" label="" step="0.01"
                                                    disabled/>
                            </td>
                            <td>
                                <x-form.input-table wire:model="items.{{$i}}.cantidad_sobrante" type="number" label=""
                                                    step="0.01"
                                                    @input="(e) => {
                                                const inputs = Array.from(document.querySelectorAll('[id^=importe-sobrante-]'));
                                                totalSobrante = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                            }"/>
                            </td>
                            <td>
                                <x-form.input-table id="importe-sobrante-{{$i}}"
                                                    wire:model="items.{{$i}}.importe_sobrante"
                                                    type="number" label="" step="0.01" disabled
                                                    x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_sobrante')"/>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </x-table.table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <x-button x-show="$wire.step > 1" x-on:click="$wire.step = $wire.step-1" theme="outline-primary">Atrás
            </x-button>
            <x-button x-on:click="$wire.step = $wire.step+1">Siguiente</x-button>
            {{--<x-button wire:click.prevent="step1">Siguiente</x-button>--}}
        </div>
    </div>
    <x-button type="submit">Registrar</x-button>
</form>

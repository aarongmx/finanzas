<form wire:submit.prevent="store" class="p-4"
      x-data="{
        totalExistencia:0,
        totalEntrada: 0,
        totalSalida:0,
        totalSobrante:0,
        totalGastos: 0,
        total: 0,
        data: []
      }">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">Cuentas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Existencia</strong>
                    <p class="h4"
                       x-text="() => `$${($wire.importeExistencia).toLocaleString()} / ${$wire.cantidadExistencia} Kg.`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Entrada</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalEntrada).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Salida</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalSalida).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Sobrante</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalSobrante).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Gastos</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalGastos).toLocaleString()}`"></p>
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
                            <x-table.th>Cantidad Anterior</x-table.th>
                            <x-table.th>Importe Anterior</x-table.th>
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
            <div class="col-12">
                <x-button wire:click.prevent="step1">Siguiente</x-button>
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
            <div class="col-12">
                <x-button theme="outline-primary" wire:click.prevent="back(1)">Atrás</x-button>
                <x-button wire:click.prevent="step2">Siguiente</x-button>
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
            <div class="col-12">
                <x-button theme="outline-primary" wire:click.prevent="back(2)">Atrás</x-button>
                <x-button wire:click.prevent="step3">Siguiente</x-button>
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
            <div class="col-12">
                <x-button theme="outline-primary" wire:click.prevent="back(3)">Atrás</x-button>
                <x-button wire:click.prevent="step4">Siguiente</x-button>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 5">
            <div class="col-12">
                <x-table.table>
                    <x-slot:header>
                        <tr>
                            <x-table.th>Concepto</x-table.th>
                            <x-table.th>Precio</x-table.th>
                            <x-table.th></x-table.th>
                        </tr>
                    </x-slot:header>
                    @forelse($this->gasto as $i => $gasto)
                        <tr>
                            <td>
                                <x-form.input-table
                                    wire:model="gasto.{{$i}}.concepto"
                                />
                            </td>
                            <td>
                                <x-form.input-table
                                    wire:model="gasto.{{$i}}.precio"
                                    id="gastos-precio-{{$i}}"
                                    @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=gastos-precio-]'));
                                        totalGastos = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"
                                />
                            </td>
                            <td>
                                <x-button wire:click.prevent="addGasto">+</x-button>
                                @if(!$loop->first)
                                    <x-button wire:click.prevent="removeGasto({{$i}})" @click.prevent="(e) => {
                                        const input = document.querySelectorAll('[id^=gastos-precio-{{$i}}]')[0];
                                        totalGastos -= parseFloat(input.value, 0)
                                    }">-</x-button>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </x-table.table>
            </div>
            <div class="col-12">
                <x-button theme="outline-primary" wire:click.prevent="back(4)">Atrás</x-button>
                <x-button wire:click.prevent="step5">Siguiente</x-button>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 6">
            <div class="col-6">
                <div>
                    <strong>Gastos</strong>
                    <p x-text="() => `$${parseFloat(totalGastos).toLocaleString()}`"></p>
                </div>
                <div>
                    <strong>Salidas</strong>
                    <p x-text="() => `$${parseFloat(totalSalida).toLocaleString()}`"></p>
                </div>
                <div>
                    <strong>Sobrante</strong>
                    <p x-text="() => `$${parseFloat(totalSobrante).toLocaleString()}`"></p>
                </div>
                <div>
                    <strong>Entrada</strong>
                    <p x-text="() => `$${parseFloat(totalEntrada).toLocaleString()}`"></p>
                </div>
                <div>
                    <strong>Total</strong>
                    <p x-text="() => `$${
                    (parseFloat(totalEntrada)+parseFloat(totalExistencia)-parseFloat(totalSalida)-parseFloat(totalSobrante)).toLocaleString()-parseFloat(totalGastos).toLocaleString()}`"></p>
                </div>
                <x-form.input
                    wire:model="efectivo"
                    type="number"
                    step="0.01"
                    label="Efectivo"
                />
            </div>
            <div class="col-6">
                <x-form.input
                    label="A Cuenta"
                    wire:model="aCuenta"
                    type="number"
                    step="0.01"
                />
            </div>
            <div class="col-12">
                <x-button theme="outline-primary" wire:click.prevent="back(5)">Atrás</x-button>
                <x-button type="submit">Registrar</x-button>
            </div>
        </div>
    </div>

</form>

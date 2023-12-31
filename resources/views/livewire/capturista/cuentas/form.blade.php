<div class="container-fluid py-lg-4" x-data="form(@entangle('importeExistencia'), @entangle('items'), @entangle('efectivo'))">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">Cuentas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Existencia</strong>
                    <p class="h4"
                       x-text="() => `$${parseFloat(totalExistencia).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Entrada</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalEntrada).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Salida</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalSalida).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Sobrante</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalSobrante).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Gastos</strong>
                    <p class="h4" x-text="() => `$${parseFloat(totalGastos).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form wire:submit.prevent="store">
                <div class="mb-3 d-flex align-items-center justify-content-center">
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
                        <div class="col-12 col-md-6 mb-3">
                            <x-form.input
                                label="Buscar producto"
                                @input="(e) => searchOnTable(e, 'precio-table')"
                            />
                        </div>
                        <div class="col-12">
                            <x-table.table id="precio-table">
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
                                                x-model="data[{{$i}}].precio"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                x-model="data[{{$i}}].cantidad_existencia"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                after="kg"
                                                @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=importe-existencia-]'));
                                        totalExistencia = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                id="importe-existencia-{{$i}}"
                                                x-model="data[{{$i}}].importe_existencia"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                                x-bind:value="data[{{$i}}].precio * data[{{$i}}].cantidad_existencia"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button wire:click.prevent="step1">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 2">
                        <div class="col-12">
                            <x-form.input
                                label="Buscar producto"
                                @input="(e) => searchOnTable(e, 'entrada-table')"
                            />
                        </div>
                        <div class="col-12">
                            <x-table.table id="entrada-table">
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
                                                x-model="data[{{$i}}].precio"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                x-model="data[{{$i}}].cantidad_entrada"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                after="kg"
                                                @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=importe-entrada-]'));
                                        totalEntrada = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                id="importe-entrada-{{$i}}"
                                                x-model="data[{{$i}}].importe_entrada"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                                x-bind:value="data[{{$i}}].precio * data[{{$i}}].cantidad_entrada"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(1)">Atrás</x-button>
                            <x-button wire:click.prevent="step2">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 3">
                        <div class="col-12">
                            <x-form.input
                                label="Buscar producto"
                                @input="(e) => searchOnTable(e, 'salida-table')"
                            />
                        </div>
                        <div class="col-12">
                            <x-table.table id="salida-table">
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
                                                x-model="data[{{$i}}].precio"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                x-model="data[{{$i}}].cantidad_salida"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                after="kg"
                                                @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=importe-salida-]'));
                                        totalSalida = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                id="importe-salida-{{$i}}"
                                                x-model="data[{{$i}}].importe_salida"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                                x-bind:value="data[{{$i}}].precio * data[{{$i}}].cantidad_salida"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(2)">Atrás</x-button>
                            <x-button wire:click.prevent="step3">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 4">
                        <div class="col-12">
                            <x-form.input
                                label="Buscar producto"
                                @input="(e) => searchOnTable(e, 'sobrante-table')"
                            />
                        </div>
                        <div class="col-12">
                            <x-table.table id="sobrante-table">
                                <x-slot:header>
                                    <tr>
                                        <x-table.th>Producto</x-table.th>
                                        <x-table.th>Precio</x-table.th>
                                        <x-table.th>Sobrante</x-table.th>
                                        <x-table.th>Importe Sobrante</x-table.th>
                                        <x-table.th>
                                            <x-button wire:click.prevent="arrastrarDatosMarinados">Arrastrar sobrantes
                                                marinado
                                            </x-button>
                                        </x-table.th>
                                    </tr>
                                </x-slot:header>
                                @forelse($this->items as $i => $item)
                                    <tr>
                                        <td>{{$item['producto']}}</td>
                                        <td>
                                            <x-form.input-table
                                                x-model="data[{{$i}}].precio"
                                                type="number"
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                x-model="data[{{$i}}].cantidad_sobrante" type="number" label=""
                                                step="0.01"
                                                after="kg"
                                                @input="(e) => {
                                        const inputs = Array.from(document.querySelectorAll('[id^=importe-sobrante-]'));
                                        totalSobrante = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                    }"/>
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                id="importe-sobrante-{{$i}}"
                                                x-model="data[{{$i}}].importe_sobrante"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                                x-bind:value="data[{{$i}}].precio * data[{{$i}}].cantidad_sobrante"
                                            />
                                        </td>
                                        <td></td>
                                    </tr>
                                @empty
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
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
                                                before="$"
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
                                    }">-
                                                </x-button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(4)">Atrás</x-button>
                            <x-button wire:click.prevent="step5">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 6">
                        <div class="col-6">
                            <div>
                                <strong>Existencia anterior</strong>
                                <p x-text="() => `$${parseFloat(totalExistencia).toLocaleString()}`"></p>
                            </div>
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
                                <strong>Total Entrada</strong>
                                <p x-text="() => `$${(parseFloat(totalExistencia)+parseFloat(totalEntrada)).toLocaleString()}`"></p>
                            </div>
                            <div>
                                <strong>Total</strong>
                                <p x-text="() =>
                        `$${(parseFloat(totalEntrada)+parseFloat(totalExistencia)-parseFloat(totalSalida)-parseFloat(totalSobrante)-parseFloat(totalGastos)).toLocaleString()}`"></p>
                            </div>
                            <x-form.input
                                x-model="efectivo"
                                type="number"
                                step="0.01"
                                label="Efectivo"
                            />

                            <div class="card" :class="{
                    'bg-success': parseFloat(efectivo) - (parseFloat(totalEntrada)+parseFloat(totalExistencia)-parseFloat(totalSalida)-parseFloat(totalSobrante)-parseFloat(totalGastos)) === 0,
                    'bg-danger': parseFloat(efectivo) - (parseFloat(totalEntrada)+parseFloat(totalExistencia)-parseFloat(totalSalida)-parseFloat(totalSobrante)-parseFloat(totalGastos)) < 0,
                    'bg-info': parseFloat(efectivo) - (parseFloat(totalEntrada)+parseFloat(totalExistencia)-parseFloat(totalSalida)-parseFloat(totalSobrante)-parseFloat(totalGastos)) > 0
                }">
                                <div class="card-body">
                                    <p x-text="() => {
                            let total = (parseFloat(efectivo) - (parseFloat(totalEntrada)+parseFloat(totalExistencia)-parseFloat(totalSalida)-parseFloat(totalSobrante)-parseFloat(totalGastos))).toFixed(2);
                            if(parseFloat(total) > 0) return `Saldo a favor: $${total}`
                            if(parseFloat(total) < 0) return `Adeuda: $${total}`
                            if(parseFloat(total) === 0) return `Cuenta correcta: $${total}`
                        }"
                                       class="text-muted m-0"></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <x-form.input
                                label="Efectivo marinados"
                                wire:model="aCuenta"
                                type="number"
                                step="0.01"
                            />
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(5)">Atrás</x-button>
                            <x-button type="submit">Registrar</x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @vite(['resources/js/form.js'])
</div>

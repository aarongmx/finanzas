<div class="container-fluid py-lg-4" x-data="{
    searchOnTable(e, tableId) {
        const searchTable = document.getElementById(tableId);
        const rows = searchTable.querySelectorAll('tbody tr');

        rows.forEach((row) => {
            const cells = Array.from(row.querySelectorAll('td'));
            const matchString = cells.map((n) => n.textContent.toLowerCase()).join(' ');
            const match = matchString.includes(e.target.value);
            row.classList.toggle('d-none', !match);
        });
    },
    makeFloat (value) {
        let floatValue = parseFloat(value)
        return !isNaN(floatValue) ? parseFloat(floatValue.toFixed(2)) : 0
    },
    actualizarPrecios(e, index) {
        let precio = this.makeFloat(e.target.value);
        let cantidadExistencia = this.makeFloat($wire.items[index].cantidad_existencia);
        let cantidadEntrada = this.makeFloat($wire.items[index].cantidad_entrada);
        let cantidadSalida = this.makeFloat($wire.items[index].cantidad_salida);
        let cantidadSobrante = this.makeFloat($wire.items[index].cantidad_sobrante);

        $wire.items[index].importe_existencia = precio * cantidadExistencia;
        $wire.items[index].importe_entrada = precio * cantidadEntrada;
        $wire.items[index].importe_salida = precio * cantidadSalida;
        $wire.items[index].importe_sobrante = precio * cantidadSobrante;

        let total = $wire.items.reduce((total, item) => total + this.makeFloat(item.importe_existencia), 0);
        $wire.sumExistencia = isNaN(total) ? this.makeFloat($wire.importeExistencia) : total + this.makeFloat($wire.importeExistencia);

        $wire.entradasArray.map(i => {
            let item = $wire.items.find(item => item.producto_id === i.producto_id)
            let precioProducto = this.makeFloat(item.precio);

            let total = precioProducto * this.makeFloat(i.cantidad) + this.makeFloat({{$totalEntrada}});

            i.precio = precioProducto

            $wire.sumEntradasRecibidas = total;
            $wire.sumEntrada = total;
        });
    },
    actualizarEntradas(e, index) {
        let precio = this.makeFloat($wire.items[index].precio);
        let cantidad = this.makeFloat(e.target.value);
        $wire.items[index].importe_entrada = this.makeFloat(precio * cantidad);

        let total = $wire.items.reduce((total, item) => total + this.makeFloat(item.importe_entrada), 0);
        $wire.sumEntrada = isNaN(total) ? this.makeFloat($wire.sumEntradasRecibidas) : total + this.makeFloat($wire.sumEntradasRecibidas);
    },
    actualizarSalidas(e, index){
        let precio = this.makeFloat($wire.items[index].precio);
        let cantidad = this.makeFloat(e.target.value);
        $wire.items[index].importe_salida = this.makeFloat(precio * cantidad);
        let total = $wire.items.reduce((total, item) => total + this.makeFloat(item.importe_salida), 0);
        $wire.sumSalida = isNaN(total) ? this.makeFloat($wire.totalSalidas) : this.makeFloat($wire.totalSalidas) + total;
    },
    actualizarSobrantes(e, index) {
        let precio = this.makeFloat($wire.items[index].precio);
        let cantidad = this.makeFloat(e.target.value);
        $wire.items[index].importe_sobrante = this.makeFloat(precio * cantidad);

        let total = $wire.items.reduce((total, item) => total + this.makeFloat(item.importe_sobrante), 0);

        $wire.sumSobrante = isNaN(total) ? this.makeFloat($wire.totalSobrante) : total + this.makeFloat($wire.totalSobrante);
    }
}">
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
                       x-text="() => `$${parseFloat($wire.sumExistencia).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Entrada</strong>
                    <p class="h4" x-text="() => `$${parseFloat($wire.sumEntrada).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Salida</strong>
                    <p class="h4" x-text="() => `$${parseFloat($wire.sumSalida).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Sobrante</strong>
                    <p class="h4" x-text="() => `$${parseFloat($wire.sumSobrante).toLocaleString()}`"></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-muted">Gastos</strong>
                    <p class="h4" x-text="() => `$${parseFloat($wire.sumGastos).toLocaleString()}`"></p>
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
                                type="search"
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
                                    <tr wire:key="{{$i}}">
                                        <td>{{$item['producto']}}</td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="items.{{$i}}.precio"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                before="$"
                                                @input="e => actualizarPrecios(e, {{$i}})"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="items.{{$i}}.cantidad_existencia"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                after="kg"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                id="importe-existencia-{{$i}}"
                                                wire:model="items.{{$i}}.importe_existencia"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <x-empty/>
                                        </td>
                                    </tr>
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
                                type="search"
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
                                                wire:model="items.{{$i}}.precio"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="items.{{$i}}.cantidad_entrada"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                after="kg"
                                                @input="e => actualizarEntradas(e, {{$i}})"
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
                                                before="$"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <x-empty/>
                                        </td>
                                    </tr>
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
                            <x-table.table>
                                <x-slot:header>
                                    <x-table.th>Producto</x-table.th>
                                    <x-table.th>Sucursal de origen</x-table.th>
                                    <x-table.th style="text-align: right;">Precio</x-table.th>
                                    <x-table.th style="text-align: right;">Cantidad</x-table.th>
                                    <x-table.th style="text-align: right;">Total</x-table.th>
                                </x-slot:header>
                                @forelse($this->entradas as $entrada)
                                    <tr>
                                        <td>{{$entrada->producto->nombre}}</td>
                                        <td>{{$entrada->sucursalOrigen->nombre}}</td>
                                        <td style="text-align: right;"
                                            x-text="$wire.items.find(i => i.producto_id === {{$entrada->producto_id}}).precio"></td>
                                        <td style="text-align: right;">@amount($entrada->cantidad)</td>
                                        <td style="text-align: right;"
                                            x-text="$wire.items.find(i => i.producto_id === {{$entrada->producto_id}}).precio * {{$entrada->cantidad}}"></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-empty/>
                                        </td>
                                    </tr>
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
                                @input="(e) => searchOnTable(e, 'salida-table')"
                                type="search"
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
                                                wire:model="items.{{$i}}.precio"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="items.{{$i}}.cantidad_salida"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                after="kg"
                                                @input="e => actualizarSalidas(e, {{$i}})"
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
                                                before="$"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <x-empty/>
                                        </td>
                                    </tr>
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
                                    <x-table.th>Producto</x-table.th>
                                    <x-table.th>Cantidad</x-table.th>
                                    <x-table.th>Precio</x-table.th>
                                    <x-table.th>Total</x-table.th>
                                    <x-table.th>Sucursal destino</x-table.th>
                                </x-slot:header>
                                @forelse($this->salidas as $salida)
                                    <tr>
                                        <td>{{$salida->producto->nombre}}</td>
                                        <td>@amount($salida->cantidad)</td>
                                        <td>@money($salida->precio)</td>
                                        <td>@money($salida->total)</td>
                                        <td>{{$salida->sucursalDestino->nombre}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <x-empty/>
                                        </td>
                                    </tr>
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(4)">Atrás</x-button>
                            <x-button wire:click.prevent="step5">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 6">
                        <div class="col-12">
                            <x-table.table>
                                <x-slot:header>
                                    <x-table.th>Producto</x-table.th>
                                    <x-table.th>Cantidad</x-table.th>
                                    <x-table.th>Precio</x-table.th>
                                    <x-table.th>Total</x-table.th>
                                </x-slot:header>
                                @forelse($mayoreos as $mayoreo)
                                    <tr>
                                        <td>{{$mayoreo->producto->nombre}}</td>
                                        <td>@amount($mayoreo->cantidad)</td>
                                        <td>@money($mayoreo->precio)</td>
                                        <td>@money($mayoreo->total)</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <x-empty/>
                                        </td>
                                    </tr>
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(5)">Atrás</x-button>
                            <x-button wire:click.prevent="step6">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 7">
                        <div class="col-12">
                            <x-form.input
                                label="Buscar producto"
                                @input="(e) => searchOnTable(e, 'sobrante-table')"
                                type="search"
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
                                    </tr>
                                </x-slot:header>
                                @forelse($this->items as $i => $item)
                                    <tr>
                                        <td>{{$item['producto']}}</td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="items.{{$i}}.precio"
                                                type="number"
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="items.{{$i}}.cantidad_sobrante"
                                                type="number"
                                                step="0.01"
                                                after="kg"
                                                @input="e => actualizarSobrantes(e, {{$i}})"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                id="importe-sobrante-{{$i}}"
                                                wire:model="items.{{$i}}.importe_sobrante"
                                                type="number"
                                                label=""
                                                step="0.01"
                                                disabled
                                                before="$"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <x-empty/>
                                        </td>
                                    </tr>
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(6)">Atrás</x-button>
                            <x-button wire:click.prevent="step7">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 8">
                        <div class="col-12">
                            <x-table.table>
                                <x-slot:header>
                                    <tr>
                                        <x-table.th>Concepto</x-table.th>
                                        <x-table.th>Precio</x-table.th>
                                        <x-table.th></x-table.th>
                                    </tr>
                                </x-slot:header>
                                @forelse($this->gastos as $i => $gasto)
                                    <tr>
                                        <td>
                                            <x-form.input-table
                                                wire:model="gastos.{{$i}}.concepto"
                                            />
                                        </td>
                                        <td>
                                            <x-form.input-table
                                                wire:model="gastos.{{$i}}.precio"
                                                id="gastos-precio-{{$i}}"
                                                before="$"
                                                @input="(e) => {
                                                    $wire.sumGastos = $wire.gastos.reduce((total, gasto) => total + makeFloat(gasto.precio), 0);
                                                }"
                                            />
                                        </td>
                                        <td>
                                            <x-button @click.prevent="$wire.addGasto()">+</x-button>
                                            @if(!$loop->first)
                                                <x-button @click.prevent="(e) => {
                                                    $wire.removeGasto({{$i}});
                                                    $wire.$refresh();
                                                    $wire.sumGastos = $wire.gastos.reduce((total, gasto) => total + makeFloat(gasto.precio), 0);
                                                }">-
                                                </x-button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <x-empty/>
                                        </td>
                                    </tr>
                                @endforelse
                            </x-table.table>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(7)">Atrás</x-button>
                            <x-button wire:click.prevent="step8">Siguiente</x-button>
                        </div>
                    </div>
                    <div class="row" x-show="$wire.step === 9">
                        <strong>Existencia anterior</strong>
                        <p x-text="$wire.sumExistencia"></p>
                        <strong>Entradas</strong>
                        <p x-text="$wire.sumEntrada"></p>
                        <strong>Total Entradas</strong>
                        <p x-text="makeFloat($wire.sumEntrada) + makeFloat($wire.sumExistencia)"></p>
                        <strong>Salidas</strong>
                        <p x-text="$wire.sumSalida"></p>
                        <strong>Sobrante</strong>
                        <p x-text="$wire.sumSobrante"></p>
                        <strong>Gastos</strong>
                        <p x-text="$wire.sumGastos"></p>
                        <strong>Total</strong>
                        <p x-text="makeFloat($wire.sumExistencia)+makeFloat($wire.sumEntrada)-makeFloat($wire.sumSalida)-makeFloat($wire.sumSobrante)-makeFloat($wire.sumGastos)"></p>
                        {{-- <div class="col-12">
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

                         </div>--}}
                        <div class="col-12 col-md-6">
                            <x-form.input
                                wire:model="efectivo"
                                type="number"
                                step="0.01"
                                label="Efectivo"
                            />
                        </div>
                        <div class="col-12 col-md-6">
                            <x-form.input
                                label="Efectivo marinados"
                                wire:model="efectivoMarinado"
                                type="number"
                                step="0.01"
                            />
                        </div>
                        <div class="col-12">
                            <div
                                class="card"
                                {{--:class="{
                                   'bg-success': calcularTotal() === 0,
                                   'bg-danger': calcularTotal() < 0,
                                   'bg-info': calcularTotal() > 0
                               }"--}}
                            >
                                <div class="card-body">
                                    {{-- <p x-text="() => {
                                         let total = calcularTotal().toFixed(2);
                                         if(parseFloat(total) > 0) return `Saldo a favor: $${total}`
                                         if(parseFloat(total) < 0) return `Adeuda: $${total}`
                                         if(parseFloat(total) === 0) return `Cuenta correcta: $${total}`
                                     }"
                                        class="text-muted m-0"></p>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-3">
                            <x-button theme="outline-primary" wire:click.prevent="back(8)">Atrás</x-button>
                            <x-button type="submit">Registrar</x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @vite(['resources/js/form.js'])
</div>

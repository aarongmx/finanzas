<form wire:submit.prevent="store" class="p-4" x-data="{totalExistencia:0, totalEntrada: 0, totalSalida:0, totalSobrante:0}">
    <div class="row">
        <div class="col-12">
            <h1 class="h3">Cuentas</h1>
        </div>
    </div>
    <div class="grid">
        @forelse($this->steps as $i => $step)
            <p class="badge text-center mb-0"
               :class="$wire.step === {{$i}} ? 'text-bg-primary' : 'text-bg-light'">{{$step}}</p>
            @if(!$loop->last)
                <hr>
            @endif
        @empty
        @endforelse
    </div>
    <div>
        <div class="row">
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
        </div>
        <div class="row" x-show="$wire.step === 1">
            <table class="table table-hover"
            >
                <thead class="table-primary">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Existencia</th>
                    <th>Importe Existencia</th>
                </tr>
                </thead>
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
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td x-text="totalEntrada"></td>
                    <td></td>
                    <td x-text="totalSalida"></td>
                    <td></td>
                    <td x-text="totalSobrante"></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="row" x-show="$wire.step === 2">
            <div class="col-12 table-responsive overflow-x-scroll" style="max-height: 70vh;">
                <table class="table table-hover"
                >
                    <thead class="table-primary">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Entrada</th>
                        <th>Importe Entrada</th>
                    </tr>
                    </thead>
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
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td x-text="totalEntrada"></td>
                        <td></td>
                        <td x-text="totalSalida"></td>
                        <td></td>
                        <td x-text="totalSobrante"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 3">
            <div class="col-12 table-responsive overflow-x-scroll" style="max-height: 70vh;">
                <table class="table table-hover">
                    <thead class="table-primary">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Salida</th>
                        <th>Importe Salida</th>
                    </tr>
                    </thead>
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
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td x-text="totalEntrada"></td>
                        <td></td>
                        <td x-text="totalSalida"></td>
                        <td></td>
                        <td x-text="totalSobrante"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row" x-show="$wire.step === 4">
            <div class="col-12 table-responsive overflow-x-scroll" style="max-height: 70vh;">
                <table class="table table-hover" >
                    <thead class="table-primary">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Sobrante</th>
                            <th>Importe Sobrante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->items as $i => $item)
                        <tr>
                            <td>{{$item['producto']}}</td>
                            <td>
                                <x-form.input-table wire:model="items.{{$i}}.precio" type="number" label="" step="0.01"
                                    disabled />
                            </td>
                            <td>
                                <x-form.input-table wire:model="items.{{$i}}.cantidad_sobrante" type="number" label="" step="0.01"
                                    @input="(e) => {
                                                const inputs = Array.from(document.querySelectorAll('[id^=importe-sobrante-]'));
                                                totalSobrante = inputs.map(input => parseFloat(input.value).toFixed(2)).reduce((acc, value) => acc + parseFloat(value), 0)
                                            }" />
                            </td>
                            <td>
                                <x-form.input-table id="importe-sobrante-{{$i}}" wire:model="items.{{$i}}.importe_sobrante"
                                    type="number" label="" step="0.01" disabled
                                    x-bind:value="$wire.get('items.{{$i}}.precio') * $wire.get('items.{{$i}}.cantidad_sobrante')" />
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td x-text="totalEntrada"></td>
                            <td></td>
                            <td x-text="totalSalida"></td>
                            <td></td>
                            <td x-text="totalSobrante"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <p x-text="totalExistencia"></p>
        </div>
        <div class="col-3">
            <p x-text="totalEntrada"></p>
        </div>
        <div class="col-3">
            <p x-text="totalSalida"></p>
        </div>
        <div class="col-3">
            <p x-text="totalSobrante"></p>
        </div>
    </div>
   {{-- <div x-show="$wire.step === 2">
        <div class="row">
            <div class="col-12">
                <h1>jsakdj</h1>
            </div>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-12">
            <x-button x-show="$wire.step > 1" x-on:click="$wire.step = $wire.step-1" theme="outline-primary">Atrás
            </x-button>
            <x-button x-on:click="$wire.step = $wire.step+1">Siguiente</x-button>
            <x-button wire:click.prevent="step1">Siguiente</x-button>
        </div>
    </div>
    <x-button type="submit">Registrar</x-button>
</form>

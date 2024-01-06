<div class="container-fluid">
    <div class="row my-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-8 d-flex align-items-center">
                            <h1 class="h2 m-0">{{$this->cuenta->sucursal->nombre}}</h1>
                        </div>
                        <div class="col-12 col-lg-2">
                            <strong>Fecha de venta</strong>
                            <p>{{$this->cuenta->fecha_venta}}</p>
                        </div>
                        <div class="col-12 col-lg-2">
                            <strong>Fecha de captura</strong>
                            <p>{{$this->cuenta->fecha_captura}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-4 my-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <strong>Efectivo de pollo</strong>
                    <p class="m-0">@money($this->cuenta->efectivo_pollo)</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <strong>Efectivo de marinado</strong>
                    <p class="m-0">@money($this->cuenta->efectivo_marinado)</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <strong>Efectivo total</strong>
                    <p class="m-0">@money($this->cuenta->efectivo_total)</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <strong>Saldo</strong>
                    <p class="m-0">@money($this->cuenta->saldo)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-lg-4">
            <h2 class="h4 text-muted">Entradas</h2>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Sucursal origen</th>
                            <th style="text-align: right;">Precio</th>
                            <th style="text-align: right;">Cantidad</th>
                        </tr>
                        </thead>
                        @forelse($this->cuenta->entradas as $entrada)
                            <tr>
                                <td>{{$entrada->producto->nombre}}</td>
                                <td>{{$entrada->sucursalOrigen->nombre}}</td>
                                <td style="text-align: right;">@money($entrada->precio)</td>
                                <td style="text-align: right;">@amount($entrada->cantidad)</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <h2 class="h4 text-muted">Gastos</h2>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Concepto</th>
                            <th style="text-align: right;">Precio</th>
                        </tr>
                        </thead>
                        @forelse($this->cuenta->gastosFijos as $gasto)
                            <tr>
                                <td>{{$gasto->concepto}}</td>
                                <td style="text-align: right;">@money($gasto->precio)</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <h2 class="h4 text-muted">Salidas</h2>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Sucursal destino</th>
                            <th style="text-align: right;">Precio</th>
                            <th style="text-align: right;">Cantidad</th>
                            <th style="text-align: right;">Total</th>
                        </tr>
                        </thead>
                        @forelse($this->cuenta->salidas as $salida)
                            <tr>
                                <td>{{$salida->producto->nombre}}</td>
                                <td>{{$salida->sucursalDestino->nombre}}</td>
                                <td style="text-align: right;">@money($salida->precio)</td>
                                <td style="text-align: right;">@money($salida->cantidad)</td>
                                <td style="text-align: right;">@money($salida->total)</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="h4 text-muted">Productos</h2>
            <x-table.table>
                <x-slot:header>
                    <x-table.th>Producto</x-table.th>
                    <x-table.th>Precio</x-table.th>
                    <x-table.th>Cantidad anterior</x-table.th>
                    <x-table.th>Existencia anterior</x-table.th>
                    <x-table.th>Cantidad entrada</x-table.th>
                    <x-table.th>Importe entrada</x-table.th>
                    <x-table.th>Cantidad salida</x-table.th>
                    <x-table.th>Importe salida</x-table.th>
                    <x-table.th>Cantidad sobrante</x-table.th>
                    <x-table.th>Importe sobrante</x-table.th>
                </x-slot:header>
                @forelse($this->cuenta->itemsCuenta as $item)
                    <tr>
                        <td>{{$item->producto->nombre}}</td>
                        <td>@money($item->precio)</td>
                        <td>@weight($item->cantidad_existencia)</td>
                        <td>@money($item->importe_existencia)</td>
                        <td>@weight($item->cantidad_entrada)</td>
                        <td>@money($item->importe_entrada)</td>
                        <td>@weight($item->cantidad_salida)</td>
                        <td>@money($item->importe_salida)</td>
                        <td>@weight($item->cantidad_sobrante)</td>
                        <td>@money($item->importe_sobrante)</td>
                    </tr>
                @empty
                @endforelse
            </x-table.table>
        </div>
    </div>
</div>

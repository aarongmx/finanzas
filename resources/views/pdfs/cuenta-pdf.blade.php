<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            font-family: sans-serif;
            font-size: 0.8rem;
        }

        header {
            position: fixed;
            left: -50px;
            top: -150px;
            right: -50px;
            height: 80px;
            padding: 25px 50px 25px 50px;
            text-align: left;
        }

        table {
            width: 100%;
            border: 1px none black;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 0.25rem;
        }

        th {
            background-color: rgb(209 213 219);
            text-align: left;
            text-transform: uppercase;
            color: rgb(55 65 81);
        }

        th,
        td {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            line-height: 1rem;
        }

        tr:nth-child(even) {
            background-color: rgb(243 244 246);
        }

        .td-right {
            text-align: right;
        }

        .title {
            display: block;
        }

        main {
            min-height: calc(100% - 80px);
        }

        p {
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .red-text {
            color: rgb(192, 0, 0);
        }

        .mb-0 {
            margin-bottom: 0;
        }

        footer {
            font-size: 0.75rem;
            line-height: 1.5;
            padding: 1rem 1.5rem;
            margin: 0;
            left: -50px;
            right: -50px;
            bottom: -25px;
            height: 100px;
        }
    </style>
</head>
<body>
<p>Grupo Comercial ML</p>
<h1>{{$cuenta->sucursal->nombre}}</h1>
<strong>Fecha de venta</strong>
<p>{{$cuenta->fecha_venta}}</p>

<strong>Fecha de captura</strong>
<p>{{$cuenta->fecha_captura}}</p>

<h3>Pollo</h3>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th colspan="2">Existencia</th>
        <th colspan="2">Entrada</th>
        <th colspan="2">Salida</th>
        <th colspan="2">Sobrante</th>
    </tr>
    <tr>
        <th>Producto</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->itemsCuenta as $item)
        <tr>
            <td>{{$item->producto->nombre}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    <tr>
        <td></td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_existencia'))
        </td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_entrada'))
        </td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_salida'))
        </td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_sobrante'))
        </td>
    </tr>
    </tbody>
</table>

<h3>Marinados</h3>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th colspan="2">Existencia</th>
        <th colspan="2">Entrada</th>
        <th colspan="2">Salida</th>
        <th colspan="2">Sobrante</th>
    </tr>
    <tr>
        <th>Producto</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
        <th style="text-align: right;">Cantidad</th>
        <th style="text-align: right;">Importe</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->itemsCuenta as $item)
        <tr>
            <td>{{$item->producto->nombre}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    <tr>
        <td></td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_existencia'))
        </td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_entrada'))
        </td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_salida'))
        </td>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->itemsCuenta->sum('importe_sobrante'))
        </td>
    </tr>
    </tbody>
</table>
<h3>Entradas</h3>
<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th class="td-right">Precio</th>
        <th class="td-right">Cantidad</th>
        <th>Sucursal origen</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->entradas as $entrada)
        <tr>
            <td>{{$entrada->producto->nombre}}</td>
            <td class="td-right">$@amount($entrada->precio)</td>
            <td class="td-right">@amount($entrada->cantidad)</td>
            <td>{{$entrada->sucursalOrigen->nombre}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    <tr>
        <td class="td-right" colspan="100%">
            TOTAL: $@amount($cuenta->entradas->sum('precio'))
        </td>
    </tr>
    </tbody>
</table>

<h3>Salidas</h3>
<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Sucursal destino</th>
        <th class="td-right">Cantidad</th>
        <th class="td-right">Precio unitario</th>
        <th class="td-right">Total</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->salidas as $salida)
        <tr>
            <td>{{$salida->producto->nombre}}</td>
            <td>{{$salida->sucursalDestino->nombre}}</td>
            <td class="td-right">@amount($salida->cantidad)</td>
            <td class="td-right">$@amount($salida->precio)</td>
            <td class="td-right">$@amount($salida->total)</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    <tr>
        <td class="td-right" colspan="100%">
            TOTAL: $@amount($cuenta->salidas->sum('total'))
        </td>
    </tr>
    </tbody>
</table>

<h3>Gastos</h3>
<table class="table">
    <thead>
    <tr>
        <th>Concepto</th>
        <th class="td-right">Monto</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->gastosFijos as $gasto)
        <tr>
            <td>{{$gasto->concepto}}</td>
            <td class="td-right">$@amount($gasto->precio)</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    <tr>
        <td class="td-right" colspan="2">
            TOTAL: $@amount($cuenta->gastosFijos->sum('precio'))
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>

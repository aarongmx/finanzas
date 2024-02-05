<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
        <th>Cantidad</th>
        <th>Importe</th>
        <th>Cantidad</th>
        <th>Importe</th>
        <th>Cantidad</th>
        <th>Importe</th>
        <th>Cantidad</th>
        <th>Importe</th>
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
        <th>Cantidad</th>
        <th>Importe</th>
        <th>Cantidad</th>
        <th>Importe</th>
        <th>Cantidad</th>
        <th>Importe</th>
        <th>Cantidad</th>
        <th>Importe</th>
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
    </tbody>
</table>
<h3>Entradas</h3>
<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Sucursal origen</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->entradas as $entrada)
        <tr>
            <td>{{$entrada->producto->nombre}}</td>
            <td>{{$entrada->precio}}</td>
            <td>{{$entrada->cantidad}}</td>
            <td>{{$entrada->sucursalOrigen->nombre}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

<h3>Salidas</h3>
<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio salida</th>
        <th>Sucursal destino</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->salidas as $salida)
        <tr>
            <td>{{$salida->producto->nombre}}</td>
            <td>{{$salida->cantidad}}</td>
            <td>{{$salida->precio}}</td>
            <td>{{$salida->sucursalDestino->nombre}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

<h3>Gastos</h3>
<table class="table">
    <thead>
    <tr>
        <th>Concepto</th>
        <th>Monto</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cuenta->gastosFijos as $gasto)
        <tr>
            <td>{{$gasto->concepto}}</td>
            <td>{{$gasto->precio}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                No hay registros
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>

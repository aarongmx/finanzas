<table class="table table-striped-columns table-hover">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad existencia</th>
            <th>Importe existencia</th>
            <th>Cantidad entrada</th>
            <th>Importe entrada</th>
            <th>Cantidad salida</th>
            <th>Importe salida</th>
            <th>Cantidad sobrante</th>
            <th>Importe sobrante</th>
        </tr>
    </thead>
    <tbody>
    @forelse($row->itemsCuenta as $itemCuenta)
        <tr wire:key="{{$itemCuenta->id}}">
            <td>{{$itemCuenta->producto->nombre}}</td>
            <td>${{number_format($itemCuenta->precio,2)}}</td>
            <td>{{number_format($itemCuenta->cantidad_existencia,2)}}</td>
            <td>${{number_format($itemCuenta->importe_existencia,2)}}</td>
            <td>{{number_format($itemCuenta->cantidad_entrada,2)}}</td>
            <td>${{number_format($itemCuenta->importe_entrada,2)}}</td>
            <td>{{number_format($itemCuenta->cantidad_salida,2)}}</td>
            <td>${{number_format($itemCuenta->importe_salida,2)}}</td>
            <td>{{number_format($itemCuenta->cantidad_sobrante,2)}}</td>
            <td>${{number_format($itemCuenta->importe_sobrante,2)}}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>

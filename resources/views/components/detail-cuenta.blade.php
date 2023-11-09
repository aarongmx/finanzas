<div>
    @forelse($row->itemsCuenta->producto->groupBy('categoria_id') as $itemCuenta)
        <div wire:key="{{$itemCuenta->id}}">
            <p>Producto: {{$itemCuenta->producto->nombre}}</p>
            <p>Precio: ${{number_format($itemCuenta->precio,2)}}</p>
        </div>
    @empty
    @endforelse
</div>

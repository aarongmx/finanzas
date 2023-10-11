<?php

namespace Domain\Productos\Actions;

use App\Models\Producto;
use Domain\Productos\Data\ProductoData;

class RegistrarProductoAction
{
    public function __invoke(ProductoData $productoData): Producto
    {
        return Producto::query()->create($productoData->toArray());
    }
}

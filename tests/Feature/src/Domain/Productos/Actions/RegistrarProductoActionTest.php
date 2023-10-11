<?php

use App\Models\Categoria;
use Domain\Productos\Actions\RegistrarProductoAction;
use Domain\Productos\Data\ProductoData;

test('Se guarda un producto', function () {
    $categoria = Categoria::factory()->create();
    $productoData = ProductoData::from([
        'nombre' => 'Ala chilena',
        'categoriaId' => $categoria->id,
    ]);

    $producto = (new RegistrarProductoAction())($productoData);

    expect($producto)->toExist();
});

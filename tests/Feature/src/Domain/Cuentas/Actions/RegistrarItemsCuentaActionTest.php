<?php

use App\Models\Cuenta;
use App\Models\Producto;
use Domain\Cuentas\Actions\RegistrarItemsCuentaAction;
use Domain\Cuentas\Data\ItemCuentaData;

test('Se registran correctamente los items de la cuenta ', function() {
    $cuenta = Cuenta::factory()->create();
    $producto1 = Producto::factory()->create();
    $producto2 = Producto::factory()->create();

    $items = ItemCuentaData::collection([
        ItemCuentaData::from([
            'precio' => 45.5,
            'cantidadExistencia' => 1,
            'importeExistencia' => 45.5,
            'cantidadEntrada' => 2,
            'importeEntrada' => 91,
            'cantidadSalida' => 0,
            'importeSalida' => 0,
            'cantidadSobrante' => 0,
            'importeSobrante' => 0,
            'productoId' => $producto1->id,
            'cuentaId' => $cuenta->id,
        ]),
        ItemCuentaData::from([
            'precio' => 50.5,
            'cantidadExistencia' => 1,
            'importeExistencia' => 50.5,
            'cantidadEntrada' => 2,
            'importeEntrada' => 101,
            'cantidadSalida' => 0,
            'importeSalida' => 0,
            'cantidadSobrante' => 0,
            'importeSobrante' => 0,
            'productoId' => $producto2->id,
            'cuentaId' => $cuenta->id,
        ]),
    ]);

    (new RegistrarItemsCuentaAction())($items, $cuenta->id);

    expect($items)->sequence(
        fn($item) => expect($item->value->toArray())->toBeInDatabase('item_cuentas'),
        fn($item) => expect($item->value->toArray())->toBeInDatabase('item_cuentas'),
    );
});

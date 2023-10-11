<?php

use App\Models\Producto;
use App\Models\Sucursal;
use Domain\Cuentas\Actions\RegistrarCuentaAction;
use Domain\Cuentas\Actions\RegistrarItemsCuentaAction;
use Domain\Cuentas\Data\CuentaData;
use Domain\Cuentas\Data\ItemCuentaData;

test('Se registra correctamente la cuenta', function () {
    $sucursal = Sucursal::factory()->create();
    $producto1 = Producto::factory()->create();
    $producto2 = Producto::factory()->create();

    $cuentaData = new CuentaData(
        100.0,
        10.0,
        $sucursal->id,
        ItemCuentaData::collection([
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
                'productoId' => $producto1->id
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
                'productoId' => $producto2->id
            ]),
        ])
    );

    $cuenta = (new RegistrarCuentaAction((new RegistrarItemsCuentaAction())))($cuentaData);


    logger($cuenta->load(['itemsCuenta']));

    expect($cuenta)->toExist();
});

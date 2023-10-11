<?php

use App\Models\Sucursal;
use Domain\Cuentas\Actions\RegistrarCuentaAction;
use Domain\Cuentas\Data\CuentaData;

test('Se registra correctamente la cuenta', function () {
    $sucursal = Sucursal::factory()->create();
    $cuentaData = new CuentaData(100.0, 10.0, $sucursal->id);

    $cuenta = (new RegistrarCuentaAction())($cuentaData);

    expect($cuenta)->toExist();
});

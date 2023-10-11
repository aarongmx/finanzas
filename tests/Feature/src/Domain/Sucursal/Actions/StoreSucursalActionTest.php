<?php

use App\Models\Direccion;
use Domain\Sucursal\Actions\StoreSucursalAction;
use Domain\Sucursal\Data\SucursalData;

test('Se guarda correctamente la suscursal', function () {
    $direccion = Direccion::factory()->create();

    $sucursalData = SucursalData::from([
       'nombre' => 'Sucursal 1',
       'direccionId' => $direccion->id,
    ]);

    $sucursal = (new StoreSucursalAction())($sucursalData);

    expect($sucursal)->toExist();
});

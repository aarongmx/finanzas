<?php

use App\Models\Direccion;
use App\Models\Sucursal;
use Domain\Clientes\Actions\RegistrarClienteAction;
use Domain\Clientes\Data\ClienteData;

test('Se valida que se pueda crear un cliente', function () {
    $sucursal = Sucursal::factory()->create();
    $direccion = Direccion::factory()->create();

    $data = ClienteData::from([
        'rfc' => 'goma971007bd8',
        'razonSocial' => 'Aaron',
        'nombreComercial' => 'Aaron',
        'direccionId' => $direccion->id,
        'sucursalId' => $sucursal->id,
    ]);
    $cliente = (new RegistrarClienteAction)($data);

    expect($cliente)->toExist();
});

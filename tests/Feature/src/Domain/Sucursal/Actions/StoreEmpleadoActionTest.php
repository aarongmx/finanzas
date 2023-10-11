<?php

use App\Models\Sucursal;
use App\Models\User;
use Domain\Sucursal\Actions\StoreEmpleadoAction;
use Domain\Sucursal\Data\EmpleadoData;

test('Se puede guardar un empleado', function(){
   $user = User::factory()->create();
   $sucursal = Sucursal::factory()->create();

   $empleadoData = EmpleadoData::from([
       'nombre' => 'Aarón',
       'apellidoPaterno' => 'Gómez',
       'sucursalId' => $sucursal->id,
       'userId' => $user->id,
   ]);

    $empleado = (new StoreEmpleadoAction())($empleadoData);

    expect($empleado)->toExist();
});

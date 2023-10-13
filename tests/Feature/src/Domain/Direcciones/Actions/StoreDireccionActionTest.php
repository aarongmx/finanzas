<?php

use Domain\Direcciones\Actions\StoreDireccionAction;
use Domain\Direcciones\Data\DireccionData;

test('Se puede registrar una nueva direccion', function (){
   $direccionData = DireccionData::from(['codigoPostal' => '09660']);

   $direccion = (new StoreDireccionAction)($direccionData);

   expect($direccion)->toExist();
});

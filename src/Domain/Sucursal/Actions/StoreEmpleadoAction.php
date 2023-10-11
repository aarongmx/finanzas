<?php

namespace Domain\Sucursal\Actions;

use App\Models\Empleado;
use Domain\Sucursal\Data\EmpleadoData;

class StoreEmpleadoAction
{
    public function __invoke(EmpleadoData $empleadoData): Empleado
    {
        return Empleado::query()->create($empleadoData->toArray());
    }
}

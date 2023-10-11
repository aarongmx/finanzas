<?php

namespace Domain\Sucursal\Actions;

use App\Models\Sucursal;
use Domain\Sucursal\Data\SucursalData;

class StoreSucursalAction
{
    public function __invoke(SucursalData $sucursalData): Sucursal
    {
        return Sucursal::query()->create($sucursalData->toArray());
    }

}

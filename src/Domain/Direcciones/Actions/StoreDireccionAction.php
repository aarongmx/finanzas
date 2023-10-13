<?php

namespace Domain\Direcciones\Actions;

use App\Models\Direccion;
use Domain\Direcciones\Data\DireccionData;

class StoreDireccionAction
{
    public function __invoke(DireccionData $direccionData): Direccion
    {
        return Direccion::updateOrCreate([
            'id' => $direccionData->id ?? null,
        ], [
            ...$direccionData->all(),
        ]);
    }

}

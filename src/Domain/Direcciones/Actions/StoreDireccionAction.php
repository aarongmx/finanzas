<?php

namespace Domain\Direcciones\Actions;

use App\Models\Direccion;
use Tests\Feature\src\Domain\Direcciones\Actions\DireccionData;

class StoreDireccionAction
{
    public function __invoke(DireccionData $direccionData)
    {
        return Direccion::updateOrCreate([
            'id' => $direccionData->id ?? null,
        ], [
            ...$direccionData->all(),
        ]);
    }

}

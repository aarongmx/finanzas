<?php

namespace Domain\Clientes\Actions;

use App\Models\Cliente;
use Domain\Clientes\Data\ClienteData;

class RegistrarClienteAction
{
    public function __invoke(ClienteData $clienteData): Cliente
    {
        return Cliente::query()->updateOrCreate([
            'id' => $clienteData->id ?? null,
        ], [
            ...$clienteData->all(),
        ]);
    }
}

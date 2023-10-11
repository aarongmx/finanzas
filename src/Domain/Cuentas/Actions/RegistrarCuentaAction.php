<?php

namespace Domain\Cuentas\Actions;

use App\Models\Cuenta;
use Domain\Cuentas\Data\CuentaData;

class RegistrarCuentaAction
{
    public function __invoke(CuentaData $data): Cuenta
    {
        return Cuenta::query()->create($data->toArray());
    }
}

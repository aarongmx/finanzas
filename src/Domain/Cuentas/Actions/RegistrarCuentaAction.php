<?php

namespace Domain\Cuentas\Actions;

use App\Models\Cuenta;
use Domain\Cuentas\Data\CuentaData;

class RegistrarCuentaAction
{


    public function __construct(
        public readonly RegistrarItemsCuentaAction $registrarItemsCuentaAction
    )
    {
    }

    public function __invoke(CuentaData $data): Cuenta
    {
        $cuenta = Cuenta::query()->create($data->except('items')->toArray());

        ($this->registrarItemsCuentaAction)($data->items, $cuenta->id);
        return $cuenta;
    }
}

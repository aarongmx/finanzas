<?php

namespace Domain\Cuentas\Actions;

use App\Models\ItemCuenta;
use Domain\Cuentas\Data\ItemCuentaData;
use Spatie\LaravelData\DataCollection;

class RegistrarItemsCuentaAction
{
    public function __invoke(
        DataCollection $dataCollection,
        int            $cuentaId,
    ): void
    {
        $dataCollection->each(function (ItemCuentaData $item) use (&$cuentaId) {
            ItemCuenta::create([
                ...$item->toArray(),
                'cuenta_id' => $cuentaId,
            ]);
        });
    }
}

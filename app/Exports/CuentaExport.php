<?php

namespace App\Exports;

use App\Models\Cuenta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CuentaExport implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(public int $cuentaId)
    {
    }

    public function map($cuenta): array
    {
        $cuenta->load(
            [
                'itemsCuenta' => [
                    'producto'
                ],
                'gastosFijos',
                'salidas' => [
                    'producto',
                    'sucursalDestino',
                ],
                'sucursal',
                'entradas' => [
                    'producto',
                    'sucursalOrigen',
                ],
            ]
        );

        ray($cuenta);
        $items = $cuenta->itemsCuenta->map(function ($i) {
            return [$i->producto->nombre];
        })->toArray();

        $entradas = $cuenta->entradas->map(function ($e) {
            return [$e->precio, $e->cantidad, $e->sucursalOrigen->nombre];
        })->toArray();

        return [
            $cuenta->sucursal->nombre,
            $items,
            ...$entradas,
        ];
    }

    public function query()
    {
        return Cuenta::query()
            ->with([
                'itemsCuenta' => [
                    'producto'
                ],
                'gastosFijos',
                'salidas' => [
                    'producto',
                    'sucursalDestino',
                ],
                'sucursal',
                'entradas' => [
                    'producto',
                    'sucursalOrigen',
                ],
            ])
            ->find($this->cuentaId);
    }

    public function headings(): array
    {
        return [
            ['Sucursal',],
            ['Precio', 'Cantidad', 'Importe', 'Cantidad', 'Importe', 'Cantidad', 'Importe'],
            ['Precio', 'Cantidad', 'Sucursal origen'],
        ];
    }
}

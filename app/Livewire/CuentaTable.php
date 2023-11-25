<?php

namespace App\Livewire;

use App\Models\Cuenta;
use App\Models\Sucursal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CuentaTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Detail::make()
                ->view('components.detail-cuenta')
                ->showCollapseIcon()
        ];
    }

    public function datasource(): Builder
    {
        return Cuenta::query()
            ->with([
                'sucursal',
                'itemsCuenta' => [
                    'producto' => [
                        'categoria',
                    ],
                ],
            ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('efectivo_formated', fn(Cuenta $model) => "$" . e(number_format($model->efectivo, 2)))
            ->addColumn('a_cuenta_formated', fn(Cuenta $model) => "$" . e(number_format($model->a_cuenta, 2)))
            ->addColumn('sucursal_id', fn(Cuenta $model) => e($model->sucursal?->nombre))
            ->addColumn('fecha_venta_formatted', fn(Cuenta $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
            ->addColumn('created_at_formatted', fn(Cuenta $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Efectivo', 'efectivo_formated', 'efectivo'),
            Column::make('A cuenta', 'a_cuenta_formated', 'a_cuenta'),
            Column::make('Sucursal', 'sucursal_id'),
            Column::make('Fecha Venta', 'fecha_venta_formatted'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
            Filter::select('Sucursal', 'sucursal_id')
                ->dataSource(Sucursal::get())
                ->optionValue('id')
                ->optionLabel('nombre')
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Cuenta $row): array
    {
        return [
            Button::add('edit')
                ->slot("Actualizar")
                ->id()
                ->class('btn btn-outline-primary')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}

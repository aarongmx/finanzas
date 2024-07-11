<?php

namespace App\Livewire;

use App\Models\Cuenta;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
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
                ->showCollapseIcon(),
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

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('efectivo_pollo_formated', fn (Cuenta $model) => '$'.e(number_format($model->efectivo_pollo, 2)))
            ->add('efectivo_marinado_formated', fn (Cuenta $model) => '$'.e(number_format($model->efectivo_marinado, 2)))
            ->add('efectivo_total_formated', fn (Cuenta $model) => '$'.e(number_format($model->efectivo_total, 2)))
            ->add('saldo_formated', fn (Cuenta $model) => '$'.e(number_format($model->saldo, 2)))
            ->add('sucursal_id', fn (Cuenta $model) => e($model->sucursal?->nombre))
            ->add('fecha_venta_formatted', fn (Cuenta $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
            ->add('created_at_formatted', fn (Cuenta $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->add('link', fn (Cuenta $model) => "<a class='link-underline-light' href='".route('administracion.cuentas.show', ['cuenta' => $model])."'>Mostrar</a>");
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Efectivo Pollo', 'efectivo_pollo_formated', 'efectivo_pollo'),
            Column::make('Efectivo Marinado', 'efectivo_marinado_formated', 'efectivo_marinado'),
            Column::make('Total', 'efectivo_total_formated', 'efectivo_total'),
            Column::make('Saldo', 'saldo_formated', 'saldo'),
            Column::make('Sucursal', 'sucursal_id'),
            Column::make('Fecha Venta', 'fecha_venta_formatted'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),
            Column::make('Mostrar cuenta', 'link'),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
            Filter::select('Sucursal', 'sucursal_id')
                ->dataSource(Sucursal::get())
                ->optionValue('id')
                ->optionLabel('nombre'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\Cuenta $row): array
    {
        return [
            Button::add('edit')
                ->slot('Actualizar')
                ->id()
                ->class('btn btn-outline-primary')
                ->dispatch('edit', ['rowId' => $row->id]),
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

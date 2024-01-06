<?php

namespace App\Livewire;

use App\Models\Mayoreo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class MayoreosTable extends PowerGridComponent
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
        ];
    }

    public function datasource(): Builder
    {
        return Mayoreo::query()
            ->with([
                'producto'
            ])
            ->where('sucursal_id', auth()->user()->sucursal_id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('fecha_venta_formatted', fn(Mayoreo $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
            ->addColumn('precio', fn(Mayoreo $mayoreo) => '$' . number_format($mayoreo->precio, 2))
            ->addColumn('cantidad', fn(Mayoreo $mayoreo) => number_format($mayoreo->cantidad, 2). ' kg')
            ->addColumn('total', fn(Mayoreo $mayoreo) => '$'.number_format($mayoreo->total,2))
            ->addColumn('producto_id', fn(Mayoreo $model) => $model->producto->nombre)
            ->addColumn('created_at_formatted', fn(Mayoreo $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ->sortable(),

            Column::make('Cantidad', 'cantidad')
                ->sortable()
                ->searchable(),

            Column::make('Precio', 'precio')
                ->sortable()
                ->searchable(),

            Column::make('Total', 'total')
                ->sortable()
                ->searchable(),

            Column::make('Producto', 'producto_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            //Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_venta'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    /*public function actions(\App\Models\Mayoreo $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('btn btn-p')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }*/

    #[On('refresh')]
    public function refreshData(): void
    {
        $this->fillData();
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

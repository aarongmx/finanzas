<?php

namespace App\Livewire;

use App\Models\Salida;
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

final class SalidasTable extends PowerGridComponent
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
        return Salida::query();
    }

    public function relationSearch(): array
    {
        return [
            'sucursalDestino:id,nombre',
            'producto:id,nombre',
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('precio')
            ->addColumn('cantidad')
            ->addColumn('total')
            ->addColumn('producto_id', fn(Salida $model) => $model->producto->nombre)
            ->addColumn('sucursal_destino_id', fn(Salida $model) => $model->sucursalDestino->nombre)
            ->addColumn('created_at_formatted', fn (Salida $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
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
            Column::make('Sucursal destino', 'sucursal_destino_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }

    #[On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Salida $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('btn btn-outline-primary')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

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

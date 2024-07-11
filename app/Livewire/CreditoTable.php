<?php

namespace App\Livewire;

use App\Models\Credito;
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
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CreditoTable extends PowerGridComponent
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
                ->view('components.detail-credito-pago')
                ->showCollapseIcon(),
        ];
    }

    public function datasource(): Builder
    {
        return Credito::query();
    }

    public function relationSearch(): array
    {
        return [
            'cliente',
            'estatus',
            'cuenta',
            'pagos',
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('monto_formatted', fn (Credito $model) => '$'.number_format($model->monto, 2))
            ->addColumn('saldo_formatted', fn (Credito $model) => '$'.number_format($model->saldo, 2))
            ->addColumn('fecha_credito_formatted', fn (Credito $model) => Carbon::parse($model->fecha_credito)->format('d/m/Y'))
            ->addColumn('fecha_vencimiento_formatted', fn (Credito $model) => Carbon::parse($model->fecha_vencimiento)->format('d/m/Y'))
            ->addColumn('cliente_id', fn (Credito $model) => $model->cliente->razon_social)
            ->addColumn('cuenta_id', fn (Credito $model) => $model->cuenta->id)
            ->addColumn('estatus_id', fn (Credito $model) => $model->estatus->nombre)
            ->addColumn('created_at_formatted', fn (Credito $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Monto', 'monto_formatted', 'monto')
                ->sortable()
                ->searchable(),

            Column::make('Saldo', 'saldo_formatted', 'saldo')
                ->sortable()
                ->searchable(),

            Column::make('Fecha crédito', 'fecha_credito_formatted', 'fecha_credito')
                ->sortable(),

            Column::make('Fecha vencimiento', 'fecha_vencimiento_formatted', 'fecha_vencimiento')
                ->sortable(),

            Column::make('Cliente', 'cliente_id'),
            Column::make('Cuenta', 'cuenta_id'),
            Column::make('Estatus', 'estatus_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Acciones'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_credito'),
            Filter::datepicker('fecha_vencimiento'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\Credito $row): array
    {
        return [
            Button::add('edit')
                ->slot('Abonar')
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

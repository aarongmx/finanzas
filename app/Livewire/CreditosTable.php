<?php

namespace App\Livewire;

use App\Livewire\Capturista\Pagos\Form;
use App\Models\Credito;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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

final class CreditosTable extends PowerGridComponent
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
        return Credito::query()
            ->whereHas('cuenta', fn ($q) => $q->where('sucursal_id', auth()->user()->sucursal_id));
    }

    public function relationSearch(): array
    {
        return [
            'cliente:id,nombre,razon_social,rfc',
            'estatus:id,nombre',
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('monto')
            ->addColumn('saldo')
            ->addColumn('fecha_credito_formatted', fn (Credito $model) => Carbon::parse($model->fecha_credito)->format('d/m/Y'))
            ->addColumn('fecha_vencimiento_formatted', fn (Credito $model) => Carbon::parse($model->fecha_vencimiento)->format('d/m/Y'))
            ->addColumn('cliente_id', fn (Credito $model) => $model->cliente?->razon_social)
            ->addColumn('estatus_id', fn (Credito $model) => $model->estatus?->nombre)
            ->addColumn('created_at_formatted', fn (Credito $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Monto', 'monto')
                ->sortable()
                ->searchable(),

            Column::make('Saldo', 'saldo')
                ->sortable()
                ->searchable(),

            Column::make('Fecha credito', 'fecha_credito_formatted', 'fecha_credito')
                ->sortable(),

            Column::make('Fecha vencimiento', 'fecha_vencimiento_formatted', 'fecha_vencimiento')
                ->sortable(),

            Column::make('Cliente', 'cliente_id'),
            Column::make('Estatus', 'estatus_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action'),
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

    #[On('edit')]
    public function edit($rowId): void
    {
        $this->openModal('abono-modal');
        $this->dispatch('set-pagable', credito: $rowId)->component(Form::class);
    }

    public function actions(Credito $row): array
    {
        return [
            Button::add('edit')
                ->slot('Abonar')
                ->id()
                ->class('btn btn-outline-primary')
                ->dispatch('edit', ['rowId' => $row->id]),
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

<?php

namespace App\Livewire;

use App\Models\Cliente;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class ClienteTable extends PowerGridComponent
{
    use WithExport;

    public array $razon_social = [];

    protected array $rules = [
        'razon_social.*' => ['required'],
    ];

    public function onUpdatedEditable($id, $field, $value): void
    {

        ray($id);
        ray($field);
        ray($value);
        $this->validate();

        Cliente::query()->find($id)->update([
            $field => $value,
        ]);
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Cliente::query()
            ->with([
                'direccion:id,calle',
                'sucursal:id,nombre'
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
            ->addColumn('rfc')
            /** Example of custom column using a closure **/
            ->addColumn('rfc_lower', fn(Cliente $model) => strtolower(e($model->rfc)))
            ->addColumn('razon_social')
            ->addColumn('nombre_comercial')
            ->addColumn('direccion_id', fn(Cliente $model) => $model->direccion->calle)
            ->addColumn('sucursal_id', fn(Cliente $model) => $model->sucursal->nombre)
            ->addColumn('created_at_formatted', fn(Cliente $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Rfc', 'rfc')
                ->sortable()
                ->searchable(),

            Column::make('Razón social', 'razon_social')
                ->editOnClick()
                ->sortable()
                ->searchable(),

            Column::make('Nombre comercial', 'nombre_comercial')
                ->sortable()
                ->searchable(),

            Column::make('Dirección', 'direccion_id'),
            Column::make('Sucursal', 'sucursal_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('rfc')->operators(['contains']),
            Filter::inputText('razon_social')->operators(['contains']),
            Filter::inputText('nombre_comercial')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js("const modal = new bootstrap.Modal('#exampleModal', {}); modal.show(modal);");
    }

    public function actions(\App\Models\Cliente $row): array
    {
        return [
            Button::add('edit')
                ->slot('Actualizar')
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
